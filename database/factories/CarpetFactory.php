<?php

namespace Database\Factories;

use App\Models\Carpet;
use Illuminate\Database\Eloquent\Factories\Factory;

class CarpetFactory extends Factory
{
    protected $model = Carpet::class;

    public function definition()
    {
        $carpetTypes = ['Persian', 'Oriental', 'Modern', 'Traditional', 'Contemporary', 'Geometric'];
        $materials = ['Wool', 'Silk', 'Cotton', 'Synthetic', 'Blend'];
        $patterns = ['Floral', 'Abstract', 'Medallion', 'Tribal', 'Solid'];

        return [
            'name' => $this->faker->randomElement($carpetTypes) . ' ' . 
                      $this->faker->randomElement($patterns) . ' ' . 
                      $this->faker->randomElement($materials) . ' Carpet',
            'description' => $this->faker->paragraph(3),
            'price' => $this->faker->randomFloat(2, 299, 9999),
        ];
    }
}