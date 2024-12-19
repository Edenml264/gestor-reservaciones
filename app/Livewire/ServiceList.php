<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Service;

class ServiceList extends Component
{
    public function render()
    {
        $services = Service::where('active', true)
            ->orderBy('name')
            ->get();

        return view('livewire.service-list', [
            'services' => $services
        ]);
    }
}
