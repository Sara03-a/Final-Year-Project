<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Measurement;
use Illuminate\Database\Seeder;

class MeasurementSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get the regular user
        $user = User::where('email', 'user@example.com')->first();

        if ($user) {
            Measurement::create([
                'room_name' => 'Living Room',
                'width' => 4.5,
                'length' => 6.0,
                'user_id' => $user->id,
                'address' => '42 High Street, London'
            ]);

            Measurement::create([
                'room_name' => 'Master Bedroom',
                'width' => 3.8,
                'length' => 4.2,
                'user_id' => $user->id,
                'address' => '42 High Street, London'
            ]);
        }
    }
}