<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Flight>
 */
class FlightFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $origins = ['Rome', 'Los Angeles', 'London', 'Paris', 'Tokyo', 'Berlin', 'Santiago', 'Buenos Aires', 'Lima', 'Rio de Janeiro', 'Beijing', 'Ottawa', 'Canberra', 'Wellington', 'Damasco', 'Nueva Delhi'];
        $destinations = ['Rome', 'Los Angeles', 'London', 'Paris', 'Tokyo', 'Berlin', 'Santiago', 'Buenos Aires', 'Lima', 'Rio de Janeiro', 'Beijing', 'Ottawa', 'Canberra', 'Wellington', 'Damasco', 'Nueva Delhi'];
        $terminals = ['Downtown Airport', 'Capital Airport', 'National Airport', 'Cosmopolitan Airport'];
        $price = $this->faker->randomFloat(2, 100, 1000); // Random price between 100 and 1000
        $date = $this->faker->dateTimeBetween('now', '+1 year')->format('Y-m-d'); // Random date within the next year
        $departureTime = $this->faker->time('H:i');
        $arrivalTime = $this->faker->time('H:i');
        $totalSeats = $this->faker->numberBetween(100, 400);
        $availableSeats = $totalSeats;

        return [
            'origin' => $this->faker->randomElement($origins),
            'destination' => $this->faker->randomElement($destinations),
            'price' => $price,
            'date' => $date,
            'departure_time' => $departureTime,
            'arrival_time' => $arrivalTime,
            'departure_terminal' => $this->faker->randomElement($terminals),
            'arrival_terminal' => $this->faker->randomElement($terminals),
            'total_seats' => $totalSeats,
            'available_seats' => $availableSeats
        ];
    }
}
