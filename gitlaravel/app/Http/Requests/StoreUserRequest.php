<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;

class StoreUserRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        /*mixedCase: le mot de passe doit contenir des lettres majuscules et minuscules*/
        return [
            'name' => 'required:max:55|string',
            'email' => 'required|email|unique:users,email',
            'password' =>[
                'required',
                'confirmed',
                Password::min(8)
                ->letters()
                ->symbols()
                ->mixedCase()
            ]
        ];
    }
}
