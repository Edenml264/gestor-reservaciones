<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Service;

class ReservationForm extends Component
{
    public $service;
    public $client_name = '';
    public $client_email = '';
    public $client_phone = '';
    public $reservation_date = '';
    public $special_requests = '';

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
            'reservation_date' => 'required|date|after:today',
            'special_requests' => 'nullable|string'
        ];
    }

    public function saveReservation()
    {
        $this->validate();

        $reservation = $this->service->reservations()->create([
            'client_name' => $this->client_name,
            'client_email' => $this->client_email,
            'client_phone' => $this->client_phone,
            'reservation_date' => $this->reservation_date,
            'special_requests' => $this->special_requests,
        ]);

        $this->reset(['client_name', 'client_email', 'client_phone', 'reservation_date', 'special_requests']);

        session()->flash('message', '¡Reservación creada exitosamente!');
    }

    public function render()
    {
        return view('livewire.reservation-form');
    }
}
