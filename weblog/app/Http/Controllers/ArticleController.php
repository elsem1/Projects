<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;
use App\Models\Article;
use App\Models\Category;


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
        $article = new Article();
        $article->user_id = 1; # Moet nog aangepast worden naar de user
        $article->title = $request->input('title');
        $article->body = $request->input('body');
        $article->save();

        // return redirect()->route('articles.index');

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
    public function edit(string $id)
    {
        $categories = Category::all();
        return view('articles.edit', compact('article', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     public function update(UpdateArticleRequest $request, Article $article)
     {
        $validated = $request->validated();
        $article->update($validated);
        return redirect()->route('articles.index');
    }
    */

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
