<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;
use App\Models\Article;
use App\Models\Category;
use App\Models\Image;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;


class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function premiumArticles(Request $request)
    {
        $request->query->set('type', 'premium');
        return $this->index($request);
    }

    public function index(Request $request)
    {
        $type = $request->query('type', 'all');

        // TODO: onderstaande logica had evt. ook via query scopes gekund:
        // https://laravel-news.com/query-scopes

        if ($type === 'premium' && (!auth()->check() || !auth()->user()->premium)) {
            $title = 'Premium Articles Preview';
            $description = 'Preview of our special premium articles.<br>Subscribe to our website to see our best content!';
            return $this->premiumPreview($title, $description);
        }

        if ($type === 'premium' && auth()->user()->premium) {
            return $this->premium();
        }

        $articles = Article::withCount(['comments', 'categories'])
            ->latest()
            ->simplePaginate(5);
        $title = 'All Articles';
        $description = 'Overview of all our articles. Enjoy!';

        return view('articles.index', compact('articles', 'title', 'description'));
    }

    public function premium()
    {
        $title = 'Premium Articles';
        $description = 'Overview of our special premium articles, just for you!';
        $articles = Article::where('premium', 1)
            ->withCount(['comments', 'categories'])
            ->latest()
            ->simplePaginate(5);

        return view('articles.index', compact('articles', 'title', 'description'));
    }

    public function premiumPreview($title, $description)
    {
        $articles = Article::where('premium', 1)
            ->withCount(['comments', 'categories'])
            ->latest()
            ->take(2)
            ->get();

        return view('auth.premium', compact('articles', 'title', 'description'));
    }


    public function create()
    {
        $categories = Category::all();
        return view('articles.create', compact('categories'));
    }

    public function store(Request $request)
    {
        // TODO: maak aparte request form validation class aan voor betere
        // leesbaarheid van je code
        $request->validate([
            'title' => [
                'required',
                'min:3',
                'max:200',
                Rule::unique('articles')->where(function ($query) {
                    return $query->where('user_id', Auth::id());
                })
            ],
            'categories' => 'array',
            'categories.*' => ['integer', 'exists:categories,id'],
            'body' => ['required', 'min:3', 'max:20000'],
            'name' => ['nullable', 'string', 'max:255'],
            'description' => ['nullable', 'string', 'max:1000'],
            'image' => ['nullable', 'image', 'mimes:jpg,jpeg,png', 'max:2048'],
        ]);


        // TODO: stop gevalideerde data in $validated variable en gebuik
        // alleen deze data voor opslaan naar database ivm veiligheid

        $article = Article::create([
            'title' => $request->input('title'),
            'body' => $request->input('body'),
            'user_id' => Auth::id(),
            'premium' => $request->input('premium', 0)
        ]);

        $article->categories()->sync($request->input('categories', []));

        if ($request->hasFile('image')) {
            $imageFile = $request->file('image');
            $imageName = time() . '.' . $imageFile->extension();

            $imageFile->move(public_path('images'), $imageName);

            $image = new Image();
            $image->article_id = $article->id;
            $image->name = $request->input('name');
            $image->description = $request->input('description');
            $image->user_id = Auth::id();
            $image->path = 'images/' . $imageName;
            $image->save();
        }

        return redirect()->route('articles.index')->with('success', 'Article created successfully!');
    }

    public function show(Article $article)
    {
        $image = $article->images()->get();

        return view('articles.show', [
            'article' => $article,
            'image' => $image
        ]);
    }

    public function edit(Article $article)
    {
        $categories = Category::all();
        $images = $article->images;

        return view('articles.edit', [
            'article' => $article,
            'categories' => $categories,
            'images' => $images,
        ]);
    }



    public function update(Request $request, Article $article)
    {
        $request->validate([
            'title' => ['required', 'min:3', 'max:200'],
            'categories' => 'array',
            'categories.*' => ['integer', 'exists:categories,id'],
            'body' => ['required', 'min:3', 'max:20000'],
        ]);

        if ($request->hasFile('image')) {
            $request->validate([
                'image' => ['image', 'mimes:jpeg,png,jpg,gif', 'max:2048'],
                'name' => ['required', 'string', 'max:255'],
                'description' => ['required', 'string', 'max:1000'],
            ]);
        }

        $article->update([
            'title' => $request->input('title'),
            'body' => $request->input('body'),
            'premium' => $request->input('premium', 0)
        ]);

        $article->categories()->sync($request->input('categories', []));

        if ($request->hasFile('image')) {
            $imageName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('images'), $imageName);


            $image = new Image();
            $image->article_id = $article->id;
            $image->name = $request->input('name');
            $image->description = $request->input('description');
            $image->path = 'images/' . $imageName;
            $image->user_id = Auth::id();
            $image->save();
        }

        return redirect('/articles/' . $article->id)->with('success', 'Article updated successfully!');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Article $article)
    {
        $article->delete();

        return redirect('/articles');
    }
}
