<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Carpet extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'price_per_sq_meter',
        'image'
    ];

    protected $casts = [
        'price_per_sq_meter' => 'decimal:2',
    ];
}