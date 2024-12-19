<?php

namespace App\Livewire;

use App\Models\Vehicle;
use Livewire\Component;
use Livewire\Attributes\On;

class VehicleSelector extends Component
{
    public $selectedVehicle = null;
    public $passengers = 1;
    public $vehicles = [];
    public $filteredVehicles = [];

    public function mount()
    {
        $this->vehicles = Vehicle::where('active', true)->get();
        $this->filterVehicles();
    }

    public function updatedPassengers()
    {
        $this->filterVehicles();
    }

    public function filterVehicles()
    {
        $this->filteredVehicles = $this->vehicles->filter(function ($vehicle) {
            return $vehicle->capacity >= $this->passengers;
        })->values();
    }

    public function selectVehicle($vehicleId)
    {
        $this->selectedVehicle = $this->vehicles->find($vehicleId);
        $this->dispatch('vehicle-selected', vehicle: $this->selectedVehicle);
    }

    public function render()
    {
        return view('livewire.vehicle-selector');
    }
}
