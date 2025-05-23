<?php

namespace Database\Seeders;

use App\Models\Student;
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
        $user = User::where('email', 'admin@university.com')->first();

        if (!$user) {
            User::create([
                'name' => 'Admin Universitas',
                'email' => 'admin@university.com',
                'password' => bcrypt('password123'), // Jangan lupa hash password
                'role' => 'admin',
            ]);
        }

        $user = User::where('nim', '1234567890')->first();

        if (!$user) {
            $user = User::create([
                'name' => 'Ahmad Rizki',
                'nim' => '1234567890',
                'role' => 'mahasiswa',
            ]);

            Student::create([
                'user_id' => $user->id,
                'tanggal_lahir' => '2000-01-01',
                'tempat_lahir' => 'Jakarta',
                'program_studi' => 'Informatika',
                'sarjana' => 'Sarjana',
                'nomor_ijazah' => 'IJZ-98765',
            ]);
        }

        $user = User::where('email', 'superadmin@university.com')->first();

        if(!$user){
            User::create([
                'name' => 'Super Admin Universitas',
                'email' => 'superadmin@university.com',
                'password' => bcrypt('password123'), // Jangan lupa hash password
                'role' => 'superadmin',
            ]);
        }


    }
}
