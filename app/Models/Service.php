<?php

namespace App\Models;

use App\Traits\HasImage;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Reservation;

class Service extends Model
{
    use HasFactory, HasImage;

    protected $fillable = [
        'name',
        'description',
        'price',
        'category',
        'image_url',
        'active'
    ];

    protected $casts = [
        'active' => 'boolean',
        'price' => 'decimal:2',
    ];

    public function reservations()
    {
        return $this->hasMany(Reservation::class);
    }
}
