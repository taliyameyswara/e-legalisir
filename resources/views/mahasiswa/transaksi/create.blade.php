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

            <form action="{{ route('mahasiswa.transaksi.store') }}" method="POST" class="space-y-6">
                @csrf

                <div class="flex gap-4">
                    <div>
                        <label class="block mb-2 text-sm font-semibold text-gray-700">File Ijazah</label>
                        <a href="{{ isset($file_ijazah) ? asset('storage/' . $file_ijazah->file) : asset('image/default.png') }}"
                            target="_blank" id="ijazahLink">
                            <img src="{{ isset($file_ijazah) ? asset('storage/' . $file_ijazah->file) : asset('image/default.png') }}"
                                alt="Ijazah Preview" class="object-cover rounded-lg min-w-48 h-28" id="ijazahPreview">
                        </a>
                    </div>
                    <div>
                        <label class="block mb-2 text-sm font-semibold text-gray-700">File Transkrip Nilai 1</label>
                        <a href="{{ isset($file_transkrip_1) ? asset('storage/' . $file_transkrip_1->file) : asset('image/default.png') }}"
                            target="_blank" id="ijazahLink">
                            <img src="{{ isset($file_transkrip_1) ? asset('storage/' . $file_transkrip_1->file) : asset('image/default.png') }}"
                                alt="Ijazah Preview" class="object-cover rounded-lg min-w-48 h-28" id="ijazahPreview">
                        </a>
                    </div>
                    @if (isset($file_transkrip_2))
                        <div>
                            <label class="block mb-2 text-sm font-semibold text-gray-700">File Transkrip Nilai 2</label>
                            <a href="{{ isset($file_transkrip_2) ? asset('storage/' . $file_transkrip_2->file) : asset('image/default.png') }}"
                                target="_blank" id="ijazahLink">
                                <img src="{{ isset($file_transkrip_2) ? asset('storage/' . $file_transkrip_2->file) : asset('image/default.png') }}"
                                    alt="Ijazah Preview" class="object-cover rounded-lg min-w-48 h-28" id="ijazahPreview">
                            </a>
                        </div>
                    @endif
                </div>


                <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
                    <!-- Nama Penerima -->
                    <div>
                        <label for="nama_penerima" class="block text-sm font-semibold text-gray-700">Nama Penerima</label>
                        <input type="text" name="nama_penerima" id="nama_penerima" placeholder="Masukkan nama penerima"
                            class="w-full p-2 mt-1 text-sm border rounded-lg">
                    </div>

                    <!-- No HP -->
                    <div>
                        <label for="no_hp" class="block text-sm font-semibold text-gray-700">No HP</label>
                        <input type="text" name="no_hp" id="no_hp" placeholder="Masukkan nomor HP penerima"
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
                        <select name="city_id" id="city_id" class="w-full p-2 mt-1 text-sm border rounded-lg" disabled>
                            <option value="">Pilih Kota/Kabupaten</option>
                        </select>
                    </div>


                    <!-- Kode Pos -->
                    <div>
                        <label for="kode_pos" class="block text-sm font-semibold text-gray-700">Kode Pos</label>
                        <input type="text" name="kode_pos" id="kode_pos" placeholder="Masukkan kode pos"
                            class="w-full p-2 mt-1 text-sm border rounded-lg">
                    </div>

                    <!-- Kurir -->
                    <div>
                        <label for="jumlah_legalisir" class="block text-sm font-semibold text-gray-700">Jumlah Legalisir</label>
                        <input type="number" min="1" max="10" name="jumlah_legalisir" id="jumlah_legalisir" placeholder="Masukkan jumlah legalisir"
                            class="w-full p-2 mt-1 text-sm border rounded-lg">
                        <small>Harga 1 legalisir adalah Rp.7500 dan maksimal pengajuan 10 legalisir</small>
                    </div>

                </div>

                <!-- Alamat Pengiriman -->
                <div>
                    <label for="alamat_pengiriman" class="block text-sm font-semibold text-gray-700">Alamat
                        Pengiriman</label>
                    <textarea name="alamat_pengiriman" id="alamat_pengiriman" rows="3"
                        placeholder="Masukkan alamat lengkap pengiriman" class="w-full p-2 mt-1 text-sm border rounded-lg"></textarea>
                </div>

                <!-- Submit Button -->
                <div class="flex justify-end">
                    <button type="submit"
                        class="px-6 py-2 font-semibold text-white transition duration-300 rounded-lg shadow bg-cyan-600 hover:bg-cyan-700">
                        Ajukan Legalisir
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function () {
            // Load provinsi saat halaman dimuat
            $.ajax({
                url: "/api/provinces",
                type: "GET",
                dataType: "json",
                success: function (data) {
                    let provinceSelect = $("#province_id");
                    data.forEach(function (province) {
                        provinceSelect.append(
                            `<option value="${province.id}">${province.name}</option>`
                        );
                    });
                },
                error: function () {
                    alert("Gagal mengambil data provinsi");
                },
            });

            // Event listener untuk dropdown provinsi
            $("#province_id").on("change", function () {
                let provinceId = $(this).val();
                let citySelect = $("#city_id");

                citySelect.empty().append('<option value="">Pilih Kota/Kabupaten</option>').prop("disabled", true);

                if (provinceId) {
                    $.ajax({
                        url: `/api/cities/${provinceId}`,
                        type: "GET",
                        dataType: "json",
                        success: function (data) {
                            data.forEach(function (city) {
                                citySelect.append(
                                    `<option value="${city.id}">${city.name}</option>`
                                );
                            });
                            citySelect.prop("disabled", false);
                        },
                        error: function () {
                            alert("Gagal mengambil data kota");
                        },
                    });
                }
            });

        });
    </script>

@endsection
