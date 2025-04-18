<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CarGallery extends Model
{
    use HasFactory;
    protected $fillable = [
        'car_id',
        'image_path'
    ];

    public function car()
    {
        return $this->belongsTo(Car::class);
    }
}
