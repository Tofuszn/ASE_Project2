<?php

namespace Database\Seeders;

use App\Models\Car;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::updateOrCreate(
            ['username' => 'admin'],
            ['role' => 'admin', 'password' => 'Carlo']
        );

        collect([
            ['make' => 'Toyota', 'model' => 'Supra', 'year' => 2021, 'price' => 55000],
            ['make' => 'Ford', 'model' => 'Mustang', 'year' => 2020, 'price' => 43000],
        ])->each(fn ($data) => Car::firstOrCreate(
            ['make' => $data['make'], 'model' => $data['model'], 'year' => $data['year']],
            ['price' => $data['price'], 'status' => 'available']
        ));
    }
}
