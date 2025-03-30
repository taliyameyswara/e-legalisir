@php
    $tipe_pengiriman = request('type');
@endphp


@extends('layouts.dashboard')

@section('content')
    <div class="">
        <div class="p-5 bg-white border border-gray-200 rounded-2xl">
            <div class="flex items-center justify-between mb-4">
                <div>
                    <h1 class="text-xl font-bold text-cyan-700">Form Pengajuan Legalisir</h1>
                    <p class="text-gray-500">
                        Isi form pengajuan legalisir dengan lengkap.
                    </p>
                </div>
            </div>

            <hr>
            @if ($tipe_pengiriman == 'cod')
                <form action="{{ route('mahasiswa.transaksi.store') }}" method="POST" class="space-y-6">
                    @csrf

                    <div class="flex gap-4">
                        @if (isset($file_ijazah))
                            <div>
                                <label class="block mb-2 text-sm font-semibold text-gray-700">File Ijazah</label>
                                <a href="{{ isset($file_ijazah) ? asset('storage/' . $file_ijazah->file) : asset('image/default.png') }}"
                                    target="_blank" id="ijazahLink">
                                    <img src="{{ isset($file_ijazah) ? asset('storage/' . $file_ijazah->file) : asset('image/default.png') }}"
                                        alt="Ijazah Preview" class="object-cover rounded-lg min-w-48 h-28"
                                        id="ijazahPreview">
                                </a>
                            </div>
                        @endif
                        @if (isset($file_transkrip_1))
                            <div>
                                <label class="block mb-2 text-sm font-semibold text-gray-700">File Transkrip Nilai 1</label>
                                <a href="{{ isset($file_transkrip_1) ? asset('storage/' . $file_transkrip_1->file) : asset('image/default.png') }}"
                                    target="_blank" id="ijazahLink">
                                    <img src="{{ isset($file_transkrip_1) ? asset('storage/' . $file_transkrip_1->file) : asset('image/default.png') }}"
                                        alt="Ijazah Preview" class="object-cover rounded-lg min-w-48 h-28"
                                        id="ijazahPreview">
                                </a>
                            </div>
                        @endif
                        @if (isset($file_transkrip_2))
                            <div>
                                <label class="block mb-2 text-sm font-semibold text-gray-700">File Transkrip Nilai 2</label>
                                <a href="{{ isset($file_transkrip_2) ? asset('storage/' . $file_transkrip_2->file) : asset('image/default.png') }}"
                                    target="_blank" id="ijazahLink">
                                    <img src="{{ isset($file_transkrip_2) ? asset('storage/' . $file_transkrip_2->file) : asset('image/default.png') }}"
                                        alt="Ijazah Preview" class="object-cover rounded-lg min-w-48 h-28"
                                        id="ijazahPreview">
                                </a>
                            </div>
                        @endif
                        @if (isset($file_akta))
                            <div>
                                <label class="block mb-2 text-sm font-semibold text-gray-700">File Akta Mengajar</label>
                                <a href="{{ isset($file_akta) ? asset('storage/' . $file_akta->file) : asset('image/default.png') }}"
                                    target="_blank" id="ijazahLink">
                                    <img src="{{ isset($file_akta) ? asset('storage/' . $file_akta->file) : asset('image/default.png') }}"
                                        alt="Ijazah Preview" class="object-cover rounded-lg min-w-48 h-28"
                                        id="ijazahPreview">
                                </a>
                            </div>
                        @endif
                    </div>


                    <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
                        <!-- Nama Penerima -->
                        <div>
                            <label for="nama_penerima" class="block text-sm font-semibold text-gray-700">Nama
                                Penerima</label>
                            <input type="text" name="nama_penerima" id="nama_penerima"
                                placeholder="Masukkan nama penerima" value={{ Auth::user()->name }}
                                class="w-full p-2 mt-1 text-sm border rounded-lg">
                        </div>

                        <!-- No HP -->
                        <div>
                            <label for="no_hp" class="block text-sm font-semibold text-gray-700">No HP</label>
                            <input type="text" name="no_hp" id="no_hp" placeholder="Masukkan nomor HP penerima"
                                value="{{ Auth::user()->student->no_hp ?? '' }}"
                                class="w-full p-2 mt-1 text-sm border rounded-lg">
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
                            <select name="city_id" id="city_id" class="w-full p-2 mt-1 text-sm border rounded-lg"
                                disabled>
                                <option value="">Pilih Kota/Kabupaten</option>
                            </select>
                        </div>



                        <!-- Kode Pos -->
                        <div>
                            <label for="kode_pos" class="block text-sm font-semibold text-gray-700">Kode Pos</label>
                            <input type="text" name="kode_pos" id="kode_pos" placeholder="Masukkan kode pos"
                                value="{{ Auth::user()->student->kode_pos ?? '' }}"
                                class="w-full p-2 mt-1 text-sm border rounded-lg">
                        </div>

                        <input type="text" name="tipe_pengiriman" value="{{ $tipe_pengiriman }}" hidden>

                        <!-- Kurir -->
                        <div>
                            <label for="jumlah_legalisir" class="block text-sm font-semibold text-gray-700">
                                Jumlah Legalisir
                            </label>
                            <input type="number" min="1" max="10" name="jumlah_legalisir"
                                id="jumlah_legalisir" placeholder="Masukkan jumlah legalisir"
                                class="w-full p-2 mt-1 text-sm border rounded-lg">

                            <small class="block mt-1">
                                <strong>Ketentuan harga legalisir:</strong>
                            </small>

                            <ul class="pl-5 text-xs list-disc ">
                                <li>Jika memiliki <strong>Akta Mengajar</strong>, harga legalisir adalah
                                    <strong>Rp10.000</strong> per dokumen.
                                </li>
                                <li>Jika <strong>tidak memiliki Akta Mengajar</strong>:
                                    <ul class="pl-5 list-disc">
                                        <li>Untuk jenjang <strong>Sarjana (S1)</strong>, harga legalisir adalah
                                            <strong>Rp5.000</strong> per dokumen.
                                        </li>
                                        <li>Untuk jenjang <strong>Magister (S2) dan Doktor (S3)</strong>, harga legalisir
                                            adalah
                                            <strong>Rp10.000</strong> per dokumen.
                                        </li>
                                    </ul>
                                </li>
                                <li>Maksimal pengajuan legalisir adalah <strong>10 dokumen</strong> dalam satu transaksi.
                                </li>
                            </ul>
                        </div>

                    </div>

                    <!-- Alamat Pengiriman -->
                    <div>
                        <label for="alamat_pengiriman" class="block text-sm font-semibold text-gray-700">Alamat
                            Pengiriman</label>
                        <textarea name="alamat_pengiriman" id="alamat_pengiriman" rows="3"
                            placeholder="Masukkan alamat lengkap pengiriman" class="w-full p-2 mt-1 text-sm border rounded-lg">{{ Auth::user()->student->alamat_pengiriman ?? '' }}</textarea>

                    </div>

                    <!-- Submit Button -->
                    <div class="flex justify-end">
                        <button type="submit"
                            class="px-6 py-2 font-semibold text-white transition duration-300 rounded-lg shadow bg-cyan-600 hover:bg-cyan-700">
                            Ajukan Legalisir
                        </button>
                    </div>
                </form>
            @elseif($tipe_pengiriman == 'ambil-kampus')
                <form action="{{ route('mahasiswa.transaksi.storeAmbilKampus') }}" method="POST" class="space-y-6">
                    @csrf

                    <div class="flex gap-4">
                        @if (isset($file_ijazah))
                            <div>
                                <label class="block mb-2 text-sm font-semibold text-gray-700">File Ijazah</label>
                                <a href="{{ isset($file_ijazah) ? asset('storage/' . $file_ijazah->file) : asset('image/default.png') }}"
                                    target="_blank" id="ijazahLink">
                                    <img src="{{ isset($file_ijazah) ? asset('storage/' . $file_ijazah->file) : asset('image/default.png') }}"
                                        alt="Ijazah Preview" class="object-cover rounded-lg min-w-48 h-28"
                                        id="ijazahPreview">
                                </a>
                            </div>
                        @endif
                        @if (isset($file_transkrip_1))
                            <div>
                                <label class="block mb-2 text-sm font-semibold text-gray-700">File Transkrip Nilai
                                    1</label>
                                <a href="{{ isset($file_transkrip_1) ? asset('storage/' . $file_transkrip_1->file) : asset('image/default.png') }}"
                                    target="_blank" id="ijazahLink">
                                    <img src="{{ isset($file_transkrip_1) ? asset('storage/' . $file_transkrip_1->file) : asset('image/default.png') }}"
                                        alt="Ijazah Preview" class="object-cover rounded-lg min-w-48 h-28"
                                        id="ijazahPreview">
                                </a>
                            </div>
                        @endif
                        @if (isset($file_transkrip_2))
                            <div>
                                <label class="block mb-2 text-sm font-semibold text-gray-700">File Transkrip Nilai
                                    2</label>
                                <a href="{{ isset($file_transkrip_2) ? asset('storage/' . $file_transkrip_2->file) : asset('image/default.png') }}"
                                    target="_blank" id="ijazahLink">
                                    <img src="{{ isset($file_transkrip_2) ? asset('storage/' . $file_transkrip_2->file) : asset('image/default.png') }}"
                                        alt="Ijazah Preview" class="object-cover rounded-lg min-w-48 h-28"
                                        id="ijazahPreview">
                                </a>
                            </div>
                        @endif
                        @if (isset($file_akta))
                            <div>
                                <label class="block mb-2 text-sm font-semibold text-gray-700">File Akta Mengajar</label>
                                <a href="{{ isset($file_akta) ? asset('storage/' . $file_akta->file) : asset('image/default.png') }}"
                                    target="_blank" id="ijazahLink">
                                    <img src="{{ isset($file_akta) ? asset('storage/' . $file_akta->file) : asset('image/default.png') }}"
                                        alt="Ijazah Preview" class="object-cover rounded-lg min-w-48 h-28"
                                        id="ijazahPreview">
                                </a>
                            </div>
                        @endif
                    </div>


                    <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
                        <!-- Nama Penerima -->
                        <div>
                            <label for="nama_penerima" class="block text-sm font-semibold text-gray-700">Nama
                                Penerima</label>
                            <input type="text" name="nama_penerima" id="nama_penerima"
                                placeholder="Masukkan nama penerima" value={{ Auth::user()->name }}
                                class="w-full p-2 mt-1 text-sm border rounded-lg">
                        </div>

                        <!-- No HP -->
                        <div>
                            <label for="no_hp" class="block text-sm font-semibold text-gray-700">No HP</label>
                            <input type="text" name="no_hp" id="no_hp" placeholder="Masukkan nomor HP penerima"
                                value="{{ Auth::user()->student->no_hp ?? '' }}"
                                class="w-full p-2 mt-1 text-sm border rounded-lg">
                        </div>

                        <!-- Province ID -->


                        <input type="text" name="tipe_pengiriman" value="{{ $tipe_pengiriman }}" hidden>

                        <!-- Kurir -->
                        <div>
                            <label for="jumlah_legalisir" class="block text-sm font-semibold text-gray-700">
                                Jumlah Legalisir
                            </label>
                            <input type="number" min="1" max="10" name="jumlah_legalisir"
                                id="jumlah_legalisir" placeholder="Masukkan jumlah legalisir"
                                class="w-full p-2 mt-1 text-sm border rounded-lg">

                            <small class="block mt-1">
                                <strong>Ketentuan harga legalisir:</strong>
                            </small>

                            <ul class="pl-5 text-xs list-disc ">
                                <li>Jika memiliki <strong>Akta Mengajar</strong>, harga legalisir adalah
                                    <strong>Rp10.000</strong> per dokumen.
                                </li>
                                <li>Jika <strong>tidak memiliki Akta Mengajar</strong>:
                                    <ul class="pl-5 list-disc">
                                        <li>Untuk jenjang <strong>Sarjana (S1)</strong>, harga legalisir adalah
                                            <strong>Rp5.000</strong> per dokumen.
                                        </li>
                                        <li>Untuk jenjang <strong>Magister (S2) dan Doktor (S3)</strong>, harga legalisir
                                            adalah
                                            <strong>Rp10.000</strong> per dokumen.
                                        </li>
                                    </ul>
                                </li>
                                <li>Maksimal pengajuan legalisir adalah <strong>10 dokumen</strong> dalam satu transaksi.
                                </li>
                            </ul>
                        </div>

                    </div>



                    <!-- Submit Button -->
                    <div class="flex justify-end">
                        <button type="submit"
                            class="px-6 py-2 font-semibold text-white transition duration-300 rounded-lg shadow bg-cyan-600 hover:bg-cyan-700">
                            Ajukan Legalisir
                        </button>
                    </div>
                    <small class="flex justify-end text-gray-500">
                        (Ketentuan Pengajuan Legalisir : Apabila dokumen sudah berhasil di acc dan dilegalisir, dimohon agar
                        mengambil dokumen yang sudah dilegalisir diambil di kampus)
                    </small>
                </form>
            @endif

        </div>
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
