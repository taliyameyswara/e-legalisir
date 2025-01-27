@extends('layouts.admin')

@section('content')
    <div class="border border-gray-200 rounded-2xl p-5 bg-white">
        <a href="{{ route('admin.transaksi.index') }}" class="text-cyan-600 hover:underline">
            ← Kembali </a>
        <div class="flex justify-between items-center my-3">
            <div>
                <h1 class="text-xl font-semibold text-cyan-700">Detail Transaksi Legalisir Ijazah</h1>
                <p class="text-gray-600 text-sm">Berikut adalah detail transaksi yang diajukan mahasiswa.</p>
            </div>
            <p
                class="inline-block px-4 py-2 rounded-full text-xs
            @if ($transaction->status == 'menunggu pembayaran') bg-yellow-100 text-yellow-700 border border-yellow-300
            @elseif($transaction->status == 'proses legalisir') bg-cyan-500/10 border border-cyan-500/50 text-cyan-600
            @elseif($transaction->status == 'pengiriman') bg-indigo-100 text-indigo-700 border border-indigo-300
            @elseif($transaction->status == 'selesai') bg-green-100 text-green-700 border border-green-300
            @else bg-gray-100 text-gray-700 border border-gray-300 @endif">
                {{ ucfirst($transaction->status) }}
            </p>
        </div>

        <div class="flex gap-4 mb-4">
            <div>
                <label class="block text-gray-700 font-semibold text-sm mb-2">File Ijazah</label>
                <a href="{{ $transaction->ijazah ? asset('storage/' . $transaction->ijazah->file) : asset('image/default.png') }}"
                    target="_blank" id="ijazahLink">
                    <img src="{{ isset($transaction->ijazah) ? asset('storage/' . $transaction->ijazah->file) : asset('image/default.png') }}"
                        alt="Ijazah Preview" class="rounded-lg min-w-48 h-28 object-cover" id="ijazahPreview">
                </a>
            </div>
            <div>
                <label class="block text-gray-700 font-semibold text-sm mb-2">File Transkrip Nilai 1</label>
                <a href="{{ isset($transaction->transkrip_1) ? asset('storage/' . $transaction->transkrip_1->file) : asset('image/default.png') }}"
                    target="_blank" id="transkrip1Link">
                    <img src="{{ isset($transaction->transkrip_1) ? asset('storage/' . $transaction->transkrip_1->file) : asset('image/default.png') }}"
                        alt="Transkrip 1 Preview" class="rounded-lg min-w-48 h-28 object-cover" id="transkrip1Preview">
                </a>
            </div>
            @if (isset($transaction->file_transkrip_2))
                <div>
                    <label class="block text-gray-700 font-semibold text-sm mb-2">File Transkrip Nilai 2</label>
                    <a href="{{ isset($transaction->transkrip_2) ? asset('storage/' . $transaction->transkrip_2->file) : asset('image/default.png') }}"
                        target="_blank" id="transkrip2Link">
                        <img src="{{ isset($transaction->transkrip_2) ? asset('storage/' . $transaction->transkrip_2->file) : asset('image/default.png') }}"
                            alt="Transkrip 2 Preview" class="rounded-lg min-w-48 h-28 object-cover" id="transkrip2Preview">
                    </a>
                </div>
            @endif
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-10">
            <!-- Informasi Penerima -->
            <div class="">
                <h2 class="font-bold text-gray-700 mb-2">Informasi Pengiriman</h2>
                <div class="flex ga-3">
                    <div class="flex flex-col w-1/2">
                        <p class="text-gray-500">No Pengiriman</p>
                        <p class="text-gray-500">Kurir</p>
                        <p class="text-gray-500">Alamat</p>
                    </div>

                    <div class="flex flex-col ">
                        <p class="">{{ $transaction->nomor_pengiriman ?? 'Belum Tersedia' }}</p>
                        <p class="">{{ $transaction->kurir }}</p>
                        <div class="">
                            <p class="font-semibold">{{ $transaction->nama_penerima }} </p>
                            <p class=">{{ $transaction->no_hp }} </p>
                            <p class="text-gray-600">
                                {{ $transaction->alamat_pengiriman }} ({{ $transaction->kode_pos }}) </p>
                            <p class="">{{ $transaction->province_id }}, {{ $transaction->city_id }} </p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Rincian Pembayaran -->
            <div class="">
                <h2 class="font-bold text-gray-700 mb-2">Rincian Pembayaran</h2>
                <div class="flex ga-3">
                    <div class="flex flex-col w-1/3">
                        <p class="text-gray-500">Biaya Legalisir</p>
                        <p class="text-gray-500">Biaya Ongkir</p>
                        <p class="text-cyan-600 font-semibold">Total Pembayaran</p>
                    </div>

                    <div class="flex flex-col">
                        <p>
                            Rp{{ number_format(15000, 0, ',', '.') }}
                        </p>

                        <p>
                            Rp{{ number_format(3000, 0, ',', '.') }}
                        </p>

                        <p class="font-semibold text-cyan-600">
                            Rp{{ number_format($transaction->jumlah_pembayaran, 0, ',', '.') }}
                        </p>
                    </div>
                </div>

                <div class="border bg-gray-50 p-3 rounded-xl w-full mt-4">
                    {{-- Form untuk mengisi nomor pengiriman --}}
                    @if ($transaction->status == 'proses legalisir')
                        <form action="{{ route('admin.transaksi.approve', $transaction->id) }}" method="POST">
                            @csrf
                            <div class="grid grid-cols-2 gap-3 items-center">
                                <div class="mb-4">
                                    <label for="nomor_pengiriman" class="block text-gray-700 font-medium text-sm">Nomor
                                        Pengiriman</label>
                                    <input type="text" name="nomor_pengiriman" id="nomor_pengiriman"
                                        placeholder="Masukkan nomor pengiriman" required
                                        class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-cyan-500 focus:border-cyan-500 sm:text-sm">
                                </div>
                                <button type="submit"
                                    class="mt-1 px-4 py-2 bg-cyan-600 text-white rounded-lg hover:bg-cyan-700 text-sm w-fit h-fit">
                                    Kirim Dokumen Legalisir
                                </button>
                            </div>
                        </form>
                    @else
                        <div>
                            <p class="font-semibold">Nomor pengiriman telah ditetapkan</p>
                            <p class="text-cyan-600 text-sm">Nomor: {{ $transaction->nomor_pengiriman }}</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
