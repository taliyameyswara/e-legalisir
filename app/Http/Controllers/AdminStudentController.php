<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\User;
use Illuminate\Http\Request;

class AdminStudentController extends Controller
{
    public function index()
    {
        $students = Student::all();
        return view('admin.student.index', compact('students'));
    }

    public function create()
    {
        return view('admin.student.create');
    }
    public function store(Request $request)
    {
        $request->validate([
            'nim' => 'required|string|max:20',
            'name' => 'required|string|max:255',
            'tempat_lahir' => 'nullable|string|max:255',
            'tanggal_lahir' => 'nullable|date',
            'program_studi' => 'nullable|string|max:255',
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

        $user = User::create([
            'name' => $request->name,
            'nim' => $request->nim,
            'role' => 'mahasiswa',
        ]);

        $sarjana = explode(' ', $request->program_studi)[0];

        Student::create([
            'user_id' => $user->id,
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
        ]);

        return redirect()->route('superadmin.student.index')->with('success', 'Data mahasiswa berhasil ditambahkan.');
    }
    public function edit($id)
    {
        $student = Student::findOrFail($id);
        return view('admin.student.edit', compact('student'));
    }
    public function update(Request $request, $id) {
        $request->validate([
            'nim' => 'required|string|max:20',
            'name' => 'required|string|max:255',
            'tanggal_lahir' => 'required|date',
            'tempat_lahir' => 'required|string|max:255',
            'program_studi' => 'required|string|max:255',
            'nomor_ijazah' => 'required|string|max:255',
        ]);

        $student = Student::findOrFail($id);
        $student->user->update([
            'name' => $request->name,
            'nim' => $request->nim,
        ]);

        $student->update([
            'tanggal_lahir' => $request->tanggal_lahir,
            'tempat_lahir' => $request->tempat_lahir,
            'program_studi' => $request->program_studi,
            'nomor_ijazah' => $request->nomor_ijazah,
        ]);

        return redirect()->route('admin.student.index')->with('success', 'Data mahasiswa berhasil diperbarui.');


    }


    public function delete($id)
    {
        $student = Student::findOrFail($id);
        $student->delete();

        return redirect()->route('admin.student.index')->with('success', 'Data mahasiswa berhasil dihapus.');
    }
}
