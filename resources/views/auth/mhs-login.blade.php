@extends('layouts.app')

@section('title', 'Login')

@section('content')
    <div class="flex items-center justify-center min-h-screen bg-gray-100">
        <div class="w-full max-w-md p-8 bg-white border rounded-2xl">
            <h2 class="text-2xl font-semibold text-center text-cyan-600">Sistem Pelayanan Legalisir Ijazah</h2>
            <p class="mb-6 text-center text-gray-500">Silahkan masuk untuk melanjutkan</p>
            <form action="{{ route('login.mahasiswa') }}" method="POST">
                @csrf
                <div class="mb-4">
                    <label for="name" class="block text-sm font-medium text-gray-700">Nama Lengkap</label>
                    <input type="text" name="name" placeholder="Masukkan nama lengkap" required
                        class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-lg focus:outline-none focus:ring-cyan-500 focus:border-cyan-500 sm:text-sm">
                </div>

                <div class="mb-4">
                    <label for="nim" class="block text-sm font-medium text-gray-700">NIM</label>
                    <input type="text" name="nim" placeholder="Masukkan NIM" required
                        class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-lg focus:outline-none focus:ring-cyan-500 focus:border-cyan-500 sm:text-sm">
                </div>

                <button type="submit"
                    class="w-full px-4 py-2 text-white rounded-lg bg-cyan-600 hover:bg-cyan-700 focus:outline-none focus:ring-2 focus:ring-cyan-500 focus:ring-opacity-50">
                    Masuk
                </button>
            </form>

            {{-- register --}}
            <div class="mt-4 text-center">
                <p class="text-gray-500">Belum punya akun? <a href="{{ route('register.mahasiswa') }}"
                        class="text-cyan-600 hover:underline">Daftar</a></p>
            </div>

            @if ($errors->any())
                <div class="mt-4 text-red-500">
                    @foreach ($errors->all() as $error)
                        <p>{{ $error }}</p>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
@endsection
