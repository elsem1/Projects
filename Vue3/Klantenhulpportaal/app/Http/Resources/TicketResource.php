<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Carbon\Carbon;

class TicketResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'content' => $this->content,
            'status_id' => $this->status_id,
            'status_name' => $this->status_name,

            'creator' => [
                'id' => $this->creator?->id,
                'first_name' => $this->creator?->first_name,
                'last_name' => $this->creator?->last_name,
            ],

            'handler' => $this->handler ? [
                'id' => $this->handler->id,
                'first_name' => $this->handler->first_name,
                'last_name' => $this->handler->last_name,
            ] : null,
            'categories_ids' => $this->categories->pluck('id'),
            'categories' => $this->categories->map(function ($category) {
                return [
                    'id' => $category->id,
                    'name' => $category->name,
                ];
            }),
            // voor nu in de back-end met carbon, maar practischer is in de font-end met (dayjs?)
            'created_at' => Carbon::parse($this->created_at)->diffForHumans(),
            'created_at_raw' => $this->created_at,
            'updated_at' => Carbon::parse($this->updated_at)->diffForHumans(),
            'updated_at_raw' => $this->created_at,
        ];
    }
}
