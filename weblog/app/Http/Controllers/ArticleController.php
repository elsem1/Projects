<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;
use App\Models\Article;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;


class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {        
        $articles = Article::with('categories', 'user', 'comments')
            ->withCount('comments', 'categories')
            ->latest()
            ->simplePaginate(10);
                    
        return view('articles.index', compact('articles'), [
            'articles' => $articles,
            
        ]);
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
        request()->validate([
            'title' => ['required', 'min:3', 'max:200'],
            'category' => '',
            'body' => ['required', 'min:3', 'max:20000' ]
        ]);

        $article = Article::create([
            'title' => request('title'),
            'category' => request('category'),
            'body' => request('body'),
            'user_id' => Auth::id()
        ]);

        // $article->user_id = Auth::id();
        // $article->title = $request->input('title');
        // $article->body = $request->input('body');
        // $article->save();

        return redirect()->route('articles.index');

    }

    /**
     * Display the specified resource.
     */
    public function show(Article $article)
    {
        
        return view('articles.show', ['article'=> $article]);
        }
        

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Article $article)
    {
        $categories = Category::all();

        return view('articles.edit', [
            'article' => $article,
            'categories' => $categories
        ]);       
    }



    public function update(Article $article)
    {
        request()->validate([
            'title' => ['required', 'min:3', 'max:200'],
            'category' => '',
            'body' => ['required', 'min:3', 'max:20000' ]
        ]);

        $article->update([
            'title' => request('title'),
            'category' => request('category'),
            'body' => request('body'),
            'user_id' => Auth::id()
        ]);

        return redirect('/articles/' . $article->id);
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
