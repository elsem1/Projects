<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\ReplyResource;
use App\Http\Resources\NoteResource;

class TicketResource extends JsonResource
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
            'title' => $this->title,
            'content' => $this->content,
            'status_id' => $this->status_id,
            'status_name' => $this->status_name ?? $this->status?->name,

            'creator' => $this->whenLoaded('creator', new UserResource($this->creator)),
            'handler' => $this->whenLoaded('handler', new UserResource($this->handler)),

            'categories' => $this->whenLoaded('categories', $this->categories->pluck('id')),
            'category_details' => $this->whenLoaded(
                'categories',
                CategoryResource::collection($this->categories)
            ),

            'notes' => $this->when(
                $request->user()?->is_admin && $this->relationLoaded('notes'),
                NoteResource::collection($this->notes)
            ),

            'replies' => $this->whenLoaded('replies', ReplyResource::collection($this->replies)),            

            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
