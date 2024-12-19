<?php

namespace App\Livewire\Admin;

use App\Models\Service;
use Livewire\Component;
use Livewire\WithPagination;

class ServiceManager extends Component
{
    use WithPagination;

    public $search = '';
    public $selectedService = null;
    public $isCreating = false;
    public $isEditing = false;

    // Campos del formulario
    public $name = '';
    public $description = '';
    public $price = '';
    public $duration = '';
    public $is_active = true;

    protected $rules = [
        'name' => 'required|string|max:255',
        'description' => 'required|string',
        'price' => 'required|numeric|min:0',
        'duration' => 'required|integer|min:0',
        'is_active' => 'boolean'
    ];

    public function render()
    {
        $services = Service::query()
            ->when($this->search, function ($query) {
                $query->where('name', 'like', '%' . $this->search . '%')
                    ->orWhere('description', 'like', '%' . $this->search . '%');
            })
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('livewire.admin.service-manager', [
            'services' => $services
        ]);
    }

    public function create()
    {
        $this->resetValidation();
        $this->reset(['name', 'description', 'price', 'duration', 'is_active']);
        $this->isCreating = true;
        $this->dispatch('open-modal');
    }

    public function store()
    {
        $this->validate();

        Service::create([
            'name' => $this->name,
            'description' => $this->description,
            'price' => $this->price,
            'duration' => $this->duration,
            'is_active' => $this->is_active
        ]);

        $this->isCreating = false;
        $this->dispatch('close-modal');
        session()->flash('message', 'Servicio creado exitosamente.');
    }

    public function edit(Service $service)
    {
        $this->resetValidation();
        $this->selectedService = $service;
        $this->name = $service->name;
        $this->description = $service->description;
        $this->price = $service->price;
        $this->duration = $service->duration;
        $this->is_active = $service->is_active;
        $this->isEditing = true;
        $this->dispatch('open-modal');
    }

    public function update()
    {
        $this->validate();

        $this->selectedService->update([
            'name' => $this->name,
            'description' => $this->description,
            'price' => $this->price,
            'duration' => $this->duration,
            'is_active' => $this->is_active
        ]);

        $this->isEditing = false;
        $this->dispatch('close-modal');
        session()->flash('message', 'Servicio actualizado exitosamente.');
    }

    public function confirmDelete(Service $service)
    {
        $this->selectedService = $service;
        $this->dispatch('open-delete-modal');
    }

    public function delete()
    {
        $this->selectedService->delete();
        $this->selectedService = null;
        $this->dispatch('close-delete-modal');
        session()->flash('message', 'Servicio eliminado exitosamente.');
    }

    public function closeModal()
    {
        $this->isCreating = false;
        $this->isEditing = false;
        $this->selectedService = null;
        $this->resetValidation();
        $this->reset(['name', 'description', 'price', 'duration', 'is_active']);
    }
}
