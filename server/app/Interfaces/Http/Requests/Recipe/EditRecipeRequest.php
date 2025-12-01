<?php

namespace App\Interfaces\Http\Requests\Recipe;

use Illuminate\Foundation\Http\FormRequest;

class EditRecipeRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'title' => 'nullable|string|max:45|unique:receitas,nome,' . $this->route('id'),
            'preparationTimeMinutes' => 'nullable|integer|min:0',
            'servings' => 'nullable|integer|min:0',
            'ingredients' => 'nullable|array',
            'steps' => 'required|array',
            'categoryId' => 'nullable|integer|exists:categorias,id',
        ];
    }
}