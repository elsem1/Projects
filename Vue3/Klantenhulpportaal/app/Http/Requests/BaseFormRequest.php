<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\JsonResponse;

class BaseFormRequest extends FormRequest
{


    protected function failedValidation(Validator $validator): void
    {
        throw new HttpResponseException(new JsonResponse([
            'errors' => $validator->errors(),
            'message' => 'De ingevoerde gegevens zijn niet juist',
        ], 422));
    }

    public function authorize(): bool
    {
        return true;
    }
}
