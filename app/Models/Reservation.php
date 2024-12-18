<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Service;

class Reservation extends Model
{
    use HasFactory;

    protected $fillable = [
        'service_id',
        'client_name',
        'client_email',
        'client_phone',
        'reservation_date',
        'special_requests',
        'status'
    ];

    protected $casts = [
        'reservation_date' => 'datetime'
    ];

    public function service()
    {
        return $this->belongsTo(Service::class);
    }
}
