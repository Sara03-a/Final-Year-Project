<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Quote Model
 * 
 * This model represents a price quote in the system.
 * Each quote is associated with a user and their measurement details.
 * It tracks the status of the quote and its associated pricing.
 */
class Quote extends Model
{
    use HasFactory;

    /**
     * Get the user that owns this quote
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array<string>
     */
    protected $fillable = [
        'status',          // Current status of the quote (e.g., pending, approved)
        'measurement_id',   // Foreign key to measurements table
        'price',           // Quoted price for the service
        'user_id',         // Foreign key to users table
        'created_at',      // Timestamp when quote was created
        'updated_at'       // Timestamp when quote was last updated
    ];

    /**
     * Get the measurement associated with this quote
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function measurement(): BelongsTo
    {
        return $this->belongsTo(Measurement::class);
    }

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'created_at' => 'datetime',  // Cast timestamps to DateTime objects
        'updated_at' => 'datetime'
    ];
}