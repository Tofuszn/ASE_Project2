<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    use HasFactory;

    protected $fillable = [
        'make',
        'model',
        'year',
        'price',
        'status',
    ];

    protected $casts = [
        'year' => 'integer',
        'price' => 'decimal:2',
    ];

    public function sales()
    {
        return $this->hasMany(Sale::class);
    }
}
