@php

    $file_ijazah = $transaction->file_ijazah;
    $is_akta = $transaction->file_akta;
    $biaya_legalisir = 0;
    $biaya_akta = 0;

    $program_studi = $transaction->user->student->program_studi ?? '';
    if (str_contains($program_studi, 'Sarjana')) {
        $biaya_legalisir = 5000;
    } elseif (str_contains($program_studi, 'Magister') || str_contains($program_studi, 'Doktor')) {
        $biaya_legalisir = 10000;
    } else {
        $biaya_legalisir = 5000; // Default jika tidak sesuai
    }

    if ($is_akta) {
        $biaya_akta = 10000;
    }
@endphp


@extends('layouts.admin')

@section('content')
    <div class="p-5 bg-white border border-gray-200 rounded-2xl">
        <a href="{{ route('admin.transaksi.index') }}" class="text-cyan-600 hover:underline">
            ← Kembali </a>
        <div class="flex items-center justify-between my-3">
            <div>
                <h1 class="text-xl font-semibold text-cyan-700">Detail Transaksi Legalisir Ijazah</h1>
                <p class="text-sm text-gray-600">Berikut adalah detail transaksi yang diajukan alumni.</p>
            </div>
            <p
                class="inline-block px-4 py-2 rounded-full text-xs
            @if ($transaction->status == 'menunggu pembayaran') bg-yellow-100 text-yellow-700 border border-yellow-300
            @elseif($transaction->status == 'proses legalisir') bg-cyan-500/10 border border-cyan-500/50 text-cyan-600
            @elseif($transaction->status == 'pengiriman') bg-indigo-100 text-indigo-700 border border-indigo-300
            @elseif($transaction->status == 'selesai') bg-green-100 text-green-700 border border-green-300
            @else bg-gray-100 text-gray-700 border border-gray-300 @endif">
            @if ($transaction->status == 'pengiriman' && $transaction->tipe_pengiriman == 'cod')
            Pengiriman COD
        @elseif($transaction->status == 'pengiriman' && $transaction->tipe_pengiriman == 'ambil-kampus')
            Menunggu Pengambilan
        @else
        {{ ucfirst($transaction->status) }}
        @endif
            </p>

        </div>
        <a href="{{ route('transaction.pdf', $transaction->id) }}" target="_blank"
            class="p-2 text-sm text-white rounded-lg bg-cyan-600 hover:bg-cyan-700"> Download PDF</a>

        <div class="flex gap-4 mt-4 mb-4">
            @if (isset($transaction->ijazah))
                <div>
                    <label class="block mb-2 text-sm font-semibold text-gray-700">File Ijazah</label>
                    <a href="{{ $transaction->ijazah ? asset('storage/' . $transaction->ijazah->file) : asset('image/default.png') }}"
                        target="_blank" id="ijazahLink">
                        <img src="{{ isset($transaction->ijazah) ? asset('storage/' . $transaction->ijazah->file) : asset('image/default.png') }}"
                            alt="Ijazah Preview" class="object-cover rounded-lg min-w-48 h-28" id="ijazahPreview">
                    </a>
                </div>
            @endif
            @if (isset($transaction->transkrip_1))
                <div>
                    <label class="block mb-2 text-sm font-semibold text-gray-700">File Transkrip Nilai 1</label>
                    <a href="{{ isset($transaction->transkrip_1) ? asset('storage/' . $transaction->transkrip_1->file) : asset('image/default.png') }}"
                        target="_blank" id="transkrip1Link">
                        <img src="{{ isset($transaction->transkrip_1) ? asset('storage/' . $transaction->transkrip_1->file) : asset('image/default.png') }}"
                            alt="Transkrip 1 Preview" class="object-cover rounded-lg min-w-48 h-28" id="transkrip1Preview">
                    </a>
                </div>
            @endif
            @if (isset($transaction->transkrip_2))
                <div>
                    <label class="block mb-2 text-sm font-semibold text-gray-700">File Transkrip Nilai 2</label>
                    <a href="{{ isset($transaction->transkrip_2) ? asset('storage/' . $transaction->transkrip_2->file) : asset('image/default.png') }}"
                        target="_blank" id="transkrip2Link">
                        <img src="{{ isset($transaction->transkrip_2) ? asset('storage/' . $transaction->transkrip_2->file) : asset('image/default.png') }}"
                            alt="Transkrip 2 Preview" class="object-cover rounded-lg min-w-48 h-28" id="transkrip2Preview">
                    </a>
                </div>
            @endif
            @if (isset($transaction->akta))
                <div>
                    <label class="block mb-2 text-sm font-semibold text-gray-700">File Akta Mengajar</label>
                    <a href="{{ isset($transaction->akta) ? asset('storage/' . $transaction->akta->file) : asset('image/default.png') }}"
                        target="_blank" id="transkrip2Link">
                        <img src="{{ isset($transaction->akta) ? asset('storage/' . $transaction->akta->file) : asset('image/default.png') }}"
                            alt="Transkrip 2 Preview" class="object-cover rounded-lg min-w-48 h-28" id="transkrip2Preview">
                    </a>
                </div>
            @endif
        </div>

        <div class="grid grid-cols-1 gap-10 lg:grid-cols-2">
            <!-- Informasi Penerima -->
            <div class="">
                <h2 class="mb-2 font-bold text-gray-700">Informasi Pengajuan</h2>
                <div class="flex gap-3">
                    <div class="flex flex-col {{ $transaction->tipe_pengiriman=='cod' ? 'w-full' : 'w-1/2' }}">
                        <p class="text-gray-500">Nama Penerima</p>
                        <p class="text-gray-500">Nomor Telepon</p>
                        <p class="text-gray-500">Tipe Pengambilan</p>
                        @if ($transaction->tipe_pengiriman == 'cod')
                            <p class="text-gray-500">No Pengiriman</p>
                            {{-- <p class="text-gray-500">Kurir</p> --}}
                            <p class="text-gray-500">Alamat</p>
                        @endif
                    </div>

                    <div class="flex flex-col ">
                        <p class="">{{ $transaction->nama_penerima }} </p>
                        <p>{{ $transaction->no_hp }} </p>
                        <p>{{ $transaction->tipe_pengiriman == 'cod' ? 'Pengiriman COD' : 'Ambil di kampus' }} </p>


                        @if ($transaction->tipe_pengiriman == 'cod')
                            <p class="">{{ $transaction->nomor_pengiriman ?? 'Belum Tersedia' }}</p>
                            {{-- <p class="">{{ $transaction->kurir ?? 'Belum Tersedia' }}</p> --}}
                            <p class="text-gray-600">
                                {{ $transaction->alamat_pengiriman }}, {{ $transaction->city->name }}
                                , {{ $transaction->province->name }} ({{ $transaction->kode_pos }}) </p>
                        @elseif ($transaction->tipe_pengiriman == 'ambil-kampus')
                        @endif

                    </div>
                </div>
            </div>
            <!-- Rincian Pembayaran -->
            <div class="">
                <h2 class="mb-2 font-bold text-gray-700">Rincian Pembayaran</h2>
                <div class="flex ga-3">
                    <div class="flex flex-col w-1/3">
                        <p class="text-gray-500">Biaya Legalisir</p>
                        <p class="font-semibold text-cyan-600">Total Pembayaran</p>
                    </div>

                    <div class="flex flex-col">
                        <p>


                            Rp{{ number_format($biaya_legalisir, 0, ',', '.') }}<span class="text-xs"> (Dokumen
                                Legalisir)</span>
                            @if ($is_akta)
                                + Rp{{ number_format($biaya_akta, 0, ',', '.') }}<span class="text-xs"> (Akta
                                    Mengajar)</span>)
                            @endif
                            x {{ $transaction->jumlah_legalisir }}
                        </p>

                        <p class="font-semibold text-cyan-600">
                            Rp{{ number_format($transaction->jumlah_pembayaran, 0, ',', '.') }}
                        </p>
                    </div>
                </div>
                <div class="my-2">
                    @if ($transaction->bukti_pembayaran)
                        <div>
                            <p class="font-semibold">Bukti pembayaran telah dikirim</p>
                            <a href="{{ asset('storage/' . $transaction->bukti_pembayaran) }}"
                                class="text-sm text-cyan-600 hover:underline" target="_blank">Lihat Bukti Pembayaran</a>
                        </div>
                    @endif

                </div>
                <div class="w-full p-3 mt-4 border bg-gray-50 rounded-xl">
                    {{-- Form untuk mengisi nomor pengiriman --}}
                    @if ($transaction->status == 'proses legalisir')
                        @if ($transaction->tipe_pengiriman == 'cod')
                            <form action="{{ route('admin.transaksi.approve', $transaction->id) }}" method="POST">
                                @csrf
                                <div class="grid items-center grid-cols-2 gap-3">
                                    <div class="mb-4">
                                        <label for="nomor_pengiriman" class="block text-sm font-medium text-gray-700">Nomor
                                            Pengiriman</label>
                                        <input type="text" name="nomor_pengiriman" id="nomor_pengiriman"
                                            placeholder="Masukkan nomor pengiriman" required
                                            class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-lg focus:outline-none focus:ring-cyan-500 focus:border-cyan-500 sm:text-sm">
                                    </div>
                                    <button type="submit"
                                        class="px-4 py-2 mt-1 text-sm text-white rounded-lg bg-cyan-600 hover:bg-cyan-700 w-fit h-fit">
                                        Kirim Dokumen Legalisir
                                    </button>
                                </div>
                            </form>
                        @elseif ($transaction->tipe_pengiriman == 'ambil-kampus')
                            <form action="{{ route('admin.transaksi.approveAmbilKampus', $transaction->id) }}"
                                method="POST">
                                @csrf

                                <div class="">
                                    <p class="font-semibold">Verifikasi Prosees Legalisir</p>
                                    <button type="submit"
                                        class="px-4 py-2 mt-1 text-sm text-white rounded-lg bg-cyan-600 hover:bg-cyan-700 w-fit h-fit">
                                        Legalisir Sudah Selesai
                                    </button>
                                </div>
                            </form>
                        @endif
                    @elseif ($transaction->status == 'menunggu acc')
                        <form action="{{ route('admin.transaksi.acc', $transaction->id) }}" method="POST">
                            @csrf
                            <button type="submit"
                                class="px-4 py-2 mt-1 text-sm text-white rounded-lg bg-cyan-600 hover:bg-cyan-700 w-fit h-fit">
                                Terima Dokumen
                            </button>
                        </form>
                    @elseif ($transaction->status == 'menunggu pembayaran')
                        <div>Menunggu Pembayaran</div>
                    @elseif($transaction->status == 'pengiriman')
                        @if ($transaction->tipe_pengiriman == 'cod')
                            <div>
                                <p class="font-semibold">Nomor pengiriman telah ditetapkan</p>
                                <p class="text-sm text-cyan-600">Nomor: {{ $transaction->nomor_pengiriman }}</p>
                            </div>
                        @elseif ($transaction->tipe_pengiriman == 'ambil-kampus')
                            <div>
                                <p class="font-semibold">Proses Legalisir Sudah Selesai</p>
                                <div />
                        @endif
                    @else
                        <div class="w-full">
                            <p class="my-2 text-sm text-gray-500">Dokumen telah diterima</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
