<?php

namespace App\Interfaces\Http\Requests\Recipe;

use Illuminate\Foundation\Http\FormRequest;

class CreateRecipeRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'title' => 'nullable|string|max:45|unique:receitas,nome',
            'preparationTimeMinutes' => 'nullable|integer|min:0',
            'servings' => 'nullable|integer|min:0',
            'ingredients' => 'nullable|array',
            'steps' => 'required|array',
            'category_id' => 'nullable|integer|exists:categories,id',
        ];
    }
}