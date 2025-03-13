<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;


class BookController extends Controller
{
    //

    public function index()
    {
        $books = Book::all()->with("author")->get();

        return response()->json(['books' => $books]);
        // return response()->json($books);
    }
}
