
@extends('layouts.dashboard')

@section('content')
    <div class="p-5 bg-white rounded-2xl border border-gray-200">
        <a href="{{ route('mahasiswa.transaksi.index') }}" class="text-cyan-600 hover:underline">
            ← Kembali </a>
        <div class="flex justify-between items-center my-3">
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
            @if ($transaction->status == 'pengiriman')
            Pengiriman COD
            @else
            {{ ucfirst($transaction->status) }}
            @endif
            </p>
        </div>


        <div class="flex gap-4 mb-4">
            <div>
                <label class="block mb-2 text-sm font-semibold text-gray-700">File Ijazah ({{ $transaction->jumlah_ijazah }})</label>
                <div class="flex gap-3 items-center">
                    <img src="{{ asset('image/pdf.png') }}" alt="" class="object-cover w-12 h-12 rounded-lg" id="ijazahPreview">
                    <div class="flex flex-col">
                        <p class="text-sm text-gray-500 truncate" id="ijazahFileName">
                            {{ $transaction->ijazah->file_name }}
                        </p>
                        <a href="{{ asset( $transaction->ijazah->file) }}" target="_blank" class="text-sm text-cyan-600 hover:underline">Lihat File</a>

                    </div>
                </div>
            </div>
            @if (isset($transaction->transkrip))
            <div>
                <label class="block mb-2 text-sm font-semibold text-gray-700">File Transkrip ({{ $transaction->jumlah_transkrip }})</label>
                <div class="flex gap-3 items-center">
                    <img src="{{ asset('image/pdf.png') }}" alt="" class="object-cover w-12 h-12 rounded-lg" id="transkripPreview">
                    <div class="flex flex-col">
                        <p class="text-sm text-gray-500 truncate" id="transkripFileName">
                            {{ $transaction->transkrip->file_name }}
                        </p>
                        <a href="{{ asset( $transaction->transkrip->file) }}" target="_blank" class="text-sm text-cyan-600 hover:underline">Lihat File</a>

                    </div>
                </div>
            </div>
            @endif
            @if (isset($transaction->akta))
            <div>
                <label class="block mb-2 text-sm font-semibold text-gray-700">File Akta ({{ $transaction->jumlah_akta }})</label>
                <div class="flex gap-3 items-center">
                    <img src="{{ asset('image/pdf.png') }}" alt="" class="object-cover w-12 h-12 rounded-lg" id="aktaPreview">
                    <div class="flex flex-col">
                        <p class="text-sm text-gray-500 truncate" id="aktaFileName">
                            {{ $transaction->akta->file_name }}
                        </p>
                        <a href="{{ asset( $transaction->akta->file) }}" target="_blank" class="text-sm text-cyan-600 hover:underline">Lihat File</a>

                    </div>
                </div>
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
                        <p class="text-gray-500">Alamat</p>
                    </div>

                    <div class="flex flex-col">
                        <p class="">{{ $transaction->nama_penerima }} </p>
                        <p>{{ $transaction->no_hp }} </p>
                        <p class="text-gray-600">
                                {{ $transaction->alamat_pengiriman }} {{ $transaction->city->name }}
                                ,{{ $transaction->province->name }} ({{ $transaction->kode_pos }}) </p>
                    </div>
                </div>

                @if ($transaction->status == "pengiriman" || $transaction->status == "selesai")

                <h2 class="mt-2 font-bold text-gray-700">Informasi Pengiriman</h2>
                <small class="">
                    (Biaya packing dan pengiriman dibayarkan secara cod setelah barang diterima oleh alumni)
                </small>
                <div class="flex mt-2 ga-3">
                    <div class="flex flex-col w-1/3">
                        <p class="text-gray-500">Jenis Pengiriman</p>
                        <p class="text-gray-500">Nomor Pengiriman</p>
                        <p class="text-gray-500">Biaya Packing</p>
                        <p class="text-gray-500">Biaya Pengiriman</p>
                    </div>

                    <div class="flex flex-col">
                        <p class="">{{ $transaction->pengiriman }} </p>
                        <p>
                            {{ $transaction->nomor_pengiriman ?? 'Belum Tersedia' }} -
                            <a href="https://ncskurir.com/ncskurir/track#tracking" target="_blank" rel="noopener noreferrer" class="text-blue-500 underline">Tracking Pengiriman</a>
                        </p>
                        <p>Rp{{number_format($transaction->harga_packing ?? 0, 0, ',', '.') }}</p>
                        <p>Rp{{number_format($transaction->biaya_ongkir ?? 0, 0, ',', '.') }}</p>
                    </div>
                </div>
                @endif  
            </div>

            <!-- Rincian Pembayaran -->
            <div class="">
                <h2 class="font-bold text-gray-700">Rincian Pembayaran</h2>
                <small>(Biaya dibawah ini belum termasuk biaya pengiriman dan biaya packing yang akan dibayarkan secara cod)</small>


                <div class="flex gap-3 mb-2">
                    <div class="flex flex-col w-1/2">
                        {{-- <p class="text-gray-500">Biaya Legalisir</p> --}}
                        {{-- <p class="text-gray-500">Biaya Pengiriman</p> --}}
                        <p class="font-semibold text-cyan-600">Total Pembayaran</p>
                    </div>

                    <div class="flex flex-col">
                        {{-- <p>Rp{{ number_format($transaction->biaya_legalisir, 0, ',', '.') }}</p> --}}
                        {{-- <p>Rp{{ number_format($transaction->biaya_ongkir, 0, ',', '.') }}</p> --}}

                        <p class="font-semibold text-cyan-600">
                            Rp{{ number_format($transaction->total_pembayaran, 0, ',', '.') }}
                        </p>
                    </div>
                </div>


                    @if ($transaction->status == 'menunggu pembayaran')
                        <div>
                            Pembayaran dapat dilakukan melalui
                            <br>
                            Virtual Account : <strong class="text-cyan-600">16237147331</strong> (Bank Mandiri -
                            Universitas)

                            <p class="my-2 text-sm text-gray-500">Silahkan melakukan pembayaran sebesar
                                <strong>Rp{{ number_format($transaction->total_pembayaran, 0, ',', '.') }}</strong>
                                ke nomor virtual account di atas. Setelah melakukan pembayaran, silahkan upload bukti
                                pembayaran.
                            </p>

                            <form action="{{ route('mahasiswa.transaksi.bukti_pembayaran', $transaction->id) }}"
                                method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="flex gap-2 justify-between items-center p-2 px-4 bg-white rounded-xl border">
                                    <input type="file" name="bukti_pembayaran" class="mt-2 mb-3 w-full">
                                    <button type="submit"
                                        class="px-4 py-2 w-2/3 text-sm text-white bg-cyan-600 rounded-lg">Kirim
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
                                        class="px-4 py-2 mt-2 w-full text-sm text-white bg-cyan-600 rounded-lg">Dokumen
                                        Legalisir diterima</button>
                                </form>
                            </div>

                    @elseif ($transaction->status == 'menunggu acc')
                        <div class="">
                            <p class="my-2 text-sm text-gray-500">Pengajuan dokumen telah dikirim. Silahkan
                                menunggu konfirmasi
                                dari admin
                            </p>
                        </div>
                        @elseif($transaction->status == 'ditolak')
                        <div>
                            <p class="font-semibold">Dokumen ditolak</p>
                            <p class="text-sm text-red-600">Alasan: {{ $transaction->alasan_tolak }}</p>
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
