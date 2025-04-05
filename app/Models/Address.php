<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Address Model
 * 
 * This model represents a user's address in the system.
 * Each address belongs to a specific user and contains their location details.
 */
class Address extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<string>
     */
    protected $fillable = [
        'label',           // Friendly name for the address (e.g., "Home", "Office")
        'street_address',  // Street name and number
        'city',           // City name
        'postal_code',    // Postal/ZIP code
        'user_id'         // Foreign key to users table
    ];

    /**
     * Get the user that owns this address
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the measurements associated with this address
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function measurements(): HasMany
    {
        return $this->hasMany(Measurement::class);
    }
}