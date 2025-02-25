@extends('layouts.app')

@section('title', 'Register')

@section('content')
<div class="flex items-center justify-center min-h-screen bg-gray-100">
    <div class="w-full max-w-md p-8 bg-white border rounded-2xl">
        <h2 class="text-2xl font-semibold text-center text-cyan-600">Sistem Pelayanan Legalisir Ijazah</h2>
        <p class="mb-6 text-center text-gray-500">Silahkan masuk untuk melanjutkan</p>
        <form action="{{ route('register.mahasiswa') }}" method="POST">
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
            {{-- 'name' => 'required|string',
            'nim' => 'required|string',
            'tanggal_lahir' => 'required|date',
            'tempat_lahir' => 'required|string',
            'nomor_ijazah' => 'required|string', --}}
            {{-- <div class="mb-4">
                <label for="tanggal_lahir" class="block text-sm font-medium text-gray-700">Tanggal Lahir</label>
                <input type="date" name="tanggal_lahir" required
                    class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-lg focus:outline-none focus:ring-cyan-500 focus:border-cyan-500 sm:text-sm">
            </div>
            <div class="mb-4">
                <label for="tempat_lahir" class="block text-sm font-medium text-gray-700">Tempat Lahir</label>
                <input type="text" name="tempat_lahir" placeholder="Masukkan tempat lahir" required
                    class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-lg focus:outline-none focus:ring-cyan-500 focus:border-cyan-500 sm:text-sm">
            </div>
            <div class="mb-4">
                <label for="nomor_ijazah" class="block text-sm font-medium text-gray-700">Nomor Ijazah</label>
                <input type="text" name="nomor_ijazah" placeholder="Masukkan nomor ijazah" required
                    class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-lg focus:outline-none focus:ring-cyan-500 focus:border-cyan-500 sm:text-sm">
            </div> --}}
            <div class="mb-4">
                {{-- program studi select option --}}
                <label for="program_studi" class="block text-sm font-medium text-gray-700">Program Studi</label>
                <select name="program_studi" required
                    class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-lg focus:outline-none focus:ring-cyan-500 focus:border-cyan-500 sm:text-sm">
                    <option value="Sarjana Pendidikan Guru Sekolah Dasar">Sarjana Pendidikan Guru Sekolah Dasar</option>
                    <option value="Sarjana Pendidikan Guru Pendidikan Anak Usia Dini">Sarjana Pendidikan Guru Pendidikan Anak
                        Usia Dini</option>
                    <option value="Sarjana Bimbingan dan Konseling">Sarjana Bimbingan dan Konseling</option>
                    <option value="Sarjana Teknologi Pendidikan">Sarjana Teknologi Pendidikan</option>
                    <option value="Sarjana Manajemen Pendidikan">Sarjana Manajemen Pendidikan</option>
                    <option value="Sarjana Pendidikan Masyarakat">Sarjana Pendidikan Masyarakat</option>
                    <option value="Sarjana Pendidikan Khusus">Sarjana Pendidikan Khusus</option>
                    <option value="Magister Pendidikan Dasar">Magister Pendidikan Dasar</option>
                    <option value="Magister Pendidikan Anak Usia Dini">Magister Pendidikan Anak Usia Dini</option>
                    <option value="Magister Bimbingan Konseling">Magister Bimbingan Konseling</option>
                    <option value="Magister Teknologi Pendidikan">Magister Teknologi Pendidikan</option>
                    <option value="Magister Manajemen Pendidikan">Magister Manajemen Pendidikan</option>
                    <option value="Magister Pendidikan Masyarakat">Magister Pendidikan Masyarakat</option>
                    <option value="Magister Pendidikan Khusus">Magister Pendidikan Khusus</option>
                    <option value="Doktor Teknologi Pendidikan">Doktor Teknologi Pendidikan</option>
                    <option value="Doktor Manajemen Pendidikan">Doktor Manajemen Pendidikan</option>
                    <option value="Doktor Pendidikan Anak Dini">Doktor Pendidikan Anak Dini</option>
                    <option value="Doktor Pendidikan Dasar">Doktor Pendidikan Dasar</option>
                </select>
            </div>


            <button type="submit"
                class="w-full px-4 py-2 text-white rounded-lg bg-cyan-600 hover:bg-cyan-700 focus:outline-none focus:ring-2 focus:ring-cyan-500 focus:ring-opacity-50">
                Masuk
            </button>
        </form>

        {{-- login --}}
        <div class="mt-4 text-center">
            <p class="text-gray-500">Sudah punya akun? <a href="{{ route('login.mahasiswa') }}"
                    class="text-cyan-600 hover:underline">Masuk</a></p>
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
