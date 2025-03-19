<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreBookRequest;
use App\Http\Resources\BookResource;
use App\Models\Book;

class BookController extends Controller
{
    //

    public function index()
    {
        $books = Book::all();

        return response()->json($books);

    }
    
    public function store(StoreBookRequest $request) {
        $book = Book::create($request->validated());

        $books = Book::all();

        return BookResource::collection($books);
    }
}
