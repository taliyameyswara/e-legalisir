<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Membuat admin
        User::create([
            'name' => 'Admin Universitas',
            'email' => 'admin@university.com',
            'password' => bcrypt('password123'), // Jangan lupa hash password
            'role' => 'admin',
        ]);

        // Membuat mahasiswa
        User::create([
            'name' => 'Ahmad Rizki',
            'nim' => '1234567890',
            'role' => 'mahasiswa',
        ]);
    }
}
