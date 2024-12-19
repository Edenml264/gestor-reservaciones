<?php

namespace App\Livewire;

use App\Models\Vehicle;
use App\Models\Reservation;
use App\Traits\ValidatesReservationDates;
use Carbon\Carbon;
use Livewire\Component;
use Livewire\Attributes\On;

class ReservationWizard extends Component
{
    use ValidatesReservationDates;

    public $step = 1;
    public $totalSteps = 3;
    
    // Paso 1: Información del cliente
    public $client_name = '';
    public $client_email = '';
    public $client_phone = '';
    public $hotel = '';
    public $destination = '';
    public $number_passengers = 1;
    
    // Paso 2: Información del vehículo
    public $selectedVehicle = null;
    public $service_type = 'one-way';
    
    // Paso 3: Información del viaje
    public $arrival_date = '';
    public $arrival_time = '';
    public $arrival_airline = '';
    public $arrival_flight = '';
    public $departure_date = '';
    public $departure_time = '';
    public $departure_airline = '';
    public $departure_flight = '';
    public $pickup_date = '';
    public $pickup_time = '';
    public $comments = '';

    protected function rules()
    {
        return array_merge([
            'client_name' => 'required|min:3',
            'client_email' => 'required|email',
            'client_phone' => 'required',
            'hotel' => 'required',
            'destination' => 'required',
            'number_passengers' => 'required|numeric|min:1',
            'service_type' => 'required|in:one-way,round-trip',
            'arrival_airline' => 'required',
            'arrival_flight' => 'required',
            'departure_airline' => 'required_if:service_type,round-trip',
            'departure_flight' => 'required_if:service_type,round-trip',
            'selectedVehicle' => 'required|exists:vehicles,id',
        ], $this->getDateValidationRules(), $this->getTimeValidationRules());
    }

    protected function messages()
    {
        return array_merge([
            'client_name.required' => 'El nombre del cliente es requerido.',
            'client_name.min' => 'El nombre debe tener al menos :min caracteres.',
            'client_email.required' => 'El correo electrónico es requerido.',
            'client_email.email' => 'El correo electrónico debe ser válido.',
            'client_phone.required' => 'El teléfono es requerido.',
            'hotel.required' => 'El hotel es requerido.',
            'destination.required' => 'El destino es requerido.',
            'number_passengers.required' => 'El número de pasajeros es requerido.',
            'number_passengers.numeric' => 'El número de pasajeros debe ser un número.',
            'number_passengers.min' => 'El número de pasajeros debe ser al menos :min.',
            'arrival_airline.required' => 'La aerolínea de llegada es requerida.',
            'arrival_flight.required' => 'El número de vuelo de llegada es requerido.',
            'departure_airline.required_if' => 'La aerolínea de salida es requerida para viajes redondos.',
            'departure_flight.required_if' => 'El número de vuelo de salida es requerido para viajes redondos.',
            'selectedVehicle.required' => 'Debe seleccionar un vehículo.',
            'selectedVehicle.exists' => 'El vehículo seleccionado no es válido.',
        ], $this->getDateValidationMessages());
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function validateStep()
    {
        $rules = $this->rules();
        $fieldsToValidate = [];

        switch ($this->step) {
            case 1:
                $fieldsToValidate = ['client_name', 'client_email', 'client_phone', 'hotel', 'destination', 'number_passengers'];
                break;
            case 2:
                $fieldsToValidate = ['selectedVehicle', 'service_type'];
                break;
            case 3:
                $fieldsToValidate = [
                    'arrival_date', 'arrival_time', 'arrival_airline', 'arrival_flight',
                    'pickup_date', 'pickup_time'
                ];
                if ($this->service_type === 'round-trip') {
                    $fieldsToValidate = array_merge($fieldsToValidate, [
                        'departure_date', 'departure_time', 'departure_airline', 'departure_flight'
                    ]);
                }
                break;
        }

        $this->validate(array_intersect_key($rules, array_flip($fieldsToValidate)));

        if ($this->step === 3) {
            $validator = \Validator::make(
                $this->all(),
                [],
                $this->messages()
            );

            $this->validatePickupTime($validator);
            $this->validateTimeBetweenFlights($validator);

            if ($validator->fails()) {
                $this->setErrorBag($validator->errors());
                return false;
            }
        }

        return true;
    }

    #[On('vehicle-selected')]
    public function vehicleSelected($vehicle)
    {
        $this->selectedVehicle = Vehicle::find($vehicle['id']);
    }

    public function nextStep()
    {
        if (!$this->validateStep()) {
            return;
        }

        if ($this->step < $this->totalSteps) {
            $this->step++;
        }
    }

    public function previousStep()
    {
        if ($this->step > 1) {
            $this->step--;
        }
    }

    public function createReservation()
    {
        $this->validateStep();

        $reservation = Reservation::create([
            'client_name' => $this->client_name,
            'client_email' => $this->client_email,
            'client_phone' => $this->client_phone,
            'hotel' => $this->hotel,
            'destination' => $this->destination,
            'vehicle_id' => $this->selectedVehicle->id,
            'service_type' => $this->service_type,
            'arrival_date' => $this->arrival_date,
            'arrival_time' => $this->arrival_time,
            'arrival_airline' => $this->arrival_airline,
            'arrival_flight' => $this->arrival_flight,
            'departure_date' => $this->service_type === 'round-trip' ? $this->departure_date : null,
            'departure_time' => $this->service_type === 'round-trip' ? $this->departure_time : null,
            'departure_airline' => $this->service_type === 'round-trip' ? $this->departure_airline : null,
            'departure_flight' => $this->service_type === 'round-trip' ? $this->departure_flight : null,
            'pickup_date' => $this->pickup_date,
            'pickup_time' => $this->pickup_time,
            'number_passengers' => $this->number_passengers,
            'price_normal' => $this->selectedVehicle->price_normal,
            'price_paypal' => $this->selectedVehicle->price_paypal,
            'comments' => $this->comments,
            'status' => 'pending'
        ]);

        // Aquí se enviará el email de confirmación
        
        session()->flash('message', 'Reservación creada exitosamente. Número de reservación: ' . $reservation->reservation_number);
        
        return redirect()->route('reservations.confirmation', $reservation);
    }

    public function render()
    {
        return view('livewire.reservation-wizard');
    }
}
