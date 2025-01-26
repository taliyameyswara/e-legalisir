@extends('layouts.dashboard')

@section('content')
    <div class="">
        <div class="border border-gray-200 rounded-2xl p-5 bg-white">
            <div class="flex justify-between items-center mb-4">
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
                        <label class="block text-gray-700 font-semibold text-sm mb-2">File Ijazah</label>
                        <a href="{{ isset($file_ijazah) ? asset('storage/' . $file_ijazah->file) : asset('image/default.png') }}"
                            target="_blank" id="ijazahLink">
                            <img src="{{ isset($file_ijazah) ? asset('storage/' . $file_ijazah->file) : asset('image/default.png') }}"
                                alt="Ijazah Preview" class="rounded-lg min-w-48 h-28 object-cover" id="ijazahPreview">
                        </a>
                    </div>
                    <div>
                        <label class="block text-gray-700 font-semibold text-sm mb-2">File Transkrip Nilai 1</label>
                        <a href="{{ isset($file_transkrip_1) ? asset('storage/' . $file_transkrip_1->file) : asset('image/default.png') }}"
                            target="_blank" id="ijazahLink">
                            <img src="{{ isset($file_transkrip_1) ? asset('storage/' . $file_transkrip_1->file) : asset('image/default.png') }}"
                                alt="Ijazah Preview" class="rounded-lg min-w-48 h-28 object-cover" id="ijazahPreview">
                        </a>
                    </div>
                    @if (isset($file_transkrip_2))
                        <div>
                            <label class="block text-gray-700 font-semibold text-sm mb-2">File Transkrip Nilai 2</label>
                            <a href="{{ isset($file_transkrip_2) ? asset('storage/' . $file_transkrip_2->file) : asset('image/default.png') }}"
                                target="_blank" id="ijazahLink">
                                <img src="{{ isset($file_transkrip_2) ? asset('storage/' . $file_transkrip_2->file) : asset('image/default.png') }}"
                                    alt="Ijazah Preview" class="rounded-lg min-w-48 h-28 object-cover" id="ijazahPreview">
                            </a>
                        </div>
                    @endif
                </div>


                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Nama Penerima -->
                    <div>
                        <label for="nama_penerima" class="block text-sm font-semibold text-gray-700">Nama Penerima</label>
                        <input type="text" name="nama_penerima" id="nama_penerima" placeholder="Masukkan nama penerima"
                            class="w-full p-2 border rounded-lg mt-1 text-sm">
                    </div>

                    <!-- No HP -->
                    <div>
                        <label for="no_hp" class="block text-sm font-semibold text-gray-700">No HP</label>
                        <input type="text" name="no_hp" id="no_hp" placeholder="Masukkan nomor HP penerima"
                            class="w-full p-2 border rounded-lg mt-1 text-sm">
                    </div>

                    <!-- Province ID -->
                    <div>
                        <label for="province_id" class="block text-sm font-semibold text-gray-700">Provinsi</label>
                        <select name="province_id" id="province_id" class="w-full p-2 border rounded-lg mt-1 text-sm">
                            <option value="">Pilih Provinsi</option>
                            <option value="Jawa Tengah">Jawa Tengah</option>
                            <option value="Jawa Timur">Jawa Timur</option>
                            <option value="Jawa Barat">Jawa Barat</option>
                        </select>
                    </div>

                    <!-- City ID -->
                    <div>
                        <label for="city_id" class="block text-sm font-semibold text-gray-700">Kota/Kabupaten</label>
                        <select name="city_id" id="city_id" class="w-full p-2 border rounded-lg mt-1 text-sm">
                            <option value="">Pilih Kota/Kabupaten</option>
                            <option value="Semarang">Semarang</option>
                            <option value="Surabaya">Surabaya</option>
                            <option value="Bandung">Bandung</option>
                        </select>
                    </div>

                    <!-- Kode Pos -->
                    <div>
                        <label for="kode_pos" class="block text-sm font-semibold text-gray-700">Kode Pos</label>
                        <input type="text" name="kode_pos" id="kode_pos" placeholder="Masukkan kode pos"
                            class="w-full p-2 border rounded-lg mt-1 text-sm">
                    </div>

                    <!-- Kurir -->
                    <div>
                        <label for="kurir" class="block text-sm font-semibold text-gray-700">Kurir</label>
                        <select name="kurir" id="kurir" class="w-full p-2 border rounded-lg mt-1 text-sm">
                            <option value="">Pilih Kurir</option>
                            <option value="jne">JNE</option>
                            <option value="pos">POS Indonesia</option>
                            <option value="tiki">TIKI</option>
                            <option value="sicepat">SiCepat</option>
                        </select>
                    </div>
                </div>

                <!-- Alamat Pengiriman -->
                <div>
                    <label for="alamat_pengiriman" class="block text-sm font-semibold text-gray-700">Alamat
                        Pengiriman</label>
                    <textarea name="alamat_pengiriman" id="alamat_pengiriman" rows="3"
                        placeholder="Masukkan alamat lengkap pengiriman" class="w-full p-2 border rounded-lg mt-1 text-sm"></textarea>
                </div>

                <!-- Submit Button -->
                <div class="flex justify-end">
                    <button type="submit"
                        class="px-6 py-2 bg-cyan-600 text-white font-semibold rounded-lg hover:bg-cyan-700 shadow transition duration-300">
                        Ajukan Legalisir
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
