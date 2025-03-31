<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Author;
use App\Http\Requests\StoreAuthorRequest;
use App\Http\Resources\AuthorResource;

class AuthorController extends Controller
{
    public function index()
    {
        $authors = Author::all();

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

    public function destroy(Author $author)
    {
        $name = $author->name;
        $author->delete();
        return response()->json(['message' => "Auteur {$name} is succesvol verwijderd."]);
    }
}
