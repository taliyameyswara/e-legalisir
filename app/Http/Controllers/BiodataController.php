<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\Province;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BiodataController extends Controller
{
    public function index()
    {
        $provinces = Province::all();
        $cities = City::all();
        $student = Auth::user()->student;

        return view('mahasiswa.biodata.index', compact('provinces', 'cities', 'student'));
    }
    public function update(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'name' => 'required|string|max:255',
            'tempat_lahir' => 'nullable|string|max:255',
            'tanggal_lahir' => 'nullable|date',
            'program_studi' => 'required|string|max:255',
            'nomor_sk_rektor' => 'nullable|string|max:255',
            'nomor_ijazah' => 'nullable|string|max:255',
            'no_hp' => 'nullable|string|max:15',
            'province_id' => 'nullable|exists:provinces,id',
            'city_id' => 'nullable|exists:cities,id',
            'alamat_pengiriman' => 'nullable|string|max:255',
            'kode_pos' => 'nullable|string|max:10',
        ]);

        // Update user name
        $user->update(['name' => $request->name]);

        $student = $user->student;
        $student->update(
            [
                'tempat_lahir' => $request->tempat_lahir,
                'tanggal_lahir' => $request->tanggal_lahir,
                'program_studi' => $request->program_studi,
                'nomor_sk_rektor' => $request->nomor_sk_rektor,
                'nomor_ijazah' => $request->nomor_ijazah,
                'no_hp' => $request->no_hp,
                'province_id' => $request->province_id,
                'city_id' => $request->city_id,
                'alamat_pengiriman' => $request->alamat_pengiriman,
                'kode_pos' => $request->kode_pos,
            ]
        );

        return redirect()->route('mahasiswa.legalisir.index')->with('success', 'Biodata berhasil diperbarui');
    }
}
