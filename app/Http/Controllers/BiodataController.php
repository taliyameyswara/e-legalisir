<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\Province;
use App\Models\Student;
use App\Services\LogServices;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BiodataController extends Controller
{
    protected $logServices;
    public function __construct(LogServices $logServices)
    {
        $this->logServices = $logServices;
    }
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
            'nomor_ijazah' => 'nullable|string|max:255',
            'no_hp' => 'nullable|string|max:15',
            'province_id' => 'nullable|exists:provinces,id',
            'city_id' => 'nullable|exists:cities,id',
            'alamat_pengiriman' => 'nullable|string|max:255',
            'kode_pos' => 'nullable|string|max:10',

            'nama_perusahaan' => 'nullable|string|max:255',
            'jabatan_perusahaan' => 'nullable|string|max:255',
            'alamat_perusahaan' => 'nullable|string|max:255',
            'gaji' => 'nullable|integer|min:0',
            'perusahaan_province_id' => 'nullable|exists:provinces,id',
        ]);

        $sarjana = explode(' ', $request->program_studi)[0];

        $user->update(['name' => $request->name]);

        $student = $user->student;
        $student->update(
            [
                'tempat_lahir' => $request->tempat_lahir,
                'tanggal_lahir' => $request->tanggal_lahir,
                'program_studi' => $request->program_studi,
                'sarjana' => $sarjana,
                'nomor_ijazah' => $request->nomor_ijazah,
                'no_hp' => $request->no_hp,
                'province_id' => $request->province_id,
                'city_id' => $request->city_id,
                'alamat_pengiriman' => $request->alamat_pengiriman,
                'kode_pos' => $request->kode_pos,
                'nama_perusahaan' => $request->nama_perusahaan,
                'jabatan_perusahaan' => $request->jabatan_perusahaan,
                'alamat_perusahaan' => $request->alamat_perusahaan,
                'gaji' => $request->gaji,
                'perusahaan_province_id' => $request->perusahaan_province_id,
            ]
        );

        $this->logServices->createLog(
            'Update Biodata',
            'Mahasiswa ' . $user->name . ' telah memperbarui biodata',
            $user->id
        );

        return redirect()->route('mahasiswa.legalisir.index')->with('success', 'Biodata berhasil diperbarui');
    }
}
