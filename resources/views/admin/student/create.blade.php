@extends('layouts.admin')

@section('content')
<div class="">
    <div class="p-5 bg-white border border-gray-200 rounded-2xl">
        <div class="flex items-center justify-between mb-4">
            <div>
                <h1 class="text-xl font-bold text-cyan-700">Form Tambah Alumni</h1>
                <p class="text-gray-500">
                    Isi form tambah alumni dengan lengkap.
                </p>
            </div>
        </div>

        <hr>

<form action="{{ route('admin.student.store') }}" method="POST" class="space-y-6">
    @csrf

    <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
        <!-- NIM -->
        <div>
            <label for="nim" class="block text-sm font-semibold text-gray-700">NIM</label>
            <input type="text" name="nim" id="nim" placeholder="Masukkan NIM"
                class="w-full p-2 mt-1 text-sm border rounded-lg">
        </div>

        <!-- Nama -->
        <div>
            <label for="name" class="block text-sm font-semibold text-gray-700">Nama</label>
            <input type="text" name="name" id="name" placeholder="Masukkan nama"
                class="w-full p-2 mt-1 text-sm border rounded-lg">
        </div>

        <!-- Tanggal Lahir -->
        <div>
            <label for="tanggal_lahir" class="block text-sm font-semibold text-gray-700">Tanggal Lahir</label>
            <input type="date" name="tanggal_lahir" id="tanggal_lahir"
                class="w-full p-2 mt-1 text-sm border rounded-lg">
        </div>

        <!-- Tempat Lahir -->
        <div>
            <label for="tempat_lahir" class="block text-sm font-semibold text-gray-700">Tempat Lahir</label>
            <input type="text" name="tempat_lahir" id="tempat_lahir" placeholder="Masukkan tempat lahir"
                class="w-full p-2 mt-1 text-sm border rounded-lg">
        </div>

        <!-- Program Studi -->
        <div>
            <label for="program_studi" class="block text-sm font-semibold text-gray-700">Program Studi</label>
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

        <!-- Nomor SK Rektor -->
        <div>
            <label for="nomor_sk_rektor" class="block text-sm font-semibold text-gray-700">Nomor SK Rektor</label>
            <input type="text" name="nomor_sk_rektor" id="nomor_sk_rektor" placeholder="Masukkan nomor SK Rektor"
                class="w-full p-2 mt-1 text-sm border rounded-lg">

        </div>

        <!-- Nomor Ijazah -->
        <div>
            <label for="nomor_ijazah" class="block text-sm font-semibold text-gray-700">Nomor Ijazah</label>
            <input type="text" name="nomor_ijazah" id="nomor_ijazah" placeholder="Masukkan nomor ijazah"
                class="w-full p-2 mt-1 text-sm border rounded-lg">
        </div>
    </div>

    <!-- Submit Button -->
    <div class="flex justify-end">
        <button type="submit"
            class="px-6 py-2 font-semibold text-white transition duration-300 rounded-lg shadow bg-cyan-600 hover:bg-cyan-700">
            Simpan Data Alumni
        </button>
    </div>
</form>

    </div>
</div>



@endsection
