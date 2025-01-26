<?php

namespace Database\Seeders;

use App\Models\Document;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DocumentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {

        $mahasiswa = User::where('nim', '1234567890')->first();

        Document::create([
            'user_id' => $mahasiswa->id,
            'nim' => $mahasiswa->nim,
            'nama' => $mahasiswa->name,
            'tanggal_lahir' => '2000-01-01',
            'tempat_lahir' => 'Jakarta',
            'program_studi' => 'Informatika',
            'nomor_sk_rektor' => 'SKR-12345',
            'nomor_ijazah' => 'IJZ-98765',
            'status' => 'pending',
            
        ]);
    }
}
