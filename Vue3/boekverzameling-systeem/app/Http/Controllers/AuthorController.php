<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Author;
use App\Http\Requests\StoreAuthorRequest;
use App\Http\Resources\AuthorResource;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;


class AuthorController extends Controller
{
    public function index()
    {
        // Log::info('Controller method started');
        // $start = microtime(true);

        // // Query execution
        // $authors = Author::all();
        // $mid = microtime(true);
        // Log::info('Query took ' . round(($mid - $start) * 1000, 2) . 'ms');  // Round to 2 decimals for precision

        // // Resource transformation
        // $resourceCollection = AuthorResource::collection($authors);
        // $end = microtime(true);
        // Log::info('Resource transformation took ' . round(($end - $mid) * 1000, 2) . 'ms');

        // // Total time
        // Log::info('Total operation took ' . round(($end - $start) * 1000, 2) . 'ms');

        // return response()->json($authors);  // Simple JSON response
        $authors = Author::all();  // Ensure this returns the expected data
        return response()->json($authors);
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
