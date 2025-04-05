<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
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

        // Create regular users
        $users = [
            [
                'name' => 'John Smith',
                'email' => 'john@example.com',
                'usertype' => 'user',
                'password' => bcrypt('user123')
            ],
            [
                'name' => 'Sarah Wilson',
                'email' => 'sarah@example.com',
                'usertype' => 'user',
                'password' => bcrypt('user123')
            ],
            [
                'name' => 'Michael Brown',
                'email' => 'michael@example.com',
                'usertype' => 'user',
                'password' => bcrypt('user123')
            ],
            [
                'name' => 'Emma Davis',
                'email' => 'emma@example.com',
                'usertype' => 'user',
                'password' => bcrypt('user123')
            ]
        ];

        foreach ($users as $userData) {
            User::factory()->create($userData);
        }
    }
}