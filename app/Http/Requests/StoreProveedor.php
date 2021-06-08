<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProveedor extends FormRequest
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
            'documento' => 'required|min:11|max:12',
            'nombre' => 'required|max:60',
            'contacto' => 'required|max:45',
            'telefono' => 'required|max:12',
            'email' => 'max:45',
        ];
    }
}
