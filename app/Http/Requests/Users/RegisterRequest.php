<?php

namespace App\Http\Requests\Users;

use Illuminate\Contracts\Validation\Validator as ValidationValidator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\Rules;
use Illuminate\Validation\ValidationException;

class RegisterRequest extends FormRequest
{

    protected $redirect = '/register';
    protected $redirectRoute = 'register';
    
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ];
    }

    public function messages()
    {
      return [
        'name.required' => 'El nombre del usuario es requerido',
        'name.string' => 'El nombre del usuario debe ser caracteres',
        'email.required' => 'El correo del usuario es requerido',
        'email.email' => 'El correo debe tener formato apropiado',
        'email.unique' => 'El correo ya se encuentra en uso',
        'password.required' => 'La contraseña es requerida',
        'password.confirmed' => 'La confirmacion de contraseña no coincide',
      ];
    }

}
