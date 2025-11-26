<?php

namespace App\Interfaces\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
{
    public function authorize() { return true; }

    public function rules(): array
    {
        return [
            'login' => ['required','string'],
            'password' => ['required','string'],
        ];
    }
}