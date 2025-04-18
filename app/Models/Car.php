<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'price',
        'color',
        'status',
        'seats',
        'cc',
        'top_speed',
        'description'
    ];

    public function galleries()
    {
        return $this->hasMany(CarGallery::class);
    }

    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }
}
