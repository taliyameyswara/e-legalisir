<?php

namespace Database\Seeders;

use App\Models\Province;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Http;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ProvinceSeeder extends Seeder
{
    public function run(): void
    {
        $provinces = Http::withOptions(['verify' => false,])->withHeaders([
            'key' => 'f710acbf62e57b4afc707940f3b0e2c5',
        ])->get('https://api.rajaongkir.com/starter/province')->json()['rajaongkir']['results'];



        foreach ($provinces as $province) {
            Province::create([
                'name'        => $province['province'],
                'created_at'  => now(),
                'updated_at'  => now(),
            ]);
        }
    }
}
