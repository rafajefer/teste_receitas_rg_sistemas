<?php

namespace App\Interfaces\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'required|string|max:100',
            'login' => 'required|string|max:100|unique:usuarios,login',
            'password' => 'required|string|min:6',
        ];
    }
}
