<?php

namespace App\Http\Requests\Auth;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class LoginRequest extends FormRequest
{
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
            'email' => 'required|exists:users,email|email',
            'password' => 'required',
        ];    
    }

    public function messages()
    {
      return [
        'email.email' => 'El correo electrónico debe tener el formato correcto',
        'email.exists' => 'El correo suministrado no existe',
        'email.required' => 'La confirmacion de contraseña no coincide',
        'password.required' => 'La contraseña no puede estar vacia',
      ];
    }
    
    protected function failedValidation(Validator $validator) {
        info($validator->errors()->all());
        // info(var_dump($validator->errors()));
        throw new HttpResponseException(response()->json(
            [
                'message' => 'opps ha habido un error',
                'errors' => $validator->errors()->all(),
            ], 
            422
        ));
    }
}
