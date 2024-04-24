<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Flight extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'origin',
        'destination',
        'price',
        'date',
        'departure_time',
        'arrival_time',
        'departure_terminal',
        'arrival_terminal',
        'total_seats',
        'available_seats'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'price' => 'decimal:2', // Price is casted to decimal with 2 decimal places
        'date' => 'date', // Date is casted to date type
    ];

    public function passengers()
    {
        return $this->belongsToMany(User::class, 'tickets', 'flight_id', 'user_id')->distinct();
    }

    public function seats()
    {
        return $this->hasMany(Ticket::class);
    }

}
