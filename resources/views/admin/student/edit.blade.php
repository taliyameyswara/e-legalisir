@extends('layouts.admin')

@section('content')
<div class="">
    <div class="p-5 bg-white border border-gray-200 rounded-2xl">
        <div class="flex items-center justify-between mb-4">
            <div>
                <h1 class="text-xl font-bold text-cyan-700">Form Edit Mahasiswa</h1>
                <p class="text-gray-500">
                    Isi form edit mahasiswa dengan lengkap.
                </p>
            </div>
        </div>

        <hr>

        <form action="{{ route('admin.student.update', $student->id) }}" method="POST" class="space-y-6">
            @csrf

            <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
                <!-- NIM -->
                <div>
                    <label for="nim" class="block text-sm font-semibold text-gray-700">NIM</label>
                    <input value="{{ $student->user->nim }}" type="text" name="nim" id="nim" placeholder="Masukkan NIM"
                        class="w-full p-2 mt-1 text-sm border rounded-lg">
                </div>

                <!-- Nama -->
                <div>
                    <label for="name" class="block text-sm font-semibold text-gray-700">Nama</label>
                    <input value="{{ $student->user->name }}" type="text" name="name" id="name" placeholder="Masukkan nama"
                        class="w-full p-2 mt-1 text-sm border rounded-lg">
                </div>

                <!-- Tanggal Lahir -->
                <div>
                    <label for="tanggal_lahir" class="block text-sm font-semibold text-gray-700">Tanggal Lahir</label>
                    <input value="{{ $student->tanggal_lahir }}"  type="date" name="tanggal_lahir" id="tanggal_lahir"
                        class="w-full p-2 mt-1 text-sm border rounded-lg">
                </div>

                <!-- Tempat Lahir -->
                <div>
                    <label for="tempat_lahir" class="block text-sm font-semibold text-gray-700">Tempat Lahir</label>
                    <input value="{{ $student->tempat_lahir }}" type="text" name="tempat_lahir" id="tempat_lahir" placeholder="Masukkan tempat lahir"
                        class="w-full p-2 mt-1 text-sm border rounded-lg">
                </div>

                <!-- Program Studi -->
                <div>
                    <label for="program_studi" class="block text-sm font-semibold text-gray-700">Program Studi</label>
                    <input value="{{ $student->program_studi }}" type="text" name="program_studi" id="program_studi" placeholder="Masukkan program studi"
                        class="w-full p-2 mt-1 text-sm border rounded-lg">
                </div>

                <!-- Nomor SK Rektor -->
                <div>
                    <label for="nomor_sk_rektor" class="block text-sm font-semibold text-gray-700">Nomor SK
                        Rektor</label>
                    <input value="{{ $student->nomor_sk_rektor }}" type="text" name="nomor_sk_rektor" id="nomor_sk_rektor"
                        placeholder="Masukkan nomor SK Rektor" class="w-full p-2 mt-1 text-sm border rounded-lg">
                </div>

                <!-- Nomor Ijazah -->
                <div>
                    <label for="nomor_ijazah" class="block text-sm font-semibold text-gray-700">Nomor Ijazah</label>
                    <input value="{{ $student->nomor_ijazah }}" type="text" name="nomor_ijazah" id="nomor_ijazah" placeholder="Masukkan nomor ijazah"
                        class="w-full p-2 mt-1 text-sm border rounded-lg">
                </div>
            </div>

            <!-- Submit Button -->
            <div class="flex justify-end">
                <button type="submit"
                    class="px-6 py-2 font-semibold text-white transition duration-300 rounded-lg shadow bg-cyan-600 hover:bg-cyan-700">
                    Ubah Data Mahasiswa
                </button>
            </div>
        </form>

    </div>
</div>



@endsection
