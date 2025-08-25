<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class StoreTicketRequest extends FormRequest
{

    public function authorize(): bool
    {

        return $this->user() !== null;
    }


    public function rules(): array
    {
        return [
            'title' => 'required|string|max:255',
            'content' => 'required|string|max:2000',
            'status_id' => 'required|integer',
            'categories' => 'required|array',
            'categories.*' => 'exists:categories,id',
        ];
    }
}
