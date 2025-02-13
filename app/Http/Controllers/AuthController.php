<?php

namespace App\Http\Controllers;

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

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login')->with('success', 'Logout Berhasil');
    }
}
