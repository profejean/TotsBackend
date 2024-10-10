<?php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreImageRequest extends FormRequest
{
    public function authorize()
    {
        return true; // Permitir acceso a todos
    }

    public function rules()
    {
        return [
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Valida el archivo de imagen
        ];
    }

    public function messages()
    {
        return [
            'image.required' => 'Es necesario subir una imagen.',
            'image.image' => 'El archivo debe ser una imagen.',
            'image.mimes' => 'La imagen debe ser de tipo jpeg, png, jpg o gif.',
            'image.max' => 'La imagen no debe exceder los 2MB.',
        ];
    }
}
