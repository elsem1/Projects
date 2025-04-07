<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Author;
use App\Http\Requests\StoreAuthorRequest;
use App\Http\Resources\AuthorResource;
use App\Http\Resources\BookResource;
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
        $authors = Author::withCount('books')->get();

        return response()->json($authors);
    }

    public function store(StoreAuthorRequest $request)
    {
        $author = Author::create($request->validated());
        $authors = Author::all();

        return new AuthorResource($author);
    }

    public function update(StoreAuthorRequest $request, Author $author)
    {
        $author->update($request->validated());

        $Authors = Author::all();
        return new AuthorResource($author);
    }

    public function destroy(Author $author)
    {
        if ($author->books()->exists()) {
            return response()->json([
                'message' => 'Cannot delete author with books'
            ], 422);
        }

        $author->delete();
        return response()->noContent();
    }
}
