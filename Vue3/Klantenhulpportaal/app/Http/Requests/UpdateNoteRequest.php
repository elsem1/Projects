<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class UpdateNoteRequest extends FormRequest
{

    public function authorize(): bool
    {
        $user = Auth::user();
        return $user->is_admin;
    }


    public function rules(): array
    {
        return [
            'content' => 'required|string|max:2000',
            'user_id' => 'exists:users,id'
        ];
    }
}
