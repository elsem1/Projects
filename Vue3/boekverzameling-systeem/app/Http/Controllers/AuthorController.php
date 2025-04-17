<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Author;
use App\Http\Requests\StoreAuthorRequest;
use App\Http\Resources\AuthorResource;
use App\Http\Resources\BookResource;
use Illuminate\Http\Exceptions\HttpResponseException;

class AuthorController extends Controller
{
    public function index()
    {
        $authors = Author::withCount('books')->get();

        return response()->json($authors);
    }

    public function store(StoreAuthorRequest $request)
    {
        $author = Author::create($request->validated());

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
            throw new HttpResponseException(response()->json([
                'message' => 'Deze auteur kan niet worden verwijderd omdat er nog boeken aan gekoppeld zijn.'
            ], 422));
        }

        $author->delete();
    }
}
