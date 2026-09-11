<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'admin@floraskincare.test'],
            [
                'name' => 'Store Admin',
                'password' => Hash::make('password'),
                'role' => 'admin',
            ]
        );

        User::updateOrCreate(
            ['email' => 'customer@floraskincare.test'],
            [
                'name' => 'Demo Customer',
                'password' => Hash::make('password'),
                'role' => 'customer',
            ]
        );
    }
}
