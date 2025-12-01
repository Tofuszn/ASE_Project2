<?php

namespace App\Http\Controllers;

use App\Models\Car;
use App\Models\Sale;
use Illuminate\Http\Request;

class SaleController extends Controller
{
    public function index()
    {
        return Sale::with('car')->orderByDesc('id')->get();
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'car_id' => 'required|integer|exists:cars,id',
            'customer_name' => 'required|string|max:255',
            'sale_price' => 'required|numeric|min:0',
        ]);

        $car = Car::findOrFail($data['car_id']);

        if ($car->status === 'sold') {
            return response()->json(['error' => 'Car already sold'], 409);
        }

        $sale = Sale::create($data);
        $car->update(['status' => 'sold']);

        return response()->json(['id' => $sale->id], 201);
    }
}
