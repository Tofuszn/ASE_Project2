<?php

namespace App\Http\Controllers;

use App\Models\Car;
use Illuminate\Http\Request;

class CarController extends Controller
{
    public function index()
    {
        return Car::orderByDesc('id')->get();
    }

    public function show(Car $car)
    {
        return $car;
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'make' => 'required|string|max:255',
            'model' => 'required|string|max:255',
            'year' => 'required|integer|min:1900|max:' . (now()->year + 1),
            'price' => 'required|numeric|min:0',
        ]);

        $car = Car::create($data);

        return response()->json(['id' => $car->id], 201);
    }

    public function update(Request $request, Car $car)
    {
        $data = $request->validate([
            'make' => 'sometimes|string|max:255',
            'model' => 'sometimes|string|max:255',
            'year' => 'sometimes|integer|min:1900|max:' . (now()->year + 1),
            'price' => 'sometimes|numeric|min:0',
            'status' => 'sometimes|in:available,sold',
        ]);

        if (empty($data)) {
            return response()->json(['error' => 'No fields to update'], 400);
        }

        $car->update($data);

        return response()->json(['updated' => true]);
    }

    public function destroy(Car $car)
    {
        $car->delete();

        return response()->json(['deleted' => true]);
    }
}
