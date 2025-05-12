<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CarpetSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $carpets = [
            [
                'name' => 'Persian Royal Silk',
                'description' => 'Luxurious hand-knotted silk carpet with intricate traditional Persian patterns. Features exquisite floral medallions and intricate borders.',
                'price_per_sq_meter' => 299.99,
                'image' => 'carpet-images/persian-royal-silk.jpg'
            ],
            [
                'name' => 'Modern Geometric Wool',
                'description' => 'Contemporary wool carpet featuring bold geometric designs. Perfect for modern interiors with its minimalist patterns.',
                'price_per_sq_meter' => 189.99,
                'image' => 'carpet-images/Cumbrian-Loop-Blencathra.jpg'
            ],
            [
                'name' => 'Plush Comfort Shag',
                'description' => 'Ultra-soft polyester shag carpet perfect for bedrooms and living spaces. Provides warmth and comfort with its deep pile.',
                'price_per_sq_meter' => 129.99,
                'image' => 'carpet-images/shag.jpg'
            ],
            [
                'name' => 'Vintage Oriental Cotton',
                'description' => 'Classic oriental patterns woven in durable cotton material. Features timeless designs inspired by ancient artistry.',
                'price_per_sq_meter' => 159.99,
                'image' => 'carpet-images/classic-handmade-rug.jpg'
            ],
            [
                'name' => 'Eco-Friendly Bamboo',
                'description' => 'Sustainable bamboo fiber carpet with natural patterns and textures. Environmentally conscious choice with elegant simplicity.',
                'price_per_sq_meter' => 139.99,
                'image' => 'carpet-images/bamboo.jpeg'
            ]
        ];

        foreach ($carpets as $carpet) {
            \App\Models\Carpet::create($carpet);
        }
    }
}
