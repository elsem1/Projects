<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\User;
use App\Models\Ticket;

class UpdateTicketRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(User $user, Ticket $ticket): bool
    {
        $ticket = $this->route('ticket');
        return $ticket->user_id === auth()->id;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title' => 'required|string|max:255',
            'status_id' => 'exists:statuses,id',
            'categories' => 'array',
            'categories.*' => 'exists:categories,id',
            'content' => 'required|string|max:2000',
        ];
    }
}
