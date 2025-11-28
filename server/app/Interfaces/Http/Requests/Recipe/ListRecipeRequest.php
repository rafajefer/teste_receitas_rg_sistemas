<?php

namespace App\Interfaces\Http\Requests\Recipe;

use Illuminate\Foundation\Http\FormRequest;

class ListRecipeRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'title' => 'nullable|string|max:45'
        ];
    }
}
