<?php

namespace App\Http\Requests\Products;

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
            'name' => 'required',
            'cost' => 'required',
            'tax' => 'required',
            'stock' => 'required',
        ];
    }

    public function messages()
    {
      return [
        'name.required' => 'El nombre del Producto es requerido',
        'cost.required' => 'El costo del Producto es requerido',
        'tax.required' => 'El impuesto del producto es requerido',
        'stock.required' => 'El stock del producto es requerido',
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
