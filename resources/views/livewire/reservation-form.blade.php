<div class="bg-white p-6 rounded-lg shadow-lg">
    <h2 class="text-2xl font-bold mb-6">Reservar {{ $service->name }}</h2>

    @if (session()->has('message'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4">
            {{ session('message') }}
        </div>
    @endif

    <form wire:submit.prevent="saveReservation" class="space-y-4">
        <!-- Información del Cliente -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-medium text-gray-700">Nombre Completo</label>
                <input type="text" wire:model="client_name" 
                       class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                @error('client_name') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700">Email</label>
                <input type="email" wire:model="client_email" 
                       class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                @error('client_email') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700">Teléfono</label>
                <input type="tel" wire:model="client_phone" 
                       class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                @error('client_phone') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700">Vehículo</label>
                <select wire:model="vehicle_id" 
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                    <option value="">Seleccione un vehículo</option>
                    @foreach($vehicles as $vehicle)
                        <option value="{{ $vehicle->id }}">{{ $vehicle->name }} ({{ $vehicle->capacity }} pasajeros)</option>
                    @endforeach
                </select>
                @error('vehicle_id') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
            </div>
        </div>

        <!-- Detalles del Servicio -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-medium text-gray-700">Tipo de Servicio</label>
                <select wire:model="service_type" 
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                    <option value="one-way">Un solo viaje</option>
                    <option value="round-trip">Viaje redondo</option>
                </select>
                @error('service_type') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700">Número de Pasajeros</label>
                <input type="number" wire:model="number_passengers" min="1" 
                       class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                @error('number_passengers') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700">Fecha de Recogida</label>
                <input type="date" wire:model="pickup_date" 
                       class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                @error('pickup_date') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700">Hora de Recogida</label>
                <input type="time" wire:model="pickup_time" 
                       class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                @error('pickup_time') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
            </div>
        </div>

        <!-- Comentarios -->
        <div>
            <label class="block text-sm font-medium text-gray-700">Comentarios Adicionales</label>
            <textarea wire:model="comments" rows="3" 
                      class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"></textarea>
            @error('comments') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
        </div>

        <!-- Precio -->
        <div class="bg-gray-50 p-4 rounded-md">
            <div class="flex justify-between items-center">
                <span class="text-lg font-medium">Precio: ${{ number_format($service->price, 2) }}</span>
                <span class="text-sm text-gray-500">(+5% con PayPal: ${{ number_format($service->price * 1.05, 2) }})</span>
            </div>
        </div>

        <div class="flex justify-end">
            <button type="submit" 
                    class="bg-blue-600 text-white px-6 py-2 rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                Confirmar Reservación
            </button>
        </div>
    </form>
</div>
