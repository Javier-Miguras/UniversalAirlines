<?php

namespace App\Livewire;

use Livewire\Component;

class FlightBooking extends Component
{
    public $flight;
    public $showSeats = false;
    public $selectedSeats = [];

    public function render()
    {
        return view('livewire.flight-booking');
    }

    public function toggleSeatSelection($seat)
    {
        if (in_array($seat, $this->selectedSeats)) {
            $this->selectedSeats = array_diff($this->selectedSeats, [$seat]);
        } else {
            $this->selectedSeats[] = $seat;
        }
    }

}
