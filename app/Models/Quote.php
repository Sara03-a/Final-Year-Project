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
        'status',                    // Current status of the quote (e.g., approval_required, approved)
        'measurement_id',             // Foreign key to measurements table (optional)
        'carpet_id',                 // Foreign key to carpets table (optional)
        'custom_carpet_description', // Description for custom carpet requests
        'address_id',                // Foreign key to addresses table
        'price',                     // Quoted price for the service
        'user_id',                   // Foreign key to users table
        'notes',                     // Additional notes for the quote
        'payment_method',            // Payment method selection (cash/online)
        'created_at',                // Timestamp when quote was created
        'updated_at'                 // Timestamp when quote was last updated
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
     * Get the carpet associated with this quote
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function carpet(): BelongsTo
    {
        return $this->belongsTo(Carpet::class);
    }

    /**
     * Get the address associated with this quote
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function address(): BelongsTo
    {
        return $this->belongsTo(Address::class);
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