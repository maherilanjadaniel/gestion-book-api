<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class StoreBookRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true; // a securiser si besoin
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title'          => 'required|string|max:255',
            'author'         => 'required|string|max:255',
            'summary'        => 'nullable|string',
            'published_year' => 'required|digits:4|integer'
        ];
    }

    public function messages(): array
    {
        return [
            'title.required' => 'Le title est obligatoire.',
            'author.required' => 'L\'auteur est obligatoire.',
            'published_year.required' => 'L\'année de publication est obligatoire.',
            'published_year.digits' => 'L\'année de publication doit être un nombre à 4 chiffres.',
            'published_year.integer' => 'L\'année de publication doit être un entier.'
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(
            response()->json([
                'message' => 'Validation failed',
                'errors' => $validator->errors()
            ], 422)
        );
    }
}
