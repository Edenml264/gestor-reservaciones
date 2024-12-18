<div class="max-w-2xl mx-auto px-4 py-8">
    <h2 class="text-3xl font-bold text-gray-800 mb-6">Reservar {{ $service->name }}</h2>

    @if (session()->has('message'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
            <span class="block sm:inline">{{ session('message') }}</span>
        </div>
    @endif

    <form wire:submit.prevent="saveReservation" class="space-y-6">
        <div>
            <label for="client_name" class="block text-sm font-medium text-gray-700">Nombre completo</label>
            <input type="text" id="client_name" wire:model="client_name" 
                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
            @error('client_name') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <div>
            <label for="client_email" class="block text-sm font-medium text-gray-700">Correo electrónico</label>
            <input type="email" id="client_email" wire:model="client_email" 
                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
            @error('client_email') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <div>
            <label for="client_phone" class="block text-sm font-medium text-gray-700">Teléfono</label>
            <input type="tel" id="client_phone" wire:model="client_phone" 
                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
            @error('client_phone') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <div>
            <label for="reservation_date" class="block text-sm font-medium text-gray-700">Fecha y hora</label>
            <input type="datetime-local" id="reservation_date" wire:model="reservation_date" 
                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
            @error('reservation_date') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <div>
            <label for="special_requests" class="block text-sm font-medium text-gray-700">Solicitudes especiales</label>
            <textarea id="special_requests" wire:model="special_requests" rows="3" 
                      class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"></textarea>
            @error('special_requests') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <div class="flex items-center justify-between">
            <span class="text-2xl font-bold text-gray-800">
                Precio: ${{ number_format($service->price, 2) }}
            </span>
            <button type="submit" 
                    class="bg-blue-500 hover:bg-blue-600 text-white font-semibold py-2 px-4 rounded">
                Confirmar Reservación
            </button>
        </div>
    </form>
</div>
