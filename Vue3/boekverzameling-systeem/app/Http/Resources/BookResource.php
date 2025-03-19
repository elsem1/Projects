<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Models\Author;

class BookResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'author_id'=> $this->author_id,
            'title' => $this->title,
            'publisher' => $this->publisher,
            'year' => $this->year,
            'genre' => $this->genre,
            'edition' => $this->edition,
            'summary' => $this->summary,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
