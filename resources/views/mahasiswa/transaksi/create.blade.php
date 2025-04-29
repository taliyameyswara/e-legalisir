@extends('layouts.dashboard')

@section('content')
    <div class="">
        <div class="p-5 bg-white rounded-2xl border border-gray-200">
            <div class="flex justify-between items-center mb-4">
                <div>
                    <h1 class="text-xl font-bold text-cyan-700">Form Pengajuan Legalisir</h1>
                    <p class="text-gray-500">
                        Isi form pengajuan legalisir dengan lengkap.
                    </p>
                </div>
            </div>

            <hr class="mb-4">
            <div class="flex gap-4">
                @if (isset($file_ijazah))
                    <div>
                        <label class="block mb-2 text-sm font-semibold text-gray-700">File Ijazah</label>
                        <div class="flex gap-3 items-center">
                            <img src="{{ asset('image/pdf.png') }}" alt="" class="object-cover w-12 h-12 rounded-lg" id="ijazahPreview">
                            <div class="flex flex-col">
                                <p class="text-sm text-gray-500 truncate" id="ijazahFileName">
                                    {{ isset($file_ijazah) ? $file_ijazah->file_name : 'Tidak ada file yang diunggah' }}
                                </p>
                                @if (isset($file_ijazah))
                                    <a href="{{ asset( $file_ijazah->file) }}" target="_blank" class="text-sm text-cyan-600 hover:underline">Lihat File</a>
                                @endif
                            </div>
                        </div>
                    </div>

                @endif
                @if (isset($file_transkrip))
                    <div>
                        <label class="block mb-2 text-sm font-semibold text-gray-700">File Transkrip Nilai</label>
                        <div class="flex gap-3 items-center">
                            <img src="{{ asset('image/pdf.png') }}" alt="" class="object-cover w-12 h-12 rounded-lg" id="transkripPreview">
                            <div class="flex flex-col">
                                <p class="text-sm text-gray-500 truncate" id="transkripFileName">
                                    {{ isset($file_transkrip) ? $file_transkrip->file_name : 'Tidak ada file yang diunggah' }}
                                </p>
                                @if (isset($file_transkrip))
                                    <a href="{{ asset( $file_transkrip->file) }}" target="_blank" class="text-sm text-cyan-600 hover:underline">Lihat File</a>
                                @endif
                            </div>
                        </div>
                    </div>
                @endif
                @if (isset($file_akta))
                    <div>
                        <label class="block mb-2 text-sm font-semibold text-gray-700">File Akta Mengajar</label>
                        <div class="flex gap-3 items-center">
                            <img src="{{ asset('image/pdf.png') }}" alt="" class="object-cover w-12 h-12 rounded-lg" id="aktaMengajarPreview">
                            <div class="flex flex-col">
                                <p class="text-sm text-gray-500 truncate" id="aktaMengajarFileName">
                                    {{ isset($file_akta) ? $file_akta->file_name : 'Tidak ada file yang diunggah' }}
                                </p>
                                @if (isset($file_akta))
                                    <a href="{{ asset( $file_akta->file) }}" target="_blank" class="text-sm text-cyan-600 hover:underline">Lihat File</a>
                                @endif
                            </div>
                        </div>
                    </div>
                @endif
            </div>
                <form action="{{ route('mahasiswa.transaksi.store') }}" method="POST" class="space-y-6">
                    @csrf
                    <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
                        <!-- Nama Penerima -->
                        <div>
                            <label for="nama_penerima" class="block text-sm font-semibold text-gray-700">Nama
                                Penerima</label>
                            <input type="text" name="nama_penerima" id="nama_penerima"
                                placeholder="Masukkan nama penerima" value={{ Auth::user()->name }}
                                class="p-2 mt-1 w-full text-sm rounded-lg border">
                        </div>

                        <!-- No HP -->
                        <div>
                            <label for="no_hp" class="block text-sm font-semibold text-gray-700">No HP</label>
                            <input type="text" name="no_hp" id="no_hp" placeholder="Masukkan nomor HP penerima"
                                value="{{ Auth::user()->student->no_hp ?? '' }}"
                                class="p-2 mt-1 w-full text-sm rounded-lg border">
                        </div>

                        <!-- Province ID -->
                        <div>
                            <label for="province_id" class="block text-sm font-semibold text-gray-700">Provinsi</label>
                            <select name="province_id" id="province_id" class="p-2 mt-1 w-full text-sm rounded-lg border">
                                <option value="">Pilih Provinsi</option>
                            </select>
                        </div>

                        <!-- City ID -->
                        <div>
                            <label for="city_id" class="block text-sm font-semibold text-gray-700">Kota/Kabupaten</label>
                            <select name="city_id" id="city_id" class="p-2 mt-1 w-full text-sm rounded-lg border"
                                disabled>
                                <option value="">Pilih Kota/Kabupaten</option>
                            </select>
                        </div>


                        <div>
                            <label for="kode_pos" class="block text-sm font-semibold text-gray-700">Kode Pos</label>
                            <input type="text" name="kode_pos" id="kode_pos" placeholder="Masukkan kode pos"
                                value="{{ Auth::user()->student->kode_pos ?? '' }}"
                                class="p-2 mt-1 w-full text-sm rounded-lg border">
                        </div>


                        @if (isset($file_ijazah))
                        <div>
                            <label for="jumlah_ijazah" class="block text-sm font-semibold text-gray-700">
                                Jumlah Legalisir Ijazah
                            </label>
                            <input type="number" min="1" max="10" name="jumlah_ijazah" value="{{ $file_ijazah->jumlah ?? 0 }}"
                                id="jumlah_ijazah" placeholder="Masukkan jumlah legalisir ijazah"
                                class="p-2 mt-1 w-full text-sm rounded-lg border">
                        </div>
                        @endif
                        @if (isset($file_transkrip))
                        <div>
                            <label for="jumlah_transkrip" class="block text-sm font-semibold text-gray-700">
                                Jumlah Legalisir Transkrip
                            </label>
                            <input type="number" min="1" max="10" name="jumlah_transkrip" value="{{ $file_transkrip->jumlah  ?? 0}}"
                                id="jumlah_transkrip" placeholder="Masukkan jumlah legalisir transkrip"
                                class="p-2 mt-1 w-full text-sm rounded-lg border">
                        </div>
                        @endif
                        @if (isset($file_akta))
                        <div>
                            <label for="jumlah_akta" class="block text-sm font-semibold text-gray-700">
                                Jumlah Legalisir Akta Mengajar
                            </label>
                            <input type="number" min="1" max="10" name="jumlah_akta" value="{{ $file_akta->jumlah ?? 0 }}"
                                id="jumlah_akta" placeholder="Masukkan jumlah legalisir akta"
                                class="p-2 mt-1 w-full text-sm rounded-lg border">
                        </div>
                        @endif

                        {{-- <div>
                            <label for="shipping_method" class="block text-sm font-semibold text-gray-700">Metode Pengiriman</label>
                            <select name="shipping_method" id="shipping_method" class="p-2 mt-1 w-full text-sm rounded-lg border" disabled>
                                <option value="">Pilih metode pengiriman</option>
                            </select>
                        </div>
                        <div id="loading-shipping" class="flex hidden gap-2 items-center pt-5 text-sm text-gray-500">
                            <svg class="w-5 h-5 text-cyan-600 animate-spin" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v8z"></path>
                            </svg>
                            Mengambil data metode pengiriman...
                        </div> --}}
                    </div>
                    <!-- Alamat Pengiriman -->
                    <div>
                        <label for="alamat_pengiriman" class="block text-sm font-semibold text-gray-700">Alamat
                            Pengiriman</label>
                        <textarea name="alamat_pengiriman" id="alamat_pengiriman" rows="3"
                            placeholder="Masukkan alamat lengkap pengiriman" class="p-2 mt-1 w-full text-sm rounded-lg border">{{ Auth::user()->student->alamat_pengiriman ?? '' }}</textarea>
                            <small class="block mt-1">
                                <strong>Ketentuan harga legalisir:</strong>
                            </small>

                            <ul class="pl-5 text-xs list-disc">
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

                    <!-- Submit Button -->
                    <div class="flex justify-end">
                        <button type="submit"
                            class="px-6 py-2 font-semibold text-white bg-cyan-600 rounded-lg shadow transition duration-300 hover:bg-cyan-700">
                            Ajukan Legalisir
                        </button>
                    </div>
                </form>


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

                            // Panggil check-ongkir jika city terpilih
                            if (selectedCity) {
                                loadShippingMethod(selectedCity);
                            }
                        },
                        error: function() {
                            alert("Gagal mengambil data kota");
                        },
                    });
                }
            }


            function loadShippingMethod(cityId) {
                let shippingSelect = $("#shipping_method");

                shippingSelect.empty().append('<option value="">Pilih metode pengiriman</option>').prop("disabled", true);

                if (cityId) {
                    $("#loading-shipping").removeClass("hidden"); // 👉 Tampilkan loading
                    $.ajax({
                        url: `/api/check-ongkir/${cityId}`,
                        type: "GET",
                        dataType: "json",
                        success: function(data) {
                            if (data.length > 0) {
                                data.forEach(function(service) {
                                    shippingSelect.append(
                                        `<option value="${service.service} - ${service.description} | ${service.cost[0].value}">${service.service} - ${service.description} (Rp${service.cost[0].value})</option>`
                                    );
                                });
                                shippingSelect.prop("disabled", false);
                                $("#loading-shipping").addClass("hidden"); // 👉 Sembunyikan loading
                            }
                        },
                        error: function() {
                            alert("Gagal mengambil data pengiriman");
                        },
                    });
                }
            }

            $("#city_id").on("change", function() {
                let cityId = $(this).val();
                loadShippingMethod(cityId);
            });



            // $("#city_id").on("change", function() {
            //     let cityId = $(this).val();
            //     let shippingSelect = $("#shipping_method");

            //     shippingSelect.empty().append('<option value="">Pilih metode pengiriman</option>').prop("disabled", true);

            //     if (cityId) {
            //         $.ajax({
            //             url: `/api/check-ongkir/${cityId}`,
            //             type: "GET",
            //             dataType: "json",
            //             success: function(data) {
            //                 if (data.length > 0) {
            //                     data.forEach(function(service) {
            //                         shippingSelect.append(
            //                             `<option value="${service.service}">${service.service} - ${service.description} (Rp${service.cost[0].value})</option>`
            //                         );
            //                     });
            //                     shippingSelect.prop("disabled", false);
            //                 }
            //             },
            //             error: function() {
            //                 alert("Gagal mengambil data pengiriman");
            //             },
            //         });
            //     }
            // });

        });
    </script>
@endsection
