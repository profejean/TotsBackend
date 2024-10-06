<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'price',
        'space_id', // Relación con el espacio
    ];

    /**
     * Relación con el modelo Space.
     */
    public function space()
    {
        return $this->belongsTo(Space::class);
    }
}
