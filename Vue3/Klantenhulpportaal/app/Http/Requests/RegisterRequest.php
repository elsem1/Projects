<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'first_name' => 'required|string|max:30',
            'last_name' => 'required|string|max:30',
            'email' => 'required|string|email|confirmed',
            'phone_number' => 'required|string|regex:/^[\+]?[0-9\s\-\(\)]{10,20}$/',
            'is_admin' => 'required|boolean',
            'password' => 'required|string'
        ];
    }
}
