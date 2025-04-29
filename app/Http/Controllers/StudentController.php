<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Exports\StudentExport;
use App\Http\Controllers\Controller;
use App\Models\Province;
use App\Models\Student;
use App\Models\User;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class StudentController extends Controller
{
    public function index()
    {
        $students = Student::all();
        return view('superadmin.student.index', compact('students'));
    }

    public function create()
    {
        $provinces = Province::all();
        return view('superadmin.student.create', compact('provinces'));
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
        $provinces = Province::all();
        return view('superadmin.student.edit', compact('student', 'provinces'));
    }
    public function update(Request $request, $id) {
        $request->validate([
            'nim' => 'required|string|max:20',
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

        $student = Student::findOrFail($id);
        $student->user->update([
            'name' => $request->name,
            'nim' => $request->nim,
        ]);
        $sarjana = explode(' ', $request->program_studi)[0];
        $student->update([
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

        return redirect()->route('superadmin.student.index')->with('success', 'Data mahasiswa berhasil diperbarui.');
    }


    public function delete($id)
    {
        $student = Student::findOrFail($id);
        $student->delete();

        return redirect()->route('superadmin.student.index')->with('success', 'Data mahasiswa berhasil dihapus.');
    }

    public function export()
    {
        return Excel::download(new StudentExport, 'students.xlsx');
    }
}
