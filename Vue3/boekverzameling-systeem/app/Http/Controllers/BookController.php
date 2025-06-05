<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreBookRequest;
use App\Http\Resources\BookResource;
use App\Models\Book;
use Illuminate\Support\Facades\DB;

class BookController extends Controller
{
    public function index()
    {
        $books = Book::with('author')->get();
        return BookResource::collection($books);
    }

    public function store(StoreBookRequest $request)
    {
        $book = Book::create($request->validated());

        return new BookResource($book);
    }

    public function genre()
    {
        return DB::table('genres')->select('id', 'name')->get();
    }

    public function update(StoreBookRequest $request, Book $book)
    {
        $book->update($request->validated());

        return new BookResource($book);
    }

    public function destroy(Book $book)
    {
        if ($book->reviews()->exists()) {
            return response()->json([
                'message' => 'Er zijn reviews aan dit boek gekoppeld. Wil je dit boek inclusief reviews verwijderen?',
                'requires_confirmation' => true,
                'book_id' => $book->id
            ], 200);
        }
        $title = $book->title;
        $book->delete();

        return response()->json([
            'message' => "Boek '{$title}' is succesvol verwijderd."
        ]);
    }


    public function forceDestroy(Book $book)
    {
        $title = $book->title;
        $book->reviews()->delete();
        $book->delete();

        return response()->json([
            'message' => "Boek '{$title}' en alle gekoppelde reviews zijn succesvol verwijderd."
        ]);
    }
}
