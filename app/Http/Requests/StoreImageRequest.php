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
            'url' => 'required|url',
        ];
    }

    public function messages()
    {
        return [
            'url.required' => 'La URL de la imagen es obligatoria.',
            'url.url' => 'La URL proporcionada no es válida.',
        ];
    }
}
