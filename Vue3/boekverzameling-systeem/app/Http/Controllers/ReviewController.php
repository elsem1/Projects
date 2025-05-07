<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreReviewRequest;
use App\Http\Resources\ReviewResource;
use Illuminate\Http\Request;
use App\Models\Review;
use App\Models\Book;
use App\Models\User;

class ReviewController extends Controller
{
    public function index(Book $book)
    {
        $reviews = $book->reviews()->with('user')->get();
        return response()->json($reviews);
    }

    public function store(Book $book, StoreReviewRequest $request)
    {
        $randomUser = User::inRandomOrder()->firstOrFail();

        $review = $book->reviews()->create(
            $request->validated() +
                ['user_id' => $randomUser->id]
        );

        return response()->json([
            'data' => new ReviewResource($review),
            'message' => 'Review created successfully'
        ], 201);
    }
}
