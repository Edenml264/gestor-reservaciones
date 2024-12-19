<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Service;
use App\Models\Vehicle;

class Reservation extends Model
{
    use HasFactory;

    protected $fillable = [
        'service_id',
        'vehicle_id',
        'client_name',
        'client_email',
        'client_phone',
        'hotel',
        'destination',
        'service_type', // one-way, round-trip
        'arrival_date',
        'arrival_time',
        'arrival_airline',
        'arrival_flight',
        'departure_date',
        'departure_time',
        'departure_airline',
        'departure_flight',
        'pickup_date',
        'pickup_time',
        'number_passengers',
        'price_normal',
        'price_paypal',
        'comments',
        'status',
        'reservation_number'
    ];

    protected $casts = [
        'arrival_date' => 'date',
        'departure_date' => 'date',
        'pickup_date' => 'date',
        'arrival_time' => 'datetime',
        'departure_time' => 'datetime',
        'pickup_time' => 'datetime',
    ];

    public function service(): BelongsTo
    {
        return $this->belongsTo(Service::class);
    }

    public function vehicle(): BelongsTo
    {
        return $this->belongsTo(Vehicle::class);
    }

    protected static function boot()
    {
        parent::boot();
        
        static::creating(function ($reservation) {
            $reservation->reservation_number = 'BTL-' . rand(100000, 999999);
        });
    }
}
