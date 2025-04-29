


@extends('layouts.admin')

@section('content')
    <div class="p-5 bg-white rounded-2xl border border-gray-200">
        <a href="{{ route('admin.transaksi.index') }}" class="text-cyan-600 hover:underline">
            ← Kembali </a>
        <div class="flex justify-between items-center my-3">
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
            @if ($transaction->status == 'pengiriman')
            Pengiriman COD
        @else
        {{ ucfirst($transaction->status) }}
        @endif
            </p>

        </div>
        <a href="{{ route('transaction.pdf', $transaction->id) }}" target="_blank"
            class="p-2 text-sm text-white bg-cyan-600 rounded-lg hover:bg-cyan-700"> Download PDF</a>

        <div class="flex gap-4 mt-4 mb-4">
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


                <div class="flex gap-3">
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

                <div class="my-2">
                    @if ($transaction->bukti_pembayaran)
                        <div>
                            <p class="font-semibold">Bukti pembayaran</p>
                            <a href="{{ asset('storage/' . $transaction->bukti_pembayaran) }}"
                                class="text-sm text-cyan-600 hover:underline" target="_blank">Lihat Bukti Pembayaran</a>
                        </div>
                    @endif
                </div>
                <div class="p-3 mt-4 w-full bg-gray-50 rounded-xl border">
                    {{-- Form untuk mengisi nomor pengiriman --}}
                    @if ($transaction->status == 'proses legalisir')
                            <h1>
                                Lengkapi data pengiriman
                            </h1>
                            <small class="mb-2">(Untuk pengecekan harga dapat mengujungi website <a href="https://ncskurir.com/ncskurir/track">NCS Kurir</a>)</small>
                            <form action="{{ route('admin.transaksi.approve', $transaction->id) }}" method="POST">
                                @csrf
                                <div class="grid grid-cols-2 gap-3 items-center">
                                    <div class="mb-4">
                                        <label for="nomor_pengiriman" class="block text-sm font-medium text-gray-700">Nomor
                                            Pengiriman</label>
                                        <input type="text" name="nomor_pengiriman" id="nomor_pengiriman"
                                            placeholder="Masukkan nomor pengiriman" required
                                            class="block px-3 py-2 mt-1 w-full rounded-lg border border-gray-300 focus:outline-none focus:ring-cyan-500 focus:border-cyan-500 sm:text-sm">
                                    </div>
                                    <div class="mb-4">
                                        <label for="biaya_ongkir" class="block text-sm font-medium text-gray-700">Biaya Pengiriman</label>
                                        <input type="number" name="biaya_ongkir" id="biaya_ongkir"
                                            placeholder="Masukkan biaya pengiriman" required
                                            class="block px-3 py-2 mt-1 w-full rounded-lg border border-gray-300 focus:outline-none focus:ring-cyan-500 focus:border-cyan-500 sm:text-sm">
                                    </div>
                                    <button type="submit"
                                        class="px-4 py-2 mt-1 text-sm text-white bg-cyan-600 rounded-lg hover:bg-cyan-700 w-fit h-fit">
                                        Kirim Dokumen Legalisir
                                    </button>
                                </div>
                            </form>
                    @elseif ($transaction->status == 'menunggu acc')
                    <div class="flex gap-x-2 items-center">
                        <form action="{{ route('admin.transaksi.acc', $transaction->id) }}" method="POST">
                            @csrf
                            <button type="submit"
                                class="px-4 py-2 mt-1 text-sm text-white bg-cyan-600 rounded-lg hover:bg-cyan-700 w-fit h-fit">
                                Terima Dokumen
                            </button>
                        </form>

                        <button
                        class="px-4 py-2 mt-1 text-sm text-white bg-red-600 rounded-lg hover:bg-red-700 w-fit h-fit"
                        onclick="document.getElementById('modalTolak').classList.remove('hidden')"
                        >
                        Tolak Dokumen
                        </button>

                    </div>


                        <!-- Modal -->
                        <div
                        id="modalTolak"
                        class="flex hidden fixed inset-0 z-50 justify-center items-center bg-black bg-opacity-50"
                        >
                        <div class="p-6 w-full max-w-md bg-white rounded-xl shadow-lg">
                            <h2 class="mb-4 text-lg font-semibold">Alasan Tolak Dokumen</h2>
                            <form action="{{ route('admin.transaksi.tolak', $transaction->id) }}" method="POST">
                                @csrf
                                <!-- Jika pakai Laravel, bisa tambahkan @csrf -->
                                <textarea
                                    name="alasan_tolak"
                                    rows="4"
                                    class="p-2 mb-4 w-full rounded-lg border border-gray-300 focus:outline-none focus:ring focus:border-blue-500"
                                    placeholder="Tulis alasan penolakan..."
                                    required
                                ></textarea>

                                <div class="flex gap-2 justify-end">
                                    <button
                                        type="button"
                                        class="px-4 py-2 mt-1 text-sm text-black bg-gray-400 rounded-lg hover:bg-gray-500 w-fit h-fit"
                                        onclick="document.getElementById('modalTolak').classList.add('hidden')"
                                    >
                                        Batal
                                    </button>
                                    <button
                                        type="submit"
                                        class="px-4 py-2 mt-1 text-sm text-white bg-red-600 rounded-lg hover:bg-red-700 w-fit h-fit"
                                    >
                                        Submit
                                    </button>
                                </div>
                            </form>
                        </div>
                        </div>


                    @elseif ($transaction->status == 'menunggu pembayaran')
                        <div>Menunggu Pembayaran</div>
                    @elseif($transaction->status == 'pengiriman')

                            <div>
                                <p class="font-semibold">Nomor pengiriman telah ditetapkan</p>
                                <p class="text-sm text-cyan-600">Nomor: {{ $transaction->nomor_pengiriman }}</p>
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
