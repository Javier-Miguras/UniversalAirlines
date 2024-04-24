<?php

namespace App\Livewire;

use App\Models\Flight;
use Livewire\Component;

class CreateFlight extends Component
{
    public $date;
    public $origin;
    public $destination;
    public $price;
    public $departure_time;
    public $arrival_time;
    public $departure_terminal;
    public $arrival_terminal;
    public $total_seats;
    public $available_seats;

    protected $rules = [
        'date' => 'required|date',
        'origin'=> 'required|string',
        'destination' => 'required|string',
        'price' => 'required',
        'departure_time' => 'required',
        'arrival_time' => 'required',
        'departure_terminal' => 'required|string',
        'arrival_terminal' => 'required|string',
        'total_seats' => 'required|int'
    ];

    public function createFlight()
    {
        $data = $this->validate();

        Flight::create([
            'date' => $data['date'],
            'origin'=> $data['origin'],
            'destination' => $data['destination'],
            'price' => $data['price'],
            'departure_time' => $data['departure_time'],
            'arrival_time' => $data['arrival_time'],
            'departure_terminal' => $data['departure_terminal'],
            'arrival_terminal' => $data['arrival_terminal'],
            'total_seats' => $data['total_seats'],
            'available_seats' => $data['total_seats']
        ]);

        session()->flash('message', 'Flight created successfully');

        return redirect()->route('flights.index');
    }

    public function render()
    {
        return view('livewire.create-flight');
    }
}
