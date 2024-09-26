<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Illuminate\Http\Request;
use App\Http\Requests\StoreItemRequest;
use App\Http\Requests\UpdateItemRequest;
use App\Models\Category;

class ItemController extends Controller
{    
    public function index() {
        $items = Item::with('category')->get();
        return view('items.index', compact('items'));
    }

    
    public function create() {
        $categories = Category::all();
        return view('items.create', compact('categories'));
    }

    
    public function store(StoreItemRequest $request) {
        $validated = $request->validated();
    
        // Maakt een nieuw item aan met de gevalideerde gegevens
        Item::create($validated);
    
        return redirect()->route('items.index');
    }
    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    
    public function edit(Item $item) {
        $categories = Category::all();
        return view('items.edit', compact('item', 'categories'));
    }

        
    public function update(UpdateItemRequest $request, Item $item) {
        $validated = $request->validated();
    
        // Werkt het item bij met de gevalideerde gegevens
        $item->update($validated);
    
        return redirect()->route('items.index');
    }
    

    public function destroy(Item $item) {
        $item->delete();
        return redirect()->route('items.index');
    }
}
