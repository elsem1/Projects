<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class StoreCategoryRequest extends FormRequest
{

    public function authorize(): bool
    {
        $user = Auth::user();
        return $user->is_admin;
    }


    public function rules(): array
    {
        return [
            'name' => 'string|required|max:200',
            'description' => 'required|string|max:2000',

        ];
    }
}
