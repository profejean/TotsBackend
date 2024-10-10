<?php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreServiceRequest extends FormRequest
{
    public function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'space_id' => 'required|exists:spaces,id', 
        ];
    }

    public function authorize()
    {
        return true; // Cambia esto según la lógica de autorización de tu aplicación
    }
}
