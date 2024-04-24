<?php

namespace App\Livewire;

use App\Models\Flight;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithoutUrlPagination;
use Illuminate\Database\Eloquent\Builder;

class ListFlights extends Component
{
    use WithPagination;

    public $buttons;
    public $searchOrigin;
    public $searchDestination;
    public $showFilters = false;
    public $filters = [
        'amount-min' => null,
        'amount-max' => null,
        'departure-date' => null
    ];

    public function render()
    {       
        return view('livewire.list-flights', [
            'flights' => Flight::query()
            ->when($this->filters['amount-min'], function ($query, $amountMin) {
                return $query->where('price', '>=', $amountMin);
            })
            ->when($this->filters['amount-max'], function ($query, $amountMax) {
                return $query->where('price', '<=', $amountMax);
            })
            ->when($this->filters['departure-date'], function ($query, $departureDate) {
                return $query->whereDate('date', 'like', $departureDate);
            })
            ->where(function ($query) {
                if ($this->searchDestination) {
                    $query->where('destination', 'like', '%'.$this->searchDestination.'%');
                }
                if ($this->searchOrigin) {
                    $query->where('origin', 'like', '%'.$this->searchOrigin.'%');
                }
            })
            ->search('origin', $this->searchOrigin)
            ->search('destination', $this->searchDestination)
            ->orderBy('date')
            ->paginate(20)
            
        ]);
    }

    public function resetFilters()
    {
        $this->reset('filters');
    }
}
