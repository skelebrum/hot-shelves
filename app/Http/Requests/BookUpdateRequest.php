<?php

namespace App\Http\Requests;


use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Http\FormRequest;

class BookUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
    }

    /**
     * Validate data
     *
     * @return void
     */
    public function prepareForValidation(): void
    {
        $this->merge([
            'slug' => Str::slug($this->input('name'))
        ]);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name' => ['required', 'string', ' min:3', 'max:60'],
            'description' => ['string', 'min:10', 'max:60'],
            'image' => ['nullable', 'mimes:jpeg,png,gif,webp'],
            'slug' => ['required', Rule::unique('books', 'slug')]
        ];
    }
}
