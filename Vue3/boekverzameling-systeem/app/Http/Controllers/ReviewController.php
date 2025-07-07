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
        $reviews = Review::with('book', 'user')->get();
        return ReviewResource::collection($reviews);
    }

    public function store(StoreReviewRequest $request)
    {
        $randomUserId = User::inRandomOrder()->firstOrFail()->id;
        $reviewData = $request->validated();

        $reviewData['user_id'] = $randomUserId;

        $review = Review::create($reviewData);

        return new ReviewResource($review);
    }

    public function destroy(Review $review)
    {
        $review->delete();
        return response()->json(['message' => "Review is succesvol verwijderd."]);
    }
}
