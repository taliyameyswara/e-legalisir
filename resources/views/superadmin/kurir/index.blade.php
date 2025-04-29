@extends('layouts.superadmin')
@section('content')
    <div class="">
        <div class="p-5 bg-white rounded-2xl border border-gray-200">
            <div class="flex justify-between items-center mb-4">
                <div>
                    <h1 class="text-xl font-semibold text-cyan-700">Riwayat Pengiriman Legalisir Ijazah</h1>
                    <p class="text-sm text-gray-500">
                        Berikut adalah progress pengiriman legalisir ijazah yang telah diajukan
                    </p>
                </div>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full text-sm text-left text-gray-600">
                    <thead class="text-xs font-semibold text-gray-700 uppercase bg-gray-100">
                        <tr>
                            <th class="px-4 py-3">No</th>
                            <th class="px-4 py-3">ID Transaksi</th>
                            <th class="px-4 py-3">Jenis Pengiriman</th>
                            <th class="px-4 py-3">Nomor Pengiriman</th>
                            <th class="px-4 py-3">Biaya Pengiriman</th>
                            <th class="px-4 py-3">Biaya Packing</th>
                            <th class="px-4 py-3">Status</th>
                            <th class="px-4 py-3 text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        {{-- jika ada data transaksi --}}
                        @foreach ($transactions as $index => $transaction)
                            <tr class="border-b hover:bg-gray-50">
                                <td class="px-4 py-3">{{ $index + 1 }}</td>
                                <td class="px-4 py-3">{{ $transaction->id }} </td>
                                <td class="px-4 py-3">{{ $transaction->pengiriman }}</td>
                                <td class="px-4 py-3">{{ $transaction->nomor_pengiriman }}</td>
                                <td class="px-4 py-3">Rp{{ number_format($transaction->biaya_ongkir, 0, ',', '.') }}</td>
                                <td class="px-4 py-3">Rp{{ number_format($transaction->harga_packing, 0, ',', '.') }}</td>
                                <td>
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
                                </td>
                                <td class="px-4 py-3 text-center">
                                    <a href="{{ route('superadmin.transaksi.detail', $transaction->id) }}"
                                        class="text-cyan-600 transition-all duration-200 hover:underline hover:text-cyan-700">
                                        Lihat Detail Transaksi
                                    </a> | <a target="_blank" class="text-cyan-600 transition-all duration-200 hover:underline hover:text-cyan-700" href="https://ncskurir.com/ncskurir/track">Cek Resi</a>
                                </td>
                            </tr>
                        @endforeach
                        {{-- jika tidak ada data transaksi --}}
                        @if ($transactions->isEmpty())
                            <tr>
                                <td colspan="4" class="py-4 text-center">
                                    <p class="text-gray-500">Belum ada data riwayat transaksi legalisir</p>
                                </td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
