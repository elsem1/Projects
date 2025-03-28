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
        $books = Book::all();

        return response()->json($books);
    }

    public function store(StoreBookRequest $request)
    {
        $book = Book::create($request->validated());

        $books = Book::all();

        return BookResource::collection($books);
    }

    public function genre()
    {
        $genres = DB::table('genres')->pluck('name', 'id');

        return DB::table('genres')->select('id', 'name')->get();
    }
}
