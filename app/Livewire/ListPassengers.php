<?php

namespace App\Livewire;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class ListPassengers extends Component
{
    use WithPagination;

    public $flight;

    public function render()
    {
        $passengers = User::whereIn('id', $this->flight->passengers->pluck('id'))->paginate(20);

        return view('livewire.list-passengers', [
            'passengers' => $passengers
        ]);
    }
}
