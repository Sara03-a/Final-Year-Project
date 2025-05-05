<?php

namespace Database\Seeders;

use App\Models\Quote;
use App\Models\Carpet;
use App\Models\Measurement;
use Illuminate\Database\Seeder;

class QuoteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get all carpets and measurements
        $carpets = Carpet::all();
        $measurements = Measurement::all();

        // For testing purposes, create one quote for each measurement with the first carpet
        // In production, carpets will be selected by users
        $firstCarpet = $carpets->first();
        
        foreach ($measurements as $measurement) {
            // Calculate area
            $area = $measurement->width * $measurement->length;
            
            // Calculate total price based on carpet price per sq meter and area
            $estimated_price = $firstCarpet->price_per_sq_meter * $area;

            Quote::create([
                'measurement_id' => $measurement->id,
                'carpet_id' => $firstCarpet->id,
                'price' => $estimated_price,
                'status' => 'pending',
                'user_id' => $measurement->user_id
            ]);
        }
    }
}