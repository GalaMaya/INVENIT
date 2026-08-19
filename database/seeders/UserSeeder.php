<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $users = [
            ['name' => 'Admin IT', 'email' => 'admin@company.com', 'role' => 'admin'],
            ['name' => 'Budi Santoso', 'email' => 'budi@company.com', 'role' => 'staff'],
            ['name' => 'Siti Rahayu', 'email' => 'siti@company.com', 'role' => 'staff'],
            ['name' => 'Andi Wijaya', 'email' => 'andi@company.com', 'role' => 'staff'],
            ['name' => 'Dewi Lestari', 'email' => 'dewi@company.com', 'role' => 'staff'],
            ['name' => 'Rudi Hermawan', 'email' => 'rudi@company.com', 'role' => 'staff'],
            ['name' => 'Maya Putri', 'email' => 'maya@company.com', 'role' => 'viewer'],
            ['name' => 'Eko Prasetyo', 'email' => 'eko@company.com', 'role' => 'viewer'],
        ];

        foreach ($users as $user) {
            $newUser = User::create([
                'name' => $user['name'],
                'email' => $user['email'],
                'password' => Hash::make('password'),
                'email_verified_at' => now(),
            ]);

            $newUser->assignRole($user['role']);
        }
    }
}