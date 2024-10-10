<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Space;

class SpaceImage extends Model
{
    use HasFactory;

    // Definir la tabla si no sigue la convención de nombres
    protected $table = 'space_images'; // Cambiar a 'images' para coincidir con la migración

    // Definir los atributos que son asignables en masa
    protected $fillable = [
        'space_id',  // Relación con el espacio
        'url',       // URL de la imagen
    ];

    // Definir la relación con el modelo Space
    public function space()
    {
        return $this->belongsTo(Space::class);
    }

    // Otras funciones y características del modelo pueden ir aquí
}
