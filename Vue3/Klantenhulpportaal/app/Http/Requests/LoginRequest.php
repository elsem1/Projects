<?php

namespace App\Http\Requests;

use App\Http\Requests\BaseFormRequest;

class LoginRequest extends BaseFormRequest
{
    public function authorize(): bool
    {
        return true;
    }
    
    public function rules(): array
    {
        return [
            'email' => 'required|email|string|max:50',
            'password' => 'required|string|max:255',
            'remember' => 'sometimes|boolean',
        ];
    }

}
