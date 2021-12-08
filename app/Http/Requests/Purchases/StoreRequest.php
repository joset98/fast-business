<?php

namespace App\Http\Requests\Purchases;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class StoreRequest extends FormRequest
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
            'product_id' => 'required|exists:products,id',
        ];
    }

    public function messages()
    {
      return [
        'product_id.required' => 'El id de producto debe ser referido',
        'product_id.exists' => 'El producto seleccionado, no existe',
      ];
    }

    protected function failedValidation(Validator $validator) {

        throw new HttpResponseException(response()->json(
            [
                'message' => 'opps ha habido un error',
                'errors' => $validator->errors()->all(),
            ], 
            422
        ));
    }
}
