<div class="bg-white rounded-lg shadow-lg p-6">
    <div class="mb-6">
        <label for="passengers" class="block text-sm font-medium text-gray-700">Número de Pasajeros</label>
        <input type="number" 
               wire:model.live="passengers" 
               min="1" 
               max="20" 
               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
               id="passengers">
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach($filteredVehicles as $vehicle)
            <div class="relative border rounded-lg p-4 {{ $selectedVehicle?->id === $vehicle->id ? 'border-indigo-500 ring-2 ring-indigo-500' : 'border-gray-200' }}"
                 wire:click="selectVehicle({{ $vehicle->id }})">
                @if($vehicle->image_url)
                    <img src="{{ $vehicle->image_url }}" 
                         alt="{{ $vehicle->name }}" 
                         class="w-full h-48 object-cover rounded-lg mb-4">
                @endif
                
                <h3 class="text-lg font-semibold text-gray-900">{{ $vehicle->name }}</h3>
                <p class="text-sm text-gray-500 mb-2">Capacidad: {{ $vehicle->capacity }} pasajeros</p>
                
                <div class="flex justify-between items-center mt-4">
                    <div>
                        <p class="text-lg font-bold text-gray-900">${{ number_format($vehicle->price_normal, 2) }}</p>
                        <p class="text-sm text-gray-500">Efectivo</p>
                    </div>
                    <div class="text-right">
                        <p class="text-lg font-bold text-gray-900">${{ number_format($vehicle->price_paypal, 2) }}</p>
                        <p class="text-sm text-gray-500">PayPal</p>
                    </div>
                </div>

                @if($selectedVehicle?->id === $vehicle->id)
                    <div class="absolute top-2 right-2">
                        <svg class="h-6 w-6 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                    </div>
                @endif
            </div>
        @endforeach
    </div>

    @if($filteredVehicles->isEmpty())
        <div class="text-center py-8">
            <p class="text-gray-500">No hay vehículos disponibles para {{ $passengers }} pasajeros.</p>
            <p class="text-sm text-gray-400 mt-2">Por favor, ajusta el número de pasajeros o contacta con nosotros para opciones personalizadas.</p>
        </div>
    @endif
</div>
