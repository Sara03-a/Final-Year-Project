<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Measurement Model
 * 
 * This model represents room measurements in the system.
 * Each measurement belongs to a specific user and contains
 * dimensional details of a room for quote calculation.
 */
class Measurement extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<string>
     */
    protected $fillable = [
        'room_name',    // Name/identifier for the room being measured
        'width',        // Width measurement of the room
        'length',       // Length measurement of the room
        'user_id',      // Foreign key to users table
        'address_id'    // Foreign key to addresses table
    ];

    /**
     * Get the user that owns this measurement
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the address that owns this measurement
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function address(): BelongsTo
    {
        return $this->belongsTo(Address::class);
    }
}