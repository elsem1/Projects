<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\User;
use App\Models\Ticket;
use Illuminate\Support\Facades\Auth;

class UpdateTicketRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        $user = Auth::user();
        $ticket = $this->route('ticket');

        // Controleer of gebruiker en ticket bestaan
        if (! $user || ! $ticket) {
            return false;
        }

        // Toegang voor eigenaar of admin
        return $ticket->user_id === $user->id || $user->is_admin;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $rules = [
            'title' => 'required|string|max:255',
            'categories' => 'array',
            'categories.*' => 'exists:categories,id',
            'content' => 'required|string|max:2000',
        ];

        // Alleen admin kan status_id aanpassen
        if (Auth::user()?->is_admin) {
            $rules['status_id'] = 'integer';
        }

        return $rules;
    }
}
