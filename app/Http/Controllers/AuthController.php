<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function showAdminLogin()
    {
        return view('auth.admin-login');
    }

    public function showMahasiswaLogin()
    {
        return view('auth.mhs-login');
    }
    public function showMahasiswaRegister()
    {
        return view('auth.mhs-register');
    }
    public function registerMahasiswa(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'nim' => 'required|string',
            'program_studi' => 'required|string',
            // 'tanggal_lahir' => 'required|date',
            // 'tempat_lahir' => 'required|string',
            // 'nomor_ijazah' => 'required|string',
        ]);

        $user = User::create([
            'name' => $request->name,
            'nim' => $request->nim,
            'role' => 'mahasiswa',
        ]);

        Student::create([
            'user_id' => $user->id,
            'program_studi' => $request->program_studi,
            // 'tanggal_lahir' => $request->tanggal_lahir,
            // 'tempat_lahir' => $request->tempat_lahir,
            // 'nomor_ijazah' => $request->nomor_ijazah,
        ]);

        return redirect()->route('login')->with('success', 'Registrasi Berhasil');
    }

    public function loginAdmin(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            return redirect()->route('admin.index');
        }

        return redirect()->back()->withErrors(['error' => 'Email atau password salah']);
    }

    public function loginMahasiswa(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'nim' => 'required|string',
        ]);

        $credentials = $request->only('name', 'nim');

        $user = User::where('name', $credentials['name'])
            ->where('nim', $credentials['nim'])
            ->first();

        if ($user && $user->role === 'mahasiswa') {
            Auth::login($user);
            return redirect()->route('mahasiswa.index');
        }

        return redirect()->back()->withErrors(['error' => 'Nama atau NIM salah']);
    }

    public function showUpdate()
    {
        return view('auth.update');
    }



    public function logout()
    {
        Auth::logout();
        return redirect()->route('login')->with('success', 'Logout Berhasil');
    }
}
