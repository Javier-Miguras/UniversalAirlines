<?php

namespace App\Livewire;

use App\Models\Flight;
use Illuminate\Support\Carbon;
use Livewire\Component;

class EditFlight extends Component
{   
    public $flight_id;
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
        'total_seats' => 'required|int',
        'available_seats' => 'required|int'
    ];

    public function mount(Flight $flight)
    {
        $this->flight_id = $flight->id;
        $this->date = Carbon::parse($flight->date)->format('Y-m-d');
        $this->origin = $flight->origin;
        $this->destination = $flight->destination;
        $this->price = $flight->price;
        $this->departure_time = $flight->departure_time;
        $this->arrival_time = $flight->arrival_time;
        $this->departure_terminal = $flight->departure_terminal;
        $this->arrival_terminal = $flight->arrival_terminal;
        $this->total_seats = $flight->total_seats;
        $this->available_seats = $flight->available_seats;
    }

    public function editFlight()
    {
        $data = $this->validate();

        $flight = Flight::find($this->flight_id);

        $flight->date = $data['date'];
        $flight->origin = $data['origin'];
        $flight->destination = $data['destination'];
        $flight->price = $data['price'];
        $flight->departure_time = $data['departure_time'];
        $flight->arrival_time = $data['arrival_time'];
        $flight->departure_terminal = $data['departure_terminal'];
        $flight->arrival_terminal = $data['arrival_terminal'];
        $flight->total_seats = $data['total_seats'];
        $flight->available_seats = $data['total_seats'];

        $flight->save();

        session()->flash('message', 'Flight updated successfully');

        return redirect()->route('flights.index');
    }

    public function render()
    {
        return view('livewire.edit-flight');
    }
}
