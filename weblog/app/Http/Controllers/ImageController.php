<?php

namespace App\Http\Controllers;
use App\Models\Article;
use App\Models\Image;

use Illuminate\Http\Request;

class ImageController extends Controller
{
    public function index()
    {
        
    }

    public function create()
    {
        
    }

    public function store(Request $request, Article $article)
{
    // Validate the request data
    $request->validate([
        'name' => 'required',
        'description' => 'required',
        'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
    ]);

    
    $imageName = time() . '.' . $request->image->extension();
    $request->image->move(public_path('images'), $imageName);
    
    $image = new Image();
    $image->article_id = $article->id; 
    $image->name = $request->name; 
    $image->description = $request->description;    
    $image->save();

    
    return redirect()->route('articles.create', $article->id)->with('success', "Image posted successfully!");
}



    public function edit(Image $image)
    {
        $images = Image::all();

        return view('categories.edit', [            
            'image' => $image
        ]);       
    }

    
    public function update(Image $image)
    {
        request()->validate([
            'name' => 'required',
            'description' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $image->update([
            'name' => request('name'),
            'description' => request('description'), 
            'image' => request('image')           
            
        ]);
        return redirect('images/');
    }

    public function destroy(Image $image)
    {
        $image->delete();

        return redirect('/images');
    }
}
