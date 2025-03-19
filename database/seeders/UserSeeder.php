<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Admin
        User::create([
            'name' => 'Admin Azriel',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('admin'),
            'role' => 'admin',
        ]);

        // Kasir
        User::create([
            'name' => 'Kasir Azriel',
            'email' => 'kasir@gmail.com',
            'password' => Hash::make('kasir'),
            'role' => 'kasir',
        ]);
        // Pemilik
        User::create([
            'name' => 'Pemilik Azriel',
            'email' => 'pemilik@gmail.com',
            'password' => Hash::make('pemilik'),
            'role' => 'pemilik',
        ]);
    }
}
