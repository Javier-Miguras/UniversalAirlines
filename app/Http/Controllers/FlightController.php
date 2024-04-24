<?php

namespace App\Http\Controllers;

use App\Models\Flight;


class FlightController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('flights.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('flights.create');
    }

    /**
     * Display the specified resource.
     */
    public function show(Flight $flight)
    {
        return view('flights.show', [
            'flight' => $flight
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Flight $flight)
    {
        return view('flights.edit', [
            'flight' => $flight
        ]);
    }

    public function passengers(Flight $flight)
    {
        return view('flights.passengers', [
            'flight' => $flight
        ]);
    }
}
