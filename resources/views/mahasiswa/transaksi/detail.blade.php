@php

    $file_ijazah = $transaction->file_ijazah;
    $is_akta = $transaction->akta_mengajar;
    $biaya_legalisir = 0;
    $biaya_akta = 0;

    $program_studi = Auth::user()->student->program_studi ?? '';
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

@extends('layouts.dashboard')

@section('content')
    <div class="p-5 bg-white border border-gray-200 rounded-2xl">
        <a href="{{ route('mahasiswa.transaksi.index') }}" class="text-cyan-600 hover:underline">
            ← Kembali </a>
        <div class="flex items-center justify-between my-3">
            <div>
                <h1 class="text-xl font-semibold text-cyan-700">Detail Transaksi Legalisir Ijazah</h1>
                <p class="text-sm text-gray-600">Berikut adalah detail transaksi yang telah diajukan.</p>
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
                <label class="block mb-2 text-sm font-semibold text-gray-700">File Ijazah</label>
                <a href="{{ isset($transaction->file_ijazah) ? asset('storage/' . $transaction->file_ijazah->file) : asset('image/default.png') }}"
                    target="_blank" id="ijazahLink">
                    <img src="{{ isset($transaction->file_ijazah) ? asset('storage/' . $transaction->file_ijazah->file) : asset('image/default.png') }}"
                        alt="Ijazah Preview" class="object-cover rounded-lg min-w-48 h-28" id="ijazahPreview">
                </a>
            </div>
            @if (isset($transaction->file_transkrip_1))
                <div>
                    <label class="block mb-2 text-sm font-semibold text-gray-700">File Transkrip Nilai 1</label>
                    <a href="{{ isset($transaction->file_transkrip_1) ? asset('storage/' . $transaction->file_transkrip_1->file) : asset('image/default.png') }}"
                        target="_blank" id="transkrip1Link">
                        <img src="{{ isset($transaction->file_transkrip_1) ? asset('storage/' . $transaction->file_transkrip_1->file) : asset('image/default.png') }}"
                            alt="Transkrip 1 Preview" class="object-cover rounded-lg min-w-48 h-28" id="transkrip1Preview">
                    </a>
                </div>
            @endif
            @if (isset($transaction->file_transkrip_2))
                <div>
                    <label class="block mb-2 text-sm font-semibold text-gray-700">File Transkrip Nilai 2</label>
                    <a href="{{ isset($transaction->file_transkrip_2) ? asset('storage/' . $transaction->file_transkrip_2->file) : asset('image/default.png') }}"
                        target="_blank" id="transkrip2Link">
                        <img src="{{ isset($transaction->file_transkrip_2) ? asset('storage/' . $transaction->file_transkrip_2->file) : asset('image/default.png') }}"
                            alt="Transkrip 2 Preview" class="object-cover rounded-lg min-w-48 h-28" id="transkrip2Preview">
                    </a>
                </div>
            @endif
            @if (isset($transaction->akta_mengajar))
                <div>
                    <label class="block mb-2 text-sm font-semibold text-gray-700">File Akta Mengajar</label>
                    <a href="{{ isset($transaction->akta_mengajar) ? asset('storage/' . $transaction->akta_mengajar->file) : asset('image/default.png') }}"
                        target="_blank" id="transkrip2Link">
                        <img src="{{ isset($transaction->akta_mengajar) ? asset('storage/' . $transaction->akta_mengajar->file) : asset('image/default.png') }}"
                            alt="Transkrip 2 Preview" class="object-cover rounded-lg min-w-48 h-28" id="transkrip2Preview">
                    </a>
                </div>
            @endif

        </div>


        <div class="grid grid-cols-1 gap-10 lg:grid-cols-2">
            <!-- Informasi Penerima -->
            <div class="">
                <h2 class="mb-2 font-bold text-gray-700">Informasi Pengajuan</h2>
                <div class="flex ga-3">
                    <div class="flex flex-col w-1/3">
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
                                {{ $transaction->alamat_pengiriman }}{{ $transaction->city->name }}
                                ,{{ $transaction->province->name }} ({{ $transaction->kode_pos }}) </p>
                        @elseif ($transaction->tipe_pengiriman == 'ambil-kampus')
                        @endif

                    </div>
                </div>
            </div>

            <!-- Rincian Pembayaran -->
            <div class="">
                <h2 class="font-bold text-gray-700 ">Rincian Pembayaran</h2>
                @if ($transaction->tipe_pengiriman == 'cod')
                    <small class="mb-2 text-xs">(Biaya di bawah ini belum termasuk biaya pengiriman yang akan dibayarkan cod
                        ketika kurir mengirimkan paket ke rumah masing-masing)</small>
                @elseif ($transaction->tipe_pengiriman == 'ambil-kampus')
                    <small class="mb-2 text-xs">(Dokumen dapat diambil ke kampus apabila sudah selesai dilakukan
                        legalisir.)</small>
                @endif

                <div class="flex ga-3">
                    <div class="flex flex-col w-1/3">
                        <p class="text-gray-500">Biaya Legalisir</p>
                        <p class="font-semibold text-cyan-600">Total Pembayaran</p>
                    </div>

                    <div class="flex flex-col">
                        <p>
                            {{-- Rp{{ number_format($transaction->jumlah_pembayaran / $transaction->jumlah_legalisir, 0, ',', '.') }}
                            * {{ $transaction->jumlah_legalisir }} Dokumen Legalisir --}}
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


                <div class="p-3 mt-4 border bg-gray-50 rounded-xl w-fit">
                    {{-- Check if the payment is still pending --}}
                    @if ($transaction->status == 'menunggu pembayaran')
                        <div>
                            Pembayaran dapat dilakukan melalui
                            <br>
                            Virtual Account : <strong class="text-cyan-600">16237147331</strong> (Bank Mandiri -
                            Universitas)

                            <p class="my-2 text-sm text-gray-500">Silahkan melakukan pembayaran sebesar
                                <strong>Rp{{ number_format($transaction->jumlah_pembayaran, 0, ',', '.') }}</strong>
                                ke nomor virtual account di atas. Setelah melakukan pembayaran, silahkan upload bukti
                                pembayaran.
                            </p>

                            <form action="{{ route('mahasiswa.transaksi.bukti_pembayaran', $transaction->id) }}"
                                method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="flex items-center justify-between gap-2 p-2 px-4 bg-white border rounded-xl">
                                    <input type="file" name="bukti_pembayaran" class="w-full mt-2 mb-3">
                                    <button type="submit"
                                        class="w-2/3 px-4 py-2 text-sm text-white rounded-lg bg-cyan-600">Kirim
                                        Bukti Pembayaran</button>
                                </div>
                            </form>
                        </div>
                    @elseif ($transaction->status == 'proses legalisir')
                        <div>
                            <p class="font-semibold">Dalam Proses Legalisir</p>
                            <a href="{{ asset('storage/' . $transaction->bukti_pembayaran) }}"
                                class="text-sm text-cyan-600 hover:underline" target="_blank">Lihat Bukti Pembayaran</a>
                        </div>
                    @elseif ($transaction->status == 'pengiriman')
                        @if ($transaction->tipe_pengiriman == 'cod')
                            <div class="">
                                <p class="my-2 text-sm text-gray-500">Dokumen legalisir telah dikirim. Silahkan untuk
                                    membayar ongkir ke kurir (COD) ketika dokumen telah diterima. Apabila dokumen telah
                                    diterima
                                    maka silahkan
                                    konfirmasi pengiriman
                                </p>

                                <form action="{{ route('mahasiswa.transaksi.konfirmasi_pengiriman', $transaction->id) }}"
                                    method="POST">
                                    @csrf
                                    <button type="submit"
                                        class="w-full px-4 py-2 mt-2 text-sm text-white rounded-lg bg-cyan-600">Dokumen
                                        Legalisir diterima</button>
                                </form>
                            </div>
                        @elseif ($transaction->tipe_pengiriman == 'ambil-kampus')
                            <div>
                                <p class="font-semibold">Proses Legalisir Sudah Selesai</p>
                                <div />

                                <div class="">
                                    <p class="my-2 text-sm text-gray-500">Silahkan ambil dokumen legalisir ke kampus.
                                        Dokumen dapat diambil di kampus setelah proses legalisir selesai.
                                    </p>

                                    <form
                                        action="{{ route('mahasiswa.transaksi.konfirmasi_pengiriman', $transaction->id) }}"
                                        method="POST">
                                        @csrf
                                        <button type="submit"
                                            class="w-full px-4 py-2 mt-2 text-sm text-white rounded-lg bg-cyan-600">Dokumen
                                            Legalisir diambil</button>
                                    </form>
                                </div>
                        @endif
                    @elseif ($transaction->status == 'menunggu acc')
                        <div class="">
                            <p class="my-2 text-sm text-gray-500">Pengajuan dokumen telah dikirim. Silahkan
                                menunggu konfirmasi
                                dari admin
                            </p>
                        </div>
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
