<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Create a test user
        User::create([
            'first_name' => 'Jean',
            'last_name' => 'Dupont',
            'email' => 'jean.dupont@example.com',
            'password' => Hash::make('password'),
            'phone' => '06 12 34 56 78',
            'address' => '123 Rue de la République',
            'city' => 'Paris',
            'state' => 'Île-de-France',
            'postal_code' => '75001',
            'country' => 'France',
            'is_admin' => false,
            'is_active' => true,
        ]);

        // Create an admin user
        User::create([
            'first_name' => 'Admin',
            'last_name' => 'User',
            'email' => 'admin@fruitables.fr',
            'password' => Hash::make('admin123'),
            'phone' => '06 98 76 54 32',
            'address' => '456 Avenue des Champs-Élysées',
            'city' => 'Paris',
            'state' => 'Île-de-France',
            'postal_code' => '75008',
            'country' => 'France',
            'is_admin' => true,
            'is_active' => true,
        ]);
    }
}
