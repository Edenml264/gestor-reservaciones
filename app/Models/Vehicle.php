<?php

namespace App\Models;

use App\Traits\HasImage;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Vehicle extends Model
{
    use HasFactory, HasImage;

    protected $fillable = [
        'name',
        'type',
        'capacity',
        'price_normal',
        'price_paypal',
        'description',
        'image_url',
        'active'
    ];

    protected $casts = [
        'active' => 'boolean',
        'capacity' => 'integer',
        'price_normal' => 'decimal:2',
        'price_paypal' => 'decimal:2',
    ];

    public function reservations(): HasMany
    {
        return $this->hasMany(Reservation::class);
    }
}
