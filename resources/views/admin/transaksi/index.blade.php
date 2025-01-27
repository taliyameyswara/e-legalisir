@extends('layouts.admin')

@section('content')
    <div class="">
        <div class="border border-gray-200 rounded-2xl p-5 bg-white">
            <div class="flex justify-between items-center mb-4">
                <div>
                    <h1 class="text-xl font-semibold text-cyan-700">Riwayat Transaksi Legalisir Ijazah</h1>
                    <p class="text-gray-500 text-sm">
                        Berikut adalah progress transaksi legalisir ijazah yang telah diajukan
                    </p>
                </div>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full text-sm text-left text-gray-600">
                    <thead class="bg-gray-100 text-gray-700 uppercase text-xs font-semibold">
                        <tr>
                            <th class="px-4 py-3">No</th>
                            <th class="px-4 py-3">Tanggal</th>
                            <th class="px-4 py-3">Nama Mahasiswa</th>
                            <th class="px-4 py-3">Status</th>
                            <th class="px-4 py-3 text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        {{-- jika ada data transaksi --}}
                        @foreach ($transactions as $index => $transaction)
                            <tr class="border-b hover:bg-gray-50">
                                <td class="px-4 py-3">{{ $index + 1 }}</td>
                                <td class="px-4 py-3">{{ $transaction->created_at->format('d-m-y') }}</td>
                                <td class="px-4 py-3">{{ $transaction->user->name }}</td>
                                <td class="px-4 py-3">
                                    <p
                                        class="inline-block px-4 py-2 rounded-full text-xs
                                           @if ($transaction->status == 'menunggu pembayaran') bg-yellow-100 text-yellow-700 border border-yellow-300
                                            @elseif($transaction->status == 'proses legalisir') bg-cyan-500/10 border border-cyan-500/50 text-cyan-600
                                            @elseif($transaction->status == 'pengiriman') bg-indigo-100 text-indigo-700 border border-indigo-300
                                            @elseif($transaction->status == 'selesai') bg-green-100 text-green-700 border border-green-300
                                            @else bg-gray-100 text-gray-700 border border-gray-300 @endif">
                                        {{ ucfirst($transaction->status) }}
                                    </p>
                                </td>
                                <td class="px-4 py-3 text-center">
                                    <a href="{{ route('admin.transaksi.detail', $transaction->id) }}"
                                        class="text-cyan-600 hover:underline hover:text-cyan-700 transition-all duration-200">
                                        Lihat Detail Transaksi
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                        {{-- jika tidak ada data transaksi --}}
                        @if ($transactions->isEmpty())
                            <tr>
                                <td colspan="4" class="text-center py-4">
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
