<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreBookRequest;
use App\Http\Resources\BookResource;
use App\Models\Book;
use Illuminate\Support\Facades\DB;

class BookController extends Controller
{
    //

    public function index()
    {
        return BookResource::collection(Book::all());
    }

    public function store(StoreBookRequest $request)
    {
        $book = Book::create($request->validated());

        $books = Book::all();

        return new BookResource($book);
    }

    public function genre()
    {
        $genres = DB::table('genres')->pluck('name', 'id');

        return DB::table('genres')->select('id', 'name')->get();
    }

    public function update(StoreBookRequest $request, Book $book)
    {
        $book->update($request->validated());

        $books = Book::all();
        return new BookResource($book);
    }

    public function destroy(Book $book)
    {
        $title = $book->title;
        $book->delete();
        return response()->json(['message' => "Boek {$title} is succesvol verwijderd."]);
    }
}
