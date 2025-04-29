@extends('layouts.dashboard')

@section('content')
    <div class="p-5 bg-white border border-gray-200 rounded-2xl">
        <h1 class="text-xl font-bold text-cyan-700">Edit Biodata</h1>
        <p class="text-gray-500">Silakan perbarui data Anda di bawah ini</p>
        <hr class="my-3">

        {{-- <h2 class="font-bold text-cyan-700 text-md">Data Diri</h2> --}}
        <form action="{{ route('biodata.update') }}" method="POST" class="">
            @csrf
            @method('POST')
            <p class="font-semibold text-cyan-700 text-md">Data Pribadi</p>
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="text-sm text-gray-500" for="nim">NIM</label>
                    <input type="text" id="nim" name="nim" class="w-full p-2 border rounded-lg"
                        value="{{ Auth::user()->nim }}" readonly placeholder="NIM Anda">
                </div>

                <div>
                    <label class="text-sm text-gray-500" for="name">Nama</label>
                    <input type="text" id="name" name="name" class="w-full p-2 border rounded-lg"
                        value="{{ Auth::user()->name }}" required placeholder="Masukkan nama lengkap">
                </div>

                <div>
                    <label class="text-sm text-gray-500" for="tempat_lahir">Tempat Lahir</label>
                    <input type="text" id="tempat_lahir" name="tempat_lahir" class="w-full p-2 border rounded-lg"
                        value="{{ Auth::user()->student->tempat_lahir ?? '' }}" placeholder="Masukkan tempat lahir">
                </div>

                <div>
                    <label class="text-sm text-gray-500" for="tanggal_lahir">Tanggal Lahir</label>
                    <input type="date" id="tanggal_lahir" name="tanggal_lahir" class="w-full p-2 border rounded-lg"
                        value="{{ Auth::user()->student->tanggal_lahir ?? '' }}" placeholder="Pilih tanggal lahir">
                </div>

                <div>
                    <label for="program_studi" class="block text-sm font-semibold text-gray-700">Program Studi</label>
                    <select name="program_studi" required
                        class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-lg focus:outline-none focus:ring-cyan-500 focus:border-cyan-500 sm:text-sm">
                        <option value="">Pilih Program Studi</option>
                        <option value="Sarjana Pendidikan Guru Sekolah Dasar"
                            {{ Auth::user()->student->program_studi == 'Sarjana Pendidikan Guru Sekolah Dasar' ? 'selected' : '' }}>
                            Sarjana
                            Pendidikan Guru Sekolah Dasar</option>
                        <option value="Sarjana Pendidikan Guru Pendidikan Anak Usia Dini"
                            {{ Auth::user()->student->program_studi == 'Sarjana Pendidikan Guru Pendidikan Anak Usia Dini' ? 'selected' : '' }}>
                            Sarjana Pendidikan Guru Pendidikan Anak
                            Usia Dini</option>
                        <option value="Sarjana Bimbingan dan Konseling"
                            {{ Auth::user()->student->program_studi == 'Sarjana Bimbingan dan Konseling' ? 'selected' : '' }}>
                            Sarjana
                            Bimbingan dan Konseling</option>
                        <option value="Sarjana Teknologi Pendidikan"
                            {{ Auth::user()->student->program_studi == 'Sarjana Teknologi Pendidikan' ? 'selected' : '' }}>
                            Sarjana Teknologi
                            Pendidikan</option>
                        <option value="Sarjana Manajemen Pendidikan"
                            {{ Auth::user()->student->program_studi == 'Sarjana Manajemen Pendidikan' ? 'selected' : '' }}>
                            Sarjana Manajemen
                            Pendidikan</option>
                        <option value="Sarjana Pendidikan Masyarakat"
                            {{ Auth::user()->student->program_studi == 'Sarjana Pendidikan Masyarakat' ? 'selected' : '' }}>
                            Sarjana
                            Pendidikan Masyarakat</option>
                        <option value="Sarjana Pendidikan Khusus"
                            {{ Auth::user()->student->program_studi == 'Sarjana Pendidikan Khusus' ? 'selected' : '' }}>Sarjana
                            Pendidikan
                            Khusus</option>
                        <option value="Magister Pendidikan Dasar"
                            {{ Auth::user()->student->program_studi == 'Magister Pendidikan Dasar' ? 'selected' : '' }}>
                            Magister Pendidikan
                            Dasar</option>
                        <option value="Magister Pendidikan Anak Usia Dini"
                            {{ Auth::user()->student->program_studi == 'Magister Pendidikan Anak Usia Dini' ? 'selected' : '' }}>
                            Magister
                            Pendidikan Anak Usia Dini</option>
                        <option value="Magister Bimbingan Konseling"
                            {{ Auth::user()->student->program_studi == 'Magister Bimbingan Konseling' ? 'selected' : '' }}>
                            Magister
                            Bimbingan Konseling</option>
                        <option value="Magister Teknologi Pendidikan"
                            {{ Auth::user()->student->program_studi == 'Magister Teknologi Pendidikan' ? 'selected' : '' }}>
                            Magister
                            Teknologi Pendidikan</option>
                        <option value="Magister Manajemen Pendidikan"
                            {{ Auth::user()->student->program_studi == 'Magister Manajemen Pendidikan' ? 'selected' : '' }}>
                            Magister
                            Manajemen Pendidikan</option>
                        <option value="Magister Pendidikan Masyarakat"
                            {{ Auth::user()->student->program_studi == 'Magister Pendidikan Masyarakat' ? 'selected' : '' }}>
                            Magister
                            Pendidikan Masyarakat</option>
                        <option value="Magister Pendidikan Khusus"
                            {{ Auth::user()->student->program_studi == 'Magister Pendidikan Khusus' ? 'selected' : '' }}>
                            Magister Pendidikan
                            Khusus</option>
                        <option value="Doktor Teknologi Pendidikan"
                            {{ Auth::user()->student->program_studi == 'Doktor Teknologi Pendidikan' ? 'selected' : '' }}>
                            Doktor Teknologi
                            Pendidikan</option>
                        <option value="Doktor Manajemen Pendidikan"
                            {{ Auth::user()->student->program_studi == 'Doktor Manajemen Pendidikan' ? 'selected' : '' }}>
                            Doktor Manajemen
                            Pendidikan</option>
                        <option value="Doktor Pendidikan Anak Dini"
                            {{ Auth::user()->student->program_studi == 'Doktor Pendidikan Anak Dini' ? 'selected' : '' }}>
                            Doktor Pendidikan
                            Anak Dini</option>
                        <option value="Doktor Pendidikan Dasar"
                            {{ Auth::user()->student->program_studi == 'Doktor Pendidikan Dasar' ? 'selected' : '' }}>Doktor
                            Pendidikan
                            Dasar</option>
                    </select>
                </div>
                <div>
                    <label class="text-sm text-gray-500" for="nomor_ijazah">No Ijazah</label>
                    <input type="text" id="nomor_ijazah" name="nomor_ijazah" class="w-full p-2 border rounded-lg"
                        value="{{ Auth::user()->student->nomor_ijazah ?? '' }}" placeholder="Masukkan No Ijazah">
                </div>
                <div>
                    <label class="text-sm text-gray-500" for="no_hp">Nomor HP</label>
                    <input type="text" id="no_hp" name="no_hp" class="w-full p-2 border rounded-lg"
                        value="{{ Auth::user()->student->no_hp ?? '' }}" placeholder="Masukkan nomor HP">
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
                        class="w-full p-2 border rounded-lg" value="{{ Auth::user()->student->alamat_pengiriman ?? '' }}"
                        placeholder="Masukkan alamat">
                </div>

                <div>
                    <label class="text-sm text-gray-500" for="kode_pos">Kode Pos</label>
                    <input type="text" id="kode_pos" name="kode_pos" class="w-full p-2 border rounded-lg"
                        value="{{ Auth::user()->student->kode_pos ?? '' }}" placeholder="Masukkan kode pos">
                </div>
            </div>
            <p class="mt-5 font-semibold text-cyan-700 text-md">Status Pekerjaan</p>
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="text-sm text-gray-500" for="nama_perusahaan">Nama Perusahaan</label>
                    <input type="text" id="nama_perusahaan" name="nama_perusahaan" class="w-full p-2 border rounded-lg"
                        value="{{ Auth::user()->student->nama_perusahaan ?? '' }}" placeholder="Masukkan nama perusahaan">
                </div>

                <div>
                    <label class="text-sm text-gray-500" for="jabatan_perusahaan">Jabatan di Perusahaan</label>
                    <input type="text" id="jabatan_perusahaan" name="jabatan_perusahaan" class="w-full p-2 border rounded-lg"
                        value="{{ Auth::user()->student->jabatan_perusahaan ?? '' }}" placeholder="Masukkan jabatan Anda">
                </div>

                <div>
                    <label class="text-sm text-gray-500" for="alamat_perusahaan">Alamat Perusahaan</label>
                    <input type="text" id="alamat_perusahaan" name="alamat_perusahaan" class="w-full p-2 border rounded-lg"
                        value="{{ Auth::user()->student->alamat_perusahaan ?? '' }}" placeholder="Masukkan alamat perusahaan">
                </div>

                <div>
                    <label for="perusahaan_province_id" class="text-sm ">Provinsi Perusahaan</label>
                    <select name="perusahaan_province_id" id="perusahaan_province_id" class="w-full p-2 mt-1 text-sm border rounded-lg">
                        <option value="">Pilih Provinsi</option>
                        @foreach ($provinces as $province)
                            <option value="{{ $province->id }}"
                                {{ Auth::user()->student->perusahaan_province_id == $province->id ? 'selected' : '' }}>
                                {{ $province->name }}</option>
                        @endforeach
                    </select>
                </div>


                <div>
                    <label class="text-sm text-gray-500" for="gaji">Gaji</label>
                    <input type="number" id="gaji" name="gaji" class="w-full p-2 border rounded-lg"
                        value="{{ Auth::user()->student->gaji ?? '' }}" placeholder="Masukkan nominal gaji">
                </div>
            </div>



            <div class="flex justify-end col-span-2">
                <button type="submit" class="px-4 py-2 text-white rounded-lg bg-cyan-700">Simpan Perubahan</button>
            </div>

        </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            let selectedProvince = "{{ Auth::user()->student->province_id }}";
            let selectedCity = "{{ Auth::user()->student->city_id }}";

            $.ajax({
                url: "/api/provinces",
                type: "GET",
                dataType: "json",
                success: function(data) {
                    let provinceSelect = $("#province_id");
                    data.forEach(function(province) {
                        provinceSelect.append(
                            `<option value="${province.id}" ${province.id == selectedProvince ? 'selected' : ''}>${province.name}</option>`
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
