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
            <div>
                <label class="block mb-2 text-sm font-semibold text-gray-700">File Transkrip Nilai 1</label>
                <a href="{{ isset($transaction->file_transkrip_1) ? asset('storage/' . $transaction->file_transkrip_1->file) : asset('image/default.png') }}"
                    target="_blank" id="transkrip1Link">
                    <img src="{{ isset($transaction->file_transkrip_1) ? asset('storage/' . $transaction->file_transkrip_1->file) : asset('image/default.png') }}"
                        alt="Transkrip 1 Preview" class="object-cover rounded-lg min-w-48 h-28" id="transkrip1Preview">
                </a>
            </div>
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
        </div>


        <div class="grid grid-cols-1 gap-10 lg:grid-cols-2">
            <!-- Informasi Penerima -->
            <div class="">
                <h2 class="mb-2 font-bold text-gray-700">Informasi Pengiriman</h2>
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
                            <p class="">{{ $transaction->province->name }}, {{ $transaction->city->name }} </p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Rincian Pembayaran -->
            <div class="">
                <h2 class="mb-2 font-bold text-gray-700">Rincian Pembayaran</h2>
                <div class="flex ga-3">
                    <div class="flex flex-col w-1/3">
                        <p class="text-gray-500">Biaya Legalisir</p>
                        <p class="text-gray-500">Biaya Ongkir</p>
                        <p class="font-semibold text-cyan-600">Total Pembayaran</p>
                    </div>

                    <div class="flex flex-col">
                        <p>
                            Rp{{ number_format(15000, 0, ',', '.') }}
                        </p>

                        <p>
                            Rp{{ number_format($transaction->biaya_ongkir , 0, ',', '.') }}
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
                    @else
                        <div>
                            <p class="font-semibold">Bukti pembayaran telah dikirim</p>
                            <a href="{{ asset('storage/' . $transaction->bukti_pembayaran) }}"
                                class="text-sm text-cyan-600 hover:underline" target="_blank">Lihat Bukti Pembayaran</a>
                        </div>
                        @if ($transaction->status == 'pengiriman')
                            <div class="">
                                <p class="my-2 text-sm text-gray-500">Dokumen telah dikirim. Apabila dokumen telah diterima
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
                        @endif
                    @endif
                </div>

            </div>

        </div>



    </div>
@endsection
