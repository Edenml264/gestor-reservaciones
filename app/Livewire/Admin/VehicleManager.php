<?php

namespace App\Livewire\Admin;

use App\Models\Vehicle;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;

class VehicleManager extends Component
{
    use WithPagination, WithFileUploads;

    public $search = '';
    public $selectedVehicle = null;
    public $isCreating = false;
    public $isEditing = false;

    // Campos del formulario
    public $name = '';
    public $description = '';
    public $capacity = '';
    public $price_per_day = '';
    public $is_active = true;
    public $photo;

    protected $rules = [
        'name' => 'required|string|max:255',
        'description' => 'required|string',
        'capacity' => 'required|integer|min:1',
        'price_per_day' => 'required|numeric|min:0',
        'is_active' => 'boolean',
        'photo' => 'nullable|image|max:1024' // 1MB máximo
    ];

    public function render()
    {
        $vehicles = Vehicle::query()
            ->when($this->search, function ($query) {
                $query->where('name', 'like', '%' . $this->search . '%')
                    ->orWhere('description', 'like', '%' . $this->search . '%');
            })
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('livewire.admin.vehicle-manager', [
            'vehicles' => $vehicles
        ]);
    }

    public function create()
    {
        $this->resetValidation();
        $this->reset(['name', 'description', 'capacity', 'price_per_day', 'is_active', 'photo']);
        $this->isCreating = true;
        $this->dispatch('open-modal');
    }

    public function store()
    {
        $this->validate();

        $vehicle = Vehicle::create([
            'name' => $this->name,
            'description' => $this->description,
            'capacity' => $this->capacity,
            'price_per_day' => $this->price_per_day,
            'is_active' => $this->is_active
        ]);

        if ($this->photo) {
            $vehicle->addMedia($this->photo->getRealPath())
                   ->usingName($this->photo->getClientOriginalName())
                   ->toMediaCollection('vehicles');
        }

        $this->isCreating = false;
        $this->dispatch('close-modal');
        session()->flash('message', 'Vehículo creado exitosamente.');
    }

    public function edit(Vehicle $vehicle)
    {
        $this->resetValidation();
        $this->selectedVehicle = $vehicle;
        $this->name = $vehicle->name;
        $this->description = $vehicle->description;
        $this->capacity = $vehicle->capacity;
        $this->price_per_day = $vehicle->price_per_day;
        $this->is_active = $vehicle->is_active;
        $this->isEditing = true;
        $this->dispatch('open-modal');
    }

    public function update()
    {
        $this->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'capacity' => 'required|integer|min:1',
            'price_per_day' => 'required|numeric|min:0',
            'is_active' => 'boolean',
            'photo' => 'nullable|image|max:1024'
        ]);

        $this->selectedVehicle->update([
            'name' => $this->name,
            'description' => $this->description,
            'capacity' => $this->capacity,
            'price_per_day' => $this->price_per_day,
            'is_active' => $this->is_active
        ]);

        if ($this->photo) {
            $this->selectedVehicle->clearMediaCollection('vehicles');
            $this->selectedVehicle->addMedia($this->photo->getRealPath())
                                ->usingName($this->photo->getClientOriginalName())
                                ->toMediaCollection('vehicles');
        }

        $this->isEditing = false;
        $this->dispatch('close-modal');
        session()->flash('message', 'Vehículo actualizado exitosamente.');
    }

    public function confirmDelete(Vehicle $vehicle)
    {
        $this->selectedVehicle = $vehicle;
        $this->dispatch('open-delete-modal');
    }

    public function delete()
    {
        $this->selectedVehicle->delete();
        $this->selectedVehicle = null;
        $this->dispatch('close-delete-modal');
        session()->flash('message', 'Vehículo eliminado exitosamente.');
    }

    public function closeModal()
    {
        $this->isCreating = false;
        $this->isEditing = false;
        $this->selectedVehicle = null;
        $this->resetValidation();
        $this->reset(['name', 'description', 'capacity', 'price_per_day', 'is_active', 'photo']);
    }
}
