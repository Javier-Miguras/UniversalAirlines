<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PagesController;
use App\Http\Controllers\FlightController;
use App\Http\Controllers\PaypalController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TicketsController;

//Public zone
Route::get('/', [PagesController::class, 'index'])->name('home');

//Flights
Route::get('/dashboard', [FlightController::class, 'index'])->middleware(['auth', 'verified'])->name('flights.index');
Route::get('/flights/create', [FlightController::class, 'create'])->middleware(['auth', 'verified', 'admin'])->name('flights.create');
Route::get('/flights/{flight}/edit', [FlightController::class, 'edit'])->middleware(['auth', 'verified', 'admin'])->name('flights.edit');
Route::get('/flights/{flight}', [FlightController::class, 'show'])->name('flights.show');
Route::get('/flights/{flight}/passengers', [FlightController::class, 'passengers'])->middleware(['auth', 'verified', 'admin'])->name('flights.passengers');

//Tickets
Route::get('/tickets/{ticket}', TicketsController::class)->middleware('auth', 'verified')->name('tickets.index');

//Paypal
Route::post('/paypal', [PaypalController::class, 'paypal'])->middleware(['auth', 'verified'])->name('paypal');
Route::get('/success', [PaypalController::class, 'success'])->middleware(['auth', 'verified'])->name('success');
Route::get('/cancel', [PaypalController::class, 'cancel'])->middleware(['auth', 'verified'])->name('cancel');

//Profile
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
