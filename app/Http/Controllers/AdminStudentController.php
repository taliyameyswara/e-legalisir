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
            'tanggal_lahir' => 'required|date',
            'tempat_lahir' => 'required|string|max:255',
            'program_studi' => 'required|string|max:255',
            'nomor_sk_rektor' => 'required|string|max:255',
            'nomor_ijazah' => 'required|string|max:255',
        ]);

        $user = User::create([
            'name' => $request->name,
            'nim' => $request->nim,
            'role' => 'mahasiswa',
        ]);

        Student::create([
            'user_id' => $user->id,
            'tanggal_lahir' => $request->tanggal_lahir,
            'tempat_lahir' => $request->tempat_lahir,
            'program_studi' => $request->program_studi,
            'nomor_sk_rektor' => $request->nomor_sk_rektor,
            'nomor_ijazah' => $request->nomor_ijazah,
        ]);

        return redirect()->route('admin.student.index')->with('success', 'Data mahasiswa berhasil ditambahkan.');
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
            'nomor_sk_rektor' => 'required|string|max:255',
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
            'nomor_sk_rektor' => $request->nomor_sk_rektor,
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
