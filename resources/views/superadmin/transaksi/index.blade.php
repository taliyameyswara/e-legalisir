@extends('layouts.superadmin')
@section('content')
    <div class="">
        <div class="p-5 bg-white border border-gray-200 rounded-2xl">
            <div class="flex items-center justify-between mb-4">
                <div>
                    <h1 class="text-xl font-semibold text-cyan-700">Riwayat Transaksi Legalisir Ijazah</h1>
                    <p class="text-sm text-gray-500">
                        Berikut adalah progress transaksi legalisir ijazah yang telah diajukan
                    </p>
                </div>
                <a href="{{ route('superadmin.transaksi.export') }}" class="inline-flex items-center px-4 py-2 text-sm font-medium text-green-600 transition border border-green-600 rounded-lg hover:bg-green-50">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4 mr-2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 8.25H7.5a2.25 2.25 0 0 0-2.25 2.25v9a2.25 2.25 0 0 0 2.25 2.25h9a2.25 2.25 0 0 0 2.25-2.25v-9a2.25 2.25 0 0 0-2.25-2.25H15M9 12l3 3m0 0 3-3m-3 3V2.25" />
                    </svg>
                    Download Excel
                </a>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full text-sm text-left text-gray-600">
                    <thead class="text-xs font-semibold text-gray-700 uppercase bg-gray-100">
                        <tr>
                            <th class="px-4 py-3">No</th>
                            <th class="px-4 py-3">Tanggal</th>
                            <th class="px-4 py-3">Nama Alumni</th>
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
                                        @if ($transaction->status == 'pengiriman')
                                            Pengiriman COD
                                        @else
                                        {{ ucfirst($transaction->status) }}
                                        @endif

                                    </p>
                                </td>
                                <td class="px-4 py-3 text-center">
                                    <a href="{{ route('superadmin.transaksi.detail', $transaction->id) }}"
                                        class="transition-all duration-200 text-cyan-600 hover:underline hover:text-cyan-700">
                                        Lihat Detail Transaksi
                                    </a>
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
