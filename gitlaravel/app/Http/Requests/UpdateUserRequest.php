<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;

class UpdateUserRequest extends FormRequest
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
        /* 'email' => 'required|email|unique:users,email'.$this->id,
           $this->id est ajoutée parce qu'on veut dire que tous les users doivent
           avoir un unique email à l'exception de celui qui veut cchager son mot de passe.
           .$this->id : Cela ajoute une exception pour l'utilisateur actuel. Lorsqu'un utilisateur
           veut mettre à jour ses informations (par exemple, son email), il est nécessaire de ne
           pas considérer son propre email comme une duplication. $this->id représente l'identifiant
           (id) de l'utilisateur actuel qui effectue la mise à jour. Ainsi, la validation ignorera
           cet identifiant lors de la vérification de l'unicité de l'email.*/
        return [
            'name' => 'required|max:55|string',
            'email' => 'required|email|unique:users,email,'.$this->id,
            'password' =>[
                'confirmed',
                Password::min(8)
                ->letters()
                ->symbols()
                ->mixedCase()
            ]
        ];
    }
}
