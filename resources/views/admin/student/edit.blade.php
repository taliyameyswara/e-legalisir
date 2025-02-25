@extends('layouts.admin')

@section('content')
<div class="">
    <div class="p-5 bg-white border border-gray-200 rounded-2xl">
        <div class="flex items-center justify-between mb-4">
            <div>
                <h1 class="text-xl font-bold text-cyan-700">Form Edit Alumni</h1>
                <p class="text-gray-500">
                    Isi form edit alumni dengan lengkap.
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
                <select name="program_studi" required
                    class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-lg focus:outline-none focus:ring-cyan-500 focus:border-cyan-500 sm:text-sm">
                    <option value="Sarjana Pendidikan Guru Sekolah Dasar" {{ $student->program_studi == 'Sarjana Pendidikan Guru Sekolah Dasar' ? 'selected' : '' }}>Sarjana Pendidikan Guru Sekolah Dasar</option>
                    <option value="Sarjana Pendidikan Guru Pendidikan Anak Usia Dini"  {{ $student->program_studi == 'Sarjana Pendidikan Guru Pendidikan Anak Usia Dini' ? 'selected' : '' }}>Sarjana Pendidikan Guru Pendidikan Anak
                        Usia Dini</option>
                    <option value="Sarjana Bimbingan dan Konseling" {{ $student->program_studi == 'Sarjana Bimbingan dan Konseling' ? 'selected' : '' }}>Sarjana Bimbingan dan Konseling</option>
                    <option value="Sarjana Teknologi Pendidikan" {{ $student->program_studi == 'Sarjana Teknologi Pendidikan' ? 'selected' : '' }}>Sarjana Teknologi Pendidikan</option>
                    <option value="Sarjana Manajemen Pendidikan" {{ $student->program_studi == 'Sarjana Manajemen Pendidikan' ? 'selected' : '' }}>Sarjana Manajemen Pendidikan</option>
                    <option value="Sarjana Pendidikan Masyarakat" {{ $student->program_studi == 'Sarjana Pendidikan Masyarakat' ? 'selected' : '' }}>Sarjana Pendidikan Masyarakat</option>
                    <option value="Sarjana Pendidikan Khusus" {{ $student->program_studi == 'Sarjana Pendidikan Khusus' ? 'selected' : '' }}>Sarjana Pendidikan Khusus</option>
                    <option value="Magister Pendidikan Dasar" {{ $student->program_studi == 'Magister Pendidikan Dasar' ? 'selected' : '' }}>Magister Pendidikan Dasar</option>
                    <option value="Magister Pendidikan Anak Usia Dini" {{ $student->program_studi == 'Magister Pendidikan Anak Usia Dini' ? 'selected' : '' }}>Magister Pendidikan Anak Usia Dini</option>
                    <option value="Magister Bimbingan Konseling" {{ $student->program_studi == 'Magister Bimbingan Konseling' ? 'selected' : '' }}>Magister Bimbingan Konseling</option>
                    <option value="Magister Teknologi Pendidikan" {{ $student->program_studi == 'Magister Teknologi Pendidikan' ? 'selected' : '' }}>Magister Teknologi Pendidikan</option>
                    <option value="Magister Manajemen Pendidikan" {{ $student->program_studi == 'Magister Manajemen Pendidikan' ? 'selected' : '' }}>Magister Manajemen Pendidikan</option>
                    <option value="Magister Pendidikan Masyarakat" {{ $student->program_studi == 'Magister Pendidikan Masyarakat' ? 'selected' : '' }}>Magister Pendidikan Masyarakat</option>
                    <option value="Magister Pendidikan Khusus" {{ $student->program_studi == 'Magister Pendidikan Khusus' ? 'selected' : '' }}>Magister Pendidikan Khusus</option>
                    <option value="Doktor Teknologi Pendidikan" {{ $student->program_studi == 'Doktor Teknologi Pendidikan' ? 'selected' : '' }}>Doktor Teknologi Pendidikan</option>
                    <option value="Doktor Manajemen Pendidikan" {{ $student->program_studi == 'Doktor Manajemen Pendidikan' ? 'selected' : '' }}>Doktor Manajemen Pendidikan</option>
                    <option value="Doktor Pendidikan Anak Dini" {{ $student->program_studi == 'Doktor Pendidikan Anak Dini' ? 'selected' : '' }}>Doktor Pendidikan Anak Dini</option>
                    <option value="Doktor Pendidikan Dasar" {{ $student->program_studi == 'Doktor Pendidikan Dasar' ? 'selected' : '' }}>Doktor Pendidikan Dasar</option>
                </select>
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
                    Ubah Data Alumni
                </button>
            </div>
        </form>

    </div>
</div>



@endsection
