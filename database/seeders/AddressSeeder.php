<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Address;
use Illuminate\Database\Seeder;

class AddressSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get all regular users
        $users = User::where('usertype', 'user')->get();

        // Array of sample addresses
        $addresses = [
            [
                'label' => 'Home',
                'street_address' => '42 High Street',
                'city' => 'London',
                'postal_code' => 'SW1A 1AA'
            ],
            [
                'label' => 'Office',
                'street_address' => '15 Oxford Road',
                'city' => 'Manchester',
                'postal_code' => 'M1 5QA'
            ],
            [
                'label' => 'Apartment',
                'street_address' => '7 Park Avenue',
                'city' => 'Birmingham',
                'postal_code' => 'B1 1AA'
            ],
            [
                'label' => 'Holiday Home',
                'street_address' => '23 Beach Road',
                'city' => 'Brighton',
                'postal_code' => 'BN1 1AA'
            ],
            [
                'label' => 'Business',
                'street_address' => '101 Commercial Street',
                'city' => 'Leeds',
                'postal_code' => 'LS1 1AA'
            ]
        ];

        // Create addresses for each user
        foreach ($users as $user) {
            // Assign 2-3 random addresses to each user
            $numAddresses = rand(2, 3);
            $shuffledAddresses = collect($addresses)->shuffle();

            for ($i = 0; $i < $numAddresses; $i++) {
                Address::create(array_merge(
                    $shuffledAddresses[$i],
                    ['user_id' => $user->id]
                ));
            }
        }
        }
    }