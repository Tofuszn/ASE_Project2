<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    use HasFactory;

    protected $fillable = [
        'car_id',
        'customer_name',
        'sale_price',
    ];

    protected $casts = [
        'sale_price' => 'decimal:2',
    ];

    public function car()
    {
        return $this->belongsTo(Car::class);
    }
}
