<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class VentaCrearRequest extends Request
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
        //$ventas = $this->route('ventas');
        return [
            
            'nom_empresa' => 'required|max:255',
            'nom_app' => 'required|max:255',
            'nom_cli' => 'required|max:255',
            'desc_app' =>'required|max:255',
            'valor_app' => 'numeric|required',
        ];
    }
}
