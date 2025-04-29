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
    <p class="font-semibold text-cyan-700 text-md">Data Pribadi</p>
    <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
        <!-- NIM -->
        <div>
            <label for="nim" class="block text-sm font-semibold text-gray-700">NIM <span class="text-red-500">*</span> </label>
            <input type="text" name="nim" id="nim" placeholder="Masukkan NIM"
                class="w-full p-2 mt-1 text-sm border rounded-lg">
        </div>

        <!-- Nama -->
        <div>
            <label for="name" class="block text-sm font-semibold text-gray-700">Nama <span class="text-red-500">*</span></label>
            <input type="text" name="name" id="name" placeholder="Masukkan nama"
                class="w-full p-2 mt-1 text-sm border rounded-lg">
        </div>

        <!-- Tempat Lahir -->
        <div>
            <label for="tempat_lahir" class="block text-sm font-semibold text-gray-700">Tempat Lahir</label>
            <input type="text" name="tempat_lahir" id="tempat_lahir" placeholder="Masukkan tempat lahir"
                class="w-full p-2 mt-1 text-sm border rounded-lg">
        </div>

        <!-- Tanggal Lahir -->
        <div>
            <label for="tanggal_lahir" class="block text-sm font-semibold text-gray-700">Tanggal Lahir</label>
            <input type="date" name="tanggal_lahir" id="tanggal_lahir"
                class="w-full p-2 mt-1 text-sm border rounded-lg">
        </div>

        <!-- Program Studi -->
        <div>
            <label for="program_studi" class="block text-sm font-semibold text-gray-700">Program Studi</label>
            <select name="program_studi"
                class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-lg focus:outline-none focus:ring-cyan-500 focus:border-cyan-500 sm:text-sm">
                <option value="">Pilih Program Studi</option>

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



        <!-- Nomor Ijazah -->
        <div>
            <label for="nomor_ijazah" class="block text-sm font-semibold text-gray-700">Nomor Ijazah</label>
            <input type="text" name="nomor_ijazah" id="nomor_ijazah" placeholder="Masukkan nomor ijazah"
                class="w-full p-2 mt-1 text-sm border rounded-lg">
        </div>

        <div>
            <label class="text-sm text-gray-500" for="no_hp">Nomor HP</label>
            <input type="text" id="no_hp" name="no_hp" class="w-full p-2 border rounded-lg" placeholder="Masukkan nomor HP">
        </div>

        <!-- Province ID -->
        <div>
            <label for="province_id" class="block text-sm font-semibold text-gray-700">Provinsi</label>
            <select name="province_id" id="province_id" class="w-full p-2 mt-1 text-sm border rounded-lg">
                <option value="">Pilih Provinsi</option>
            </select>
        </div>

        <!-- City ID -->
        <div>
            <label for="city_id" class="block text-sm font-semibold text-gray-700">Kota/Kabupaten</label>
            <select name="city_id" id="city_id" class="w-full p-2 mt-1 text-sm border rounded-lg" disabled>
                <option value="">Pilih Kota/Kabupaten</option>
            </select>
        </div>

        <div>
            <label class="text-sm text-gray-500" for="alamat_pengiriman">Alamat</label>
            <input type="text" id="alamat_pengiriman" name="alamat_pengiriman"
                class="w-full p-2 border rounded-lg"
                placeholder="Masukkan alamat">
        </div>

        <div>
            <label class="text-sm text-gray-500" for="kode_pos">Kode Pos</label>
            <input type="text" id="kode_pos" name="kode_pos" class="w-full p-2 border rounded-lg"
                placeholder="Masukkan kode pos">
        </div>
    </div>
    <p class="mt-5 font-semibold text-cyan-700 text-md">Status Pekerjaan</p>
    <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
        <div>
            <label class="text-sm text-gray-500" for="nama_perusahaan">Nama Perusahaan</label>
            <input type="text" id="nama_perusahaan" name="nama_perusahaan" class="w-full p-2 border rounded-lg"
                 placeholder="Masukkan nama perusahaan">
        </div>

        <div>
            <label class="text-sm text-gray-500" for="jabatan_perusahaan">Jabatan di Perusahaan</label>
            <input type="text" id="jabatan_perusahaan" name="jabatan_perusahaan" class="w-full p-2 border rounded-lg"
                 placeholder="Masukkan jabatan Anda">
        </div>

        <div>
            <label class="text-sm text-gray-500" for="alamat_perusahaan">Alamat Perusahaan</label>
            <input type="text" id="alamat_perusahaan" name="alamat_perusahaan" class="w-full p-2 border rounded-lg"
                placeholder="Masukkan alamat perusahaan">
        </div>

        <div>
            <label for="perusahaan_province_id" class="text-sm ">Provinsi Perusahaan</label>
            <select name="perusahaan_province_id" id="perusahaan_province_id" class="w-full p-2 mt-1 text-sm border rounded-lg">
                <option value="">Pilih Provinsi</option>
                @foreach ($provinces as $province)
                    <option value="{{ $province->id }}">
                        {{ $province->name }}</option>
                @endforeach
            </select>
        </div>

        <div>
            <label class="text-sm text-gray-500" for="gaji">Gaji</label>
            <input type="number" id="gaji" name="gaji" class="w-full p-2 border rounded-lg" placeholder="Masukkan nominal gaji">
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

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {

            $.ajax({
                url: "/api/provinces",
                type: "GET",
                dataType: "json",
                success: function(data) {
                    let provinceSelect = $("#province_id");
                    data.forEach(function(province) {
                        provinceSelect.append(
                            `<option value="${province.id}">${province.name}</option>`
                        );
                    });
                    if (selectedProvince) {
                        loadCities(selectedProvince, selectedCity);
                    }
                },
                error: function() {
                    alert("Gagal mengambil data provinsi");
                },
            });

            $("#province_id").on("change", function() {
                let provinceId = $(this).val();
                loadCities(provinceId, null);
            });

            function loadCities(provinceId, selectedCity) {
                let citySelect = $("#city_id");
                citySelect.empty().append('<option value="">Pilih Kota/Kabupaten</option>').prop("disabled", true);
                if (provinceId) {
                    $.ajax({
                        url: `/api/cities/${provinceId}`,
                        type: "GET",
                        dataType: "json",
                        success: function(data) {
                            data.forEach(function(city) {
                                citySelect.append(
                                    `<option value="${city.id}" ${city.id == selectedCity ? 'selected' : ''}>${city.name}</option>`
                                );
                            });
                            citySelect.prop("disabled", false);
                        },
                        error: function() {
                            alert("Gagal mengambil data kota");
                        },
                    });
                }
            }
        });
    </script>


@endsection
