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
    public $dateFilter = 'pickup'; // pickup, arrival, departure
    public $sortField = 'created_at';
    public $sortDirection = 'desc';
    
    // Reservación seleccionada
    public $selectedReservation = null;

    // Filtros por fecha
    public $startDate = '';
    public $endDate = '';

    protected $queryString = [
        'search' => ['except' => ''],
        'status' => ['except' => ''],
        'dateRange' => ['except' => ''],
        'dateFilter' => ['except' => 'pickup'],
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

    public function showDetails($id)
    {
        $this->selectedReservation = Reservation::with('vehicle')->find($id);
        $this->dispatch('open-details-modal');
    }

    public function edit($id)
    {
        $this->selectedReservation = Reservation::find($id);
        $this->dispatch('open-edit-modal');
    }

    public function confirmDelete($id)
    {
        $this->selectedReservation = Reservation::find($id);
        $this->dispatch('open-delete-modal');
    }

    public function deleteReservation()
    {
        if ($this->selectedReservation) {
            $this->selectedReservation->delete();
            $this->selectedReservation = null;
            $this->dispatch('close-delete-modal');
            session()->flash('message', 'Reservación eliminada correctamente.');
        }
    }

    public function getReservationsProperty()
    {
        return Reservation::query()
            ->when($this->search, function ($query) {
                $query->where(function ($q) {
                    $q->where('client_name', 'like', '%' . $this->search . '%')
                      ->orWhere('client_email', 'like', '%' . $this->search . '%')
                      ->orWhere('client_phone', 'like', '%' . $this->search . '%')
                      ->orWhere('reservation_number', 'like', '%' . $this->search . '%');
                });
            })
            ->when($this->status, function ($query) {
                $query->where('status', $this->status);
            })
            ->when($this->dateRange, function ($query) {
                [$start, $end] = explode(' to ', $this->dateRange);
                $query->whereBetween($this->dateFilter . '_date', [
                    Carbon::parse($start)->startOfDay(),
                    Carbon::parse($end)->endOfDay(),
                ]);
            })
            ->orderBy($this->sortField, $this->sortDirection)
            ->paginate(10);
    }

    public function getTotalReservationsProperty()
    {
        return Reservation::count();
    }

    public function getPendingReservationsProperty()
    {
        return Reservation::where('status', 'pending')->count();
    }

    public function getConfirmedReservationsProperty()
    {
        return Reservation::where('status', 'confirmed')->count();
    }

    public function getCompletedReservationsProperty()
    {
        return Reservation::where('status', 'completed')->count();
    }

    public function render()
    {
        return view('livewire.admin.reservation-manager', [
            'reservations' => $this->reservations,
            'totalReservations' => $this->totalReservations,
            'pendingReservations' => $this->pendingReservations,
            'confirmedReservations' => $this->confirmedReservations,
            'completedReservations' => $this->completedReservations,
        ]);
    }
}
