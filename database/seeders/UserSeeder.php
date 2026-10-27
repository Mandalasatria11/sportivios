<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 1. Akun Administrator
        User::updateOrCreate(
            ['email' => 'admin@sportivios.com'],
            [
                'name' => 'Sportivios Administrator',
                'password' => Hash::make('admin123'),
                'role' => 'admin',
                'phone' => '+62 811-9988-7766',
                'address' => 'Sportivios HQ, Jakarta Selatan',
            ]
        );

        // 2. Akun Customer
        User::updateOrCreate(
            ['email' => 'parker@gmail.com'],
            [
                'name' => 'Peter Parker',
                'password' => Hash::make('password123'),
                'role' => 'customer',
                'phone' => '+62 812-3456-7890',
                'address' => 'Jl. Jenderal Sudirman Kav. 45, Tower Aria Lt. 18 No. 1802, Jakarta Selatan',
            ]
        );
    }
}
