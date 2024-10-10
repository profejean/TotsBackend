<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Space extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'location',
        'capacity',
        'description',
        'type', 
        'price'

    ];

    public function reservations()
    {
        return $this->hasMany(Reservation::class);
    }

    public function spaceImages()
    {
        return $this->hasMany(SpaceImage::class);
    }

    public function services()
    {
        return $this->hasMany(Service::class);
    }




}
