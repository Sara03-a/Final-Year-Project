<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Measurement;
use App\Models\Quote;
use App\Models\Address;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create admin user
        User::factory()->create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'usertype' => 'admin',
            'password' => bcrypt('admin123')
        ]);

        // Create regular user
        $user = User::factory()->create([
            'name' => 'Regular User',
            'email' => 'user@example.com',
            'usertype' => 'user',
            'password' => bcrypt('user123')
        ]);

        // Create measurements for regular user
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

        // Create quotes for regular user
        $measurement = Measurement::where('user_id', $user->id)->first();
        Quote::create([
            'status' => 'pending',
            'measurement_id' => $measurement->id,
            'price' => 299.99,
            'user_id' => $user->id,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        Quote::create([
            'status' => 'approved',
            'measurement_id' => $measurement->id,
            'price' => 399.99,
            'user_id' => $user->id,
            'created_at' => now()->subDays(5),
            'updated_at' => now()->subDays(3)
        ]);

        // Create addresses for regular user
        Address::create([
            'label' => 'Home',
            'street_address' => '42 High Street',
            'city' => 'London',
            'postal_code' => 'SW1A 1AA',
            'user_id' => $user->id
        ]);

        Address::create([
            'label' => 'Office',
            'street_address' => '15 Oxford Road',
            'city' => 'Manchester',
            'postal_code' => 'M1 5QA',
            'user_id' => $user->id
        ]);
    }
}
