<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\User;
use App\Services\LogServices;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    protected $logServices;
    public function __construct(LogServices $logServices)
    {
        $this->logServices = $logServices;
    }
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
            'nim' => 'required|string|unique:users,nim',
            'program_studi' => 'required|string',
        ]);

        $user = User::create([
            'name' => $request->name,
            'nim' => $request->nim,
            'role' => 'mahasiswa',
        ]);

        $program_studi = explode(' ', $request->program_studi);
        $sarjana = $program_studi[0];

        Student::create([
            'user_id' => $user->id,
            'program_studi' => $request->program_studi,
            'sarjana' => $sarjana,
        ]);

        $this->logServices->createLog('Register', 'User melakukan registrasi', $user->id);
        return redirect()->route('login')->with('success', 'Registrasi Berhasil');
    }

    public function loginAdmin(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
            'captcha' => 'required|captcha',
        ]);

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            if(Auth::user()->role !== 'admin' && Auth::user()->role !== 'superadmin') {
                Auth::logout();
                return redirect()->back()->withErrors(['error' => 'Anda tidak memiliki akses ke halaman ini']);
            }
            if (Auth::user()->role === 'superadmin') {
                $this->logServices->createLog('Login', 'Superadmin melakukan login', Auth::user()->id);
                return redirect()->route('superadmin.index');
            }
            if (Auth::user()->role === 'admin') {
                $this->logServices->createLog('Login', 'Admin melakukan login', Auth::user()->id);
                return redirect()->route('admin.index');
            }
        }

        return redirect()->back()->withErrors(['error' => 'Email atau password salah']);
    }

    public function loginMahasiswa(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'nim' => 'required|string',
            'captcha' => 'required|captcha',
        ]);

        $credentials = $request->only('name', 'nim');

        $user = User::where('name', $credentials['name'])
            ->where('nim', $credentials['nim'])
            ->first();

        if ($user && $user->role === 'mahasiswa') {
            Auth::login($user);
            $this->logServices->createLog('Login', 'User melakukan login', $user->id);
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
        $this->logServices->createLog('Logout', 'User melakukan logout', Auth::user()->id);

        Auth::logout();

        return redirect()->route('login')->with('success', 'Logout Berhasil');
    }
}
