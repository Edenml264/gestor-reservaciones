<?php

namespace App\Livewire\Admin;

use App\Models\Reservation;
use Carbon\Carbon;
use Livewire\Component;
use Livewire\WithPagination;

class ReservationManager extends Component
{
    use WithPagination;

    // Filtros de búsqueda
    public $search = '';
    public $status = '';
    public $dateRange = '';
    public $dateFilter = 'arrival'; // arrival, departure, pickup
    public $sortField = 'created_at';
    public $sortDirection = 'desc';
    
    // Modales
    public $selectedReservation = null;
    public $showDeleteModal = false;
    public $showEditModal = false;
    public $showDetailsModal = false;

    // Filtros por fecha
    public $startDate = '';
    public $endDate = '';

    protected $queryString = [
        'search' => ['except' => ''],
        'status' => ['except' => ''],
        'dateRange' => ['except' => ''],
        'dateFilter' => ['except' => 'arrival'],
        'sortField' => ['except' => 'created_at'],
        'sortDirection' => ['except' => 'desc'],
    ];

    public function mount()
    {
        // Establecer fechas por defecto si no están definidas
        if (empty($this->dateRange)) {
            $this->startDate = Carbon::now()->startOfMonth()->format('Y-m-d');
            $this->endDate = Carbon::now()->endOfMonth()->format('Y-m-d');
            $this->dateRange = $this->startDate . ' to ' . $this->endDate;
        }
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function sortBy($field)
    {
        if ($this->sortField === $field) {
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortField = $field;
            $this->sortDirection = 'asc';
        }
    }

    public function updatedDateRange($value)
    {
        if ($value) {
            [$this->startDate, $this->endDate] = explode(' to ', $value);
        } else {
            $this->startDate = '';
            $this->endDate = '';
        }
        $this->resetPage();
    }

    public function confirmDelete($reservationId)
    {
        $this->selectedReservation = Reservation::find($reservationId);
        $this->showDeleteModal = true;
    }

    public function deleteReservation()
    {
        if ($this->selectedReservation) {
            $this->selectedReservation->delete();
            $this->showDeleteModal = false;
            $this->selectedReservation = null;
            $this->dispatch('notify', [
                'type' => 'success',
                'message' => 'Reservación eliminada exitosamente.'
            ]);
        }
    }

    public function editReservation($reservationId)
    {
        $this->selectedReservation = Reservation::find($reservationId);
        $this->showEditModal = true;
    }

    public function showDetails($reservationId)
    {
        $this->selectedReservation = Reservation::with(['vehicle'])->find($reservationId);
        $this->showDetailsModal = true;
    }

    public function getReservationsProperty()
    {
        return Reservation::query()
            ->when($this->search, function ($query) {
                $query->where(function ($query) {
                    $query->where('client_name', 'like', '%' . $this->search . '%')
                        ->orWhere('client_email', 'like', '%' . $this->search . '%')
                        ->orWhere('client_phone', 'like', '%' . $this->search . '%')
                        ->orWhere('hotel', 'like', '%' . $this->search . '%')
                        ->orWhere('destination', 'like', '%' . $this->search . '%');
                });
            })
            ->when($this->status, function ($query) {
                $query->where('status', $this->status);
            })
            ->when($this->dateRange, function ($query) {
                $query->whereBetween($this->dateFilter . '_date', [
                    $this->startDate,
                    $this->endDate
                ]);
            })
            ->orderBy($this->sortField, $this->sortDirection)
            ->paginate(10);
    }

    public function exportToExcel()
    {
        return response()->streamDownload(function () {
            $reservations = $this->reservationsProperty;
            $headers = [
                'ID',
                'Cliente',
                'Email',
                'Teléfono',
                'Hotel',
                'Destino',
                'Fecha de Llegada',
                'Hora de Llegada',
                'Fecha de Salida',
                'Hora de Salida',
                'Estado',
                'Creado',
            ];

            $handle = fopen('php://output', 'w');
            fputcsv($handle, $headers);

            foreach ($reservations as $reservation) {
                fputcsv($handle, [
                    $reservation->id,
                    $reservation->client_name,
                    $reservation->client_email,
                    $reservation->client_phone,
                    $reservation->hotel,
                    $reservation->destination,
                    $reservation->arrival_date,
                    $reservation->arrival_time,
                    $reservation->departure_date,
                    $reservation->departure_time,
                    $reservation->status,
                    $reservation->created_at->format('Y-m-d H:i'),
                ]);
            }

            fclose($handle);
        }, 'reservaciones.csv');
    }

    public function render()
    {
        return view('livewire.admin.reservation-manager', [
            'reservations' => $this->reservations,
            'totalReservations' => Reservation::count(),
            'pendingReservations' => Reservation::where('status', 'pending')->count(),
            'confirmedReservations' => Reservation::where('status', 'confirmed')->count(),
            'completedReservations' => Reservation::where('status', 'completed')->count(),
        ]);
    }
}
