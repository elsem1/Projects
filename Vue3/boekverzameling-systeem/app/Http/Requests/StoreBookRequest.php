<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreBookRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array {
        return [
            'title' => 'required|string|max:255',
            'author_id' => 'required|exists:authors,id',
            'publisher' => 'string|max:200',
            'year' => 'string|max:4',
            'genre' => 'required|exists:genres',
            'edition' => 'string|max:2',            
            'summary' => 'required|string',
        ];
    }
}
