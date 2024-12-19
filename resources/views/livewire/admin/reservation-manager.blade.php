<div>
    <!-- Estadísticas -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-6">
        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-indigo-600 bg-opacity-75">
                    <svg class="h-8 w-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                    </svg>
                </div>
                <div class="ml-4">
                    <p class="mb-2 text-sm font-medium text-gray-600">Total Reservaciones</p>
                    <p class="text-lg font-semibold text-gray-700">{{ $totalReservations }}</p>
                </div>
            </div>
        </div>
        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-yellow-600 bg-opacity-75">
                    <svg class="h-8 w-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <div class="ml-4">
                    <p class="mb-2 text-sm font-medium text-gray-600">Pendientes</p>
                    <p class="text-lg font-semibold text-gray-700">{{ $pendingReservations }}</p>
                </div>
            </div>
        </div>
        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-green-600 bg-opacity-75">
                    <svg class="h-8 w-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <div class="ml-4">
                    <p class="mb-2 text-sm font-medium text-gray-600">Confirmadas</p>
                    <p class="text-lg font-semibold text-gray-700">{{ $confirmedReservations }}</p>
                </div>
            </div>
        </div>
        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-blue-600 bg-opacity-75">
                    <svg class="h-8 w-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                </div>
                <div class="ml-4">
                    <p class="mb-2 text-sm font-medium text-gray-600">Completadas</p>
                    <p class="text-lg font-semibold text-gray-700">{{ $completedReservations }}</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Filtros -->
    <div class="bg-white rounded-lg shadow mb-6">
        <div class="p-4">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700">Buscar</label>
                    <input wire:model.live="search" type="text" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" placeholder="Nombre, email, teléfono...">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Estado</label>
                    <select wire:model.live="status" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                        <option value="">Todos</option>
                        <option value="pending">Pendiente</option>
                        <option value="confirmed">Confirmada</option>
                        <option value="completed">Completada</option>
                        <option value="cancelled">Cancelada</option>
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Filtrar por Fecha</label>
                    <select wire:model.live="dateFilter" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                        <option value="arrival">Llegada</option>
                        <option value="departure">Salida</option>
                        <option value="pickup">Recogida</option>
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Rango de Fechas</label>
                    <input wire:model.live="dateRange" type="text" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" placeholder="Seleccionar fechas">
                </div>
            </div>
        </div>
    </div>

    <!-- Tabla -->
    <div class="bg-white shadow-sm rounded-lg overflow-hidden">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th wire:click="sortBy('id')" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider cursor-pointer">
                        ID
                        @if ($sortField === 'id')
                            <span class="ml-1">{{ $sortDirection === 'asc' ? '↑' : '↓' }}</span>
                        @endif
                    </th>
                    <th wire:click="sortBy('client_name')" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider cursor-pointer">
                        Cliente
                        @if ($sortField === 'client_name')
                            <span class="ml-1">{{ $sortDirection === 'asc' ? '↑' : '↓' }}</span>
                        @endif
                    </th>
                    <th wire:click="sortBy('pickup_date')" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider cursor-pointer">
                        Fecha de Recogida
                        @if ($sortField === 'pickup_date')
                            <span class="ml-1">{{ $sortDirection === 'asc' ? '↑' : '↓' }}</span>
                        @endif
                    </th>
                    <th wire:click="sortBy('status')" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider cursor-pointer">
                        Estado
                        @if ($sortField === 'status')
                            <span class="ml-1">{{ $sortDirection === 'asc' ? '↑' : '↓' }}</span>
                        @endif
                    </th>
                    <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Acciones
                    </th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @forelse ($reservations as $reservation)
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                            {{ $reservation->reservation_number }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm font-medium text-gray-900">{{ $reservation->client_name }}</div>
                            <div class="text-sm text-gray-500">{{ $reservation->client_email }}</div>
                            <div class="text-sm text-gray-500">{{ $reservation->client_phone }}</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm text-gray-900">{{ $reservation->pickup_date }}</div>
                            <div class="text-sm text-gray-500">{{ $reservation->pickup_time }}</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full
                                @if($reservation->status === 'pending') bg-yellow-100 text-yellow-800
                                @elseif($reservation->status === 'confirmed') bg-green-100 text-green-800
                                @elseif($reservation->status === 'completed') bg-blue-100 text-blue-800
                                @else bg-red-100 text-red-800
                                @endif">
                                {{ ucfirst($reservation->status) }}
                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                            <button wire:click="showDetails({{ $reservation->id }})" class="text-indigo-600 hover:text-indigo-900 mr-3">
                                Ver
                            </button>
                            <button wire:click="edit({{ $reservation->id }})" class="text-blue-600 hover:text-blue-900 mr-3">
                                Editar
                            </button>
                            <button wire:click="confirmDelete({{ $reservation->id }})" class="text-red-600 hover:text-red-900">
                                Eliminar
                            </button>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 text-center">
                            No hay reservaciones que coincidan con los filtros.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        <div class="px-4 py-3 border-t border-gray-200">
            {{ $reservations->links() }}
        </div>
    </div>

    <!-- Modal de Detalles -->
    <div x-data="{ show: false }" 
         x-show="show" 
         x-on:open-details-modal.window="show = true"
         x-on:close-details-modal.window="show = false"
         x-cloak
         class="fixed inset-0 overflow-y-auto" 
         style="display: none;">
        <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
            <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity"></div>
            <span class="hidden sm:inline-block sm:align-middle sm:h-screen">&#8203;</span>
            <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                @if($selectedReservation)
                    <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                        <!-- Contenido del modal -->
                    </div>
                    <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                        <button type="button" @click="show = false" class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                            Cerrar
                        </button>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <!-- Modal de Edición -->
    <div x-data="{ show: false }" 
         x-show="show" 
         x-on:open-edit-modal.window="show = true"
         x-on:close-edit-modal.window="show = false"
         x-cloak
         class="fixed inset-0 overflow-y-auto" 
         style="display: none;">
        <!-- Similar al modal de detalles -->
    </div>

    <!-- Modal de Confirmación de Eliminación -->
    <div x-data="{ show: false }" 
         x-show="show" 
         x-on:open-delete-modal.window="show = true"
         x-on:close-delete-modal.window="show = false"
         x-cloak
         class="fixed inset-0 overflow-y-auto" 
         style="display: none;">
        <!-- Similar al modal de detalles -->
    </div>
</div>
