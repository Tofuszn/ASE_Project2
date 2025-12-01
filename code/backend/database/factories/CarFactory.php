<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Car>
 */
class CarFactory extends Factory
{
    public function definition(): array
    {
        return [
            'make' => 'Toyota',
            'model' => 'Supra',
            'year' => 2021,
            'price' => 55000,
            'status' => 'available',
        ];
    }
}
