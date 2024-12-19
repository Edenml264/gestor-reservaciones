<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Service;
use App\Models\Vehicle;
use Illuminate\Support\Str;

class ReservationForm extends Component
{
    public $service;
    public $client_name = '';
    public $client_email = '';
    public $client_phone = '';
    public $vehicle_id = '';
    public $service_type = 'one-way';
    public $pickup_date = '';
    public $pickup_time = '';
    public $number_passengers = 1;
    public $comments = '';

    public function mount(Service $service)
    {
        $this->service = $service;
    }

    protected function rules()
    {
        return [
            'client_name' => 'required|min:3',
            'client_email' => 'required|email',
            'client_phone' => 'required',
            'vehicle_id' => 'required|exists:vehicles,id',
            'service_type' => 'required|in:one-way,round-trip',
            'pickup_date' => 'required|date|after:today',
            'pickup_time' => 'required',
            'number_passengers' => 'required|integer|min:1',
            'comments' => 'nullable|string'
        ];
    }

    public function saveReservation()
    {
        $validatedData = $this->validate();
        
        $reservation = $this->service->reservations()->create([
            'client_name' => $this->client_name,
            'client_email' => $this->client_email,
            'client_phone' => $this->client_phone,
            'vehicle_id' => $this->vehicle_id,
            'service_type' => $this->service_type,
            'pickup_date' => $this->pickup_date,
            'pickup_time' => $this->pickup_time,
            'number_passengers' => $this->number_passengers,
            'comments' => $this->comments,
            'reservation_number' => 'BTL-' . Str::random(6),
            'price_normal' => $this->service->price,
            'price_paypal' => $this->service->price * 1.05, // 5% adicional para PayPal
            'status' => 'pending'
        ]);

        $this->reset(['client_name', 'client_email', 'client_phone', 'vehicle_id', 
                     'service_type', 'pickup_date', 'pickup_time', 'number_passengers', 'comments']);

        session()->flash('message', '¡Reservación creada exitosamente!');
    }

    public function render()
    {
        return view('livewire.reservation-form', [
            'vehicles' => Vehicle::where('active', true)->get()
        ]);
    }
}
