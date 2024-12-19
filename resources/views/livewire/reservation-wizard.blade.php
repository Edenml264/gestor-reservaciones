<div class="max-w-4xl mx-auto">
    <div class="mb-8">
        <div class="flex justify-between items-center mb-4">
            @for($i = 1; $i <= $totalSteps; $i++)
                <div class="flex items-center">
                    <div class="w-8 h-8 rounded-full flex items-center justify-center {{ $step >= $i ? 'bg-indigo-600 text-white' : 'bg-gray-200 text-gray-600' }}">
                        {{ $i }}
                    </div>
                    <span class="ml-2 text-sm font-medium {{ $step >= $i ? 'text-indigo-600' : 'text-gray-500' }}">
                        {{ $i === 1 ? 'Información Personal' : ($i === 2 ? 'Selección de Vehículo' : 'Detalles del Viaje') }}
                    </span>
                </div>
                @if($i < $totalSteps)
                    <div class="flex-1 h-0.5 mx-4 {{ $step > $i ? 'bg-indigo-600' : 'bg-gray-200' }}"></div>
                @endif
            @endfor
        </div>
    </div>

    <div class="bg-white shadow rounded-lg p-6">
        @if($step === 1)
            <div class="space-y-6">
                <div>
                    <label for="client_name" class="block text-sm font-medium text-gray-700">Nombre Completo</label>
                    <input type="text" 
                           wire:model="client_name" 
                           id="client_name"
                           class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                    @error('client_name') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label for="client_email" class="block text-sm font-medium text-gray-700">Email</label>
                    <input type="email" 
                           wire:model="client_email" 
                           id="client_email"
                           class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                    @error('client_email') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label for="client_phone" class="block text-sm font-medium text-gray-700">Teléfono</label>
                    <input type="tel" 
                           wire:model="client_phone" 
                           id="client_phone"
                           class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                    @error('client_phone') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label for="hotel" class="block text-sm font-medium text-gray-700">Hotel</label>
                    <input type="text" 
                           wire:model="hotel" 
                           id="hotel"
                           class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                    @error('hotel') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label for="destination" class="block text-sm font-medium text-gray-700">Destino</label>
                    <input type="text" 
                           wire:model="destination" 
                           id="destination"
                           class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                    @error('destination') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label for="number_passengers" class="block text-sm font-medium text-gray-700">Número de Pasajeros</label>
                    <input type="number" 
                           wire:model="number_passengers" 
                           id="number_passengers"
                           min="1"
                           class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                    @error('number_passengers') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                </div>
            </div>
        @elseif($step === 2)
            <div class="space-y-6">
                <div class="mb-6">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Tipo de Servicio</label>
                    <div class="flex space-x-4">
                        <label class="inline-flex items-center">
                            <input type="radio" 
                                   wire:model="service_type" 
                                   value="one-way"
                                   class="form-radio text-indigo-600">
                            <span class="ml-2">Sencillo</span>
                        </label>
                        <label class="inline-flex items-center">
                            <input type="radio" 
                                   wire:model="service_type" 
                                   value="round-trip"
                                   class="form-radio text-indigo-600">
                            <span class="ml-2">Redondo</span>
                        </label>
                    </div>
                </div>

                <livewire:vehicle-selector />
                @error('vehicle') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
            </div>
        @else
            <div class="space-y-6">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="arrival_date" class="block text-sm font-medium text-gray-700">Fecha de Llegada</label>
                        <input type="date" 
                               wire:model="arrival_date" 
                               id="arrival_date"
                               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                        @error('arrival_date') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label for="arrival_time" class="block text-sm font-medium text-gray-700">Hora de Llegada</label>
                        <input type="time" 
                               wire:model="arrival_time" 
                               id="arrival_time"
                               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                        @error('arrival_time') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label for="arrival_airline" class="block text-sm font-medium text-gray-700">Aerolínea de Llegada</label>
                        <input type="text" 
                               wire:model="arrival_airline" 
                               id="arrival_airline"
                               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                        @error('arrival_airline') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label for="arrival_flight" class="block text-sm font-medium text-gray-700">Número de Vuelo de Llegada</label>
                        <input type="text" 
                               wire:model="arrival_flight" 
                               id="arrival_flight"
                               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                        @error('arrival_flight') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>

                    @if($service_type === 'round-trip')
                        <div>
                            <label for="departure_date" class="block text-sm font-medium text-gray-700">Fecha de Salida</label>
                            <input type="date" 
                                   wire:model="departure_date" 
                                   id="departure_date"
                                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                            @error('departure_date') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                        </div>

                        <div>
                            <label for="departure_time" class="block text-sm font-medium text-gray-700">Hora de Salida</label>
                            <input type="time" 
                                   wire:model="departure_time" 
                                   id="departure_time"
                                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                            @error('departure_time') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                        </div>

                        <div>
                            <label for="departure_airline" class="block text-sm font-medium text-gray-700">Aerolínea de Salida</label>
                            <input type="text" 
                                   wire:model="departure_airline" 
                                   id="departure_airline"
                                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                            @error('departure_airline') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                        </div>

                        <div>
                            <label for="departure_flight" class="block text-sm font-medium text-gray-700">Número de Vuelo de Salida</label>
                            <input type="text" 
                                   wire:model="departure_flight" 
                                   id="departure_flight"
                                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                            @error('departure_flight') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                        </div>
                    @endif

                    <div>
                        <label for="pickup_date" class="block text-sm font-medium text-gray-700">Fecha de Recogida</label>
                        <input type="date" 
                               wire:model="pickup_date" 
                               id="pickup_date"
                               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                        @error('pickup_date') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label for="pickup_time" class="block text-sm font-medium text-gray-700">Hora de Recogida</label>
                        <input type="time" 
                               wire:model="pickup_time" 
                               id="pickup_time"
                               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                        @error('pickup_time') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>
                </div>

                <div>
                    <label for="comments" class="block text-sm font-medium text-gray-700">Comentarios Adicionales</label>
                    <textarea wire:model="comments" 
                              id="comments"
                              rows="3"
                              class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"></textarea>
                </div>
            </div>
        @endif

        <div class="mt-8 flex justify-between">
            @if($step > 1)
                <button wire:click="previousStep" 
                        class="bg-gray-200 py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-gray-700 hover:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500">
                    Anterior
                </button>
            @else
                <div></div>
            @endif

            @if($step < $totalSteps)
                <button wire:click="nextStep" 
                        class="bg-indigo-600 py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                    Siguiente
                </button>
            @else
                <button wire:click="createReservation" 
                        class="bg-green-600 py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                    Completar Reservación
                </button>
            @endif
        </div>
    </div>
</div>
