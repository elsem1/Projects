<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;
use App\Models\Article;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::all();


        return view('categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        return view('categories.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        request()->validate([
            'name' => ['required', 'min:3', 'max:200'],
            'description' => ['min:1', 'max:20000']

        ]);

        $category = Category::create([
            'name' => request('name'),
            'description' => request('description'),

        ]);
        return redirect('categories/');
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        $articles = $category->articles()
            ->withCount('comments')
            ->simplePaginate(5);
        $categories = Category::all();



        return view('categories.show', compact('category', 'articles', 'categories'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        $categories = Category::all();

        return view('categories.edit', [
            'category' => $category
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Category $category)
    {
        request()->validate([
            'name' => ['required', 'min:3', 'max:200'],
            'description' => ['min:1', 'max:20000'],
            'body' => ['required', 'min:3', 'max:20000']
        ]);

        $category->update([
            'name' => request('name'),
            'description' => request('description'),

        ]);
        return redirect('categories/');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        $category->delete();

        return redirect('/categories');
    }
}
