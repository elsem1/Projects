<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;
use App\Models\Article;
use App\Models\Category;
use App\Models\Image;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;


class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    
    
    public function index(Request $request)
    {
        $type = $request->query('type', 'all');

        if ($type === 'premium' && (!auth()->check() || !auth()->user()->premium)) {
            
            $title = 'Premium Articles Preview';
            $description = 'Preview of our special premium articles.\nSubscribe to our website to see our best content!';
            return redirect()->route('premium', [
                'title' => $title,
                'description' => $description,
            ]);
            
        }
        

        if ($type === 'premium') {
            $articles = Article::where('premium', 1)
                ->withCount(['comments', 'categories'])
                ->latest()
                ->simplePaginate(5);
            $title = 'Premium Articles';
            $description = 'Overview of our special premium articles, just for you!';
        } else {
            $articles = Article::withCount(['comments', 'categories'])
                ->latest()
                ->simplePaginate(5);
            $title = 'All Articles';
            $description = 'Overview of all our articles. Enjoy!';
        }

        return view('articles.index', compact('articles', 'title', 'description'));
    }




    public function create()
    {
        $categories = Category::all();
        return view('articles.create', compact('categories'));


    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $request->validate([
            'title' => ['required', 'min:3', 'max:200'],
            'categories' => 'array',
            'categories.*' => ['integer', 'exists:categories,id'],
            'body' => ['required', 'min:3', 'max:20000'],
            'name' => ['nullable', 'string', 'max:255'],
            'description' => ['nullable', 'string', 'max:1000'],
            'image' => ['nullable', 'image', 'mimes:jpg,jpeg,png', 'max:2048'],
        ]);

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

            return redirect()->route('articles.index')->with('success', 'Article created successfully!');
        }
    }


    /**
     * Display the specified resource.
     */
    public function show(Article $article)
    {
        $image = $article->images()->get();

        return view('articles.show', [
            'article' => $article,
            'image' => $image
        ]);
    }


    /**
     * Show the form for editing the specified resource.
     */
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
