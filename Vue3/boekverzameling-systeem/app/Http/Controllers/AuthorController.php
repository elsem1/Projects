<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Author;
use App\Http\Requests\StoreAuthorRequest;
use App\Http\Resources\AuthorResource;
use Illuminate\Support\Facades\DB;


class AuthorController extends Controller
{
    public function index()
    {
        return AuthorResource::collection(Author::all());
    }

    public function store(StoreAuthorRequest $request)
    {
        $author = Author::create($request->validated());
        $authors = Author::all();

        return AuthorResource::collection($authors);
    }

    public function update(StoreAuthorRequest $request, Author $author)
    {
        $author->update($request->validated());

        $Authors = Author::all();
        return new AuthorResource($author);
    }

    public function booksPerAuthor()
    {
        $results = DB::table('books')
            ->select('author_id', DB::raw('COUNT(*) as book_count'))
            ->groupBy('author_id')
            ->get();

        return $results;
    }
    public function bookCount()
    {
        $totalBooks = DB::table('books')->count();

        return $totalBooks;
    }

    public function destroy(Author $author)
    {
        $name = $author->name;
        $author->delete();
        return response()->json(['message' => "Auteur {$name} is succesvol verwijderd."]);
    }
}
