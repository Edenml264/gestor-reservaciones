<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Service; // Added this line to import the Service model

class ServiceList extends Component
{
    public function render()
    {
        return view('livewire.service-list', [
            'services' => Service::where('active', true)
                ->orderBy('name')
                ->get()
        ]);
    }
}
