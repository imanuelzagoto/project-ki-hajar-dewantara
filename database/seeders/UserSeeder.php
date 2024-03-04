<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            [
                'first_name' => 'Bondan',
                'last_name' => 'Prakoso',
                'username' => 'bondanprakoso',
                'email' => 'bondan@gmail.com',
                'password' => Hash::make('password'),
                'gender' => 'male',
                'designation' => 'admin',
            ],
            [
                'first_name' => 'Mike',
                'last_name' => 'Tyson',
                'username' => 'miketyson',
                'email' => 'mike@gmail.com',
                'password' => Hash::make('password'),
                'gender' => 'male',
                'designation' => 'user',
            ],
            // Add more users as needed
        ];

        // Insert users into database
        foreach ($users as $userData) {
            User::create($userData);
        }
    }
}
