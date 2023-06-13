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
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'title' => [
                'required',
            ],
            'subtitle' => [
                'nullable'
            ],
            'author' => [
                'nullable'
            ],
            'genre' => [
                'required'
            ],
            'sub_genre' => [
                'nullable'
            ],
            'publisher' => [
                'nullable'
            ],
            'year_published' => [
                'nullable',
            ],
            'edition' => [
                'nullable'
            ],
            'isbn_10' => [
                'nullable',
                'max:10'
            ],
            'isbn_13' => [
                'nullable',
                'max:13',
            ],
            'height' => [
                'nullable'
            ],
        ];
    }
}
