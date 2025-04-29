@extends('layouts.superadmin')

@section('title', 'Dashboard Admin - E-Legalisir')

@section('content')
    <div class="p-4">
        <!-- Header -->
        <div>
            <h1 class="text-2xl font-bold text-cyan-700">Sistem Pelayanan Legalisir Ijazah</h1>
            <p class="mt-1 text-gray-600">
                Selamat datang, <span class="font-semibold">{{ Auth::user()->name }}</span> di Sistem Pelayanan Legalisir Ijazah.
            </p>
        </div>

        <!-- Top Data Summary -->
        <div class="containermx-auto">
            <div class="grid grid-cols-1 gap-6 mt-6 md:grid-cols-3">
                <div class="transition duration-300 bg-white border-l-[5px] shadow-sm border-cyan-500 rounded-2xl hover:shadow-lg hover:bg-cyan-50 hover:border-cyan-400">
                        <div class="flex items-center gap-4 p-5 ">
                            <div>
                                <h2 class="text-lg font-semibold text-gray-700">Jumlah Alumni</h2>
                                <p class="text-sm text-gray-500">Jumlah alumni yang terdaftar.</p>
                                <div class="mt-2 text-xl font-bold text-cyan-700">{{ $studentsCount }}</div>
                            </div>
                        </div>
                </div>
                <div class="transition duration-300 bg-white border-l-[5px] shadow-sm border-cyan-500 rounded-2xl hover:shadow-lg hover:bg-cyan-50 hover:border-cyan-400">
                    <div class="flex items-center gap-4 p-5 ">
                        <div>
                            <h2 class="text-lg font-semibold text-gray-700">Jumlah Pengajuan</h2>
                            <p class="text-sm text-gray-500">Jumlah pengajuan legalisir yang tercatat.</p>
                            <div class="mt-2 text-xl font-bold text-cyan-700">{{ $transactionCount }}</div>
                        </div>
                    </div>
                </div>
                <div class="p-5 transition duration-300 bg-white border-l-[5px] border-cyan-500  shadow-sm rounded-2xl hover:shadow-lg hover:bg-cyan-50 hover:border-cyan-400">
                    <div class="flex items-center gap-4">
                        <div>
                            <h2 class="text-lg font-semibold text-gray-700">Data Pengajuan Legalisir</h2>
                            <p class="text-sm text-gray-500">Lihat data pengajuan legalisir ijazah.</p>
                        </div>
                    </div>
                    <a href="{{ route('superadmin.transaksi.index') }}" class="inline-block mt-2 text-sm font-medium text-cyan-600 hover:underline">
                        Lihat Selengkapnya
                    </a>
                </div>

            </div>
        </div>


        <!-- Middle Chart Section -->
        <div class="grid grid-cols-1 gap-4 mt-6 lg:grid-cols-3">
            <!-- Chart Placeholder -->
            <div class="col-span-2 p-6 bg-white border border-gray-200 shadow-sm rounded-xl">
                <h2 class="mb-4 text-lg font-semibold text-gray-700">Statistik Pengajuan</h2>
                <div class="relative w-full aspect-[16/9]">
                    <canvas id="transactionChart" class="w-full h-full"></canvas>
                </div>
            </div>

            <!-- Data List -->
            <div class="p-4 bg-white border border-gray-200 shadow-sm rounded-xl">
               <!-- Data List -->
                <div class="p-4 bg-white border border-gray-200 shadow-sm rounded-xl">
                    <h2 class="mb-4 text-lg font-semibold text-gray-700">Aktivitas Terbaru</h2>
                    <div class="overflow-x-auto">
                        <table id="logTable" class="min-w-full text-sm text-left text-gray-600">
                            <thead class="text-xs text-gray-700 uppercase bg-gray-100">
                                <tr>
                                    <th class="px-4 py-2">Nama Pengguna</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($logs as $index => $log)
                                    <tr class="border-b hover:bg-gray-50">
                                        <td class="">
                                            @php
                                                $createdAt = Carbon\Carbon::parse($log->created_at)->locale('id')->translatedFormat('d F Y, H:i') . ' WIB';
                                            @endphp

                                            <div class="p-2 bg-white border rounded-lg shadow-sm">
                                                <p class="text-xs font-semibold text-gray-800">{{ $createdAt }} - {{ $log->user->name ?? '-' }}</p>

                                                <div class="mt-1 text-xs text-gray-600">
                                                    <p>
                                                        @if ($log->user->email)
                                                        <span class="font-bold">Email :</span>
                                                        {{ $log->user->email }}
                                                        @elseif ($log->user->nim)
                                                        <span class="font-bold">NIM :</span>
                                                        {{ $log->user->nim }}
                                                        @endif
                                                    </p>
                                                    <p class="mt-1">
                                                        <span class="font-medium">{{ $log->action }}</span> - {{ $log->description }}
                                                    </p>
                                                </div>
                                            </div>

                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>


            </div>
        </div>
    </div>


    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css" />
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script defer src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready(function () {
            $('#logTable').DataTable({
                "searching" : false,
                "pageLength": 3,
                "info" : false,
                "lengthChange": false,
                "language": {
                    "paginate": {
                        "previous": "←",
                        "next": "→"
                    },
                },
                "order": [[0, 'desc']],
            });
        });
    </script>

    <style>
        .dataTables_paginate .paginate_button:not(.previous):not(.next) {
            display: none !important;
        }
    </style>


    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>



    <script>
        const rawLabels = @json($dates);
        const rawData = @json($transactionsPerDay);
        const statuses = @json($statuses);

        // const labels = Object.values(rawLabels).map(date => {
        //     const dateObj = new Date(date);
        //     return dateObj.toISOString().split('T')[0]; // Format YYYY-MM-DD
        // });

        const labels = Object.values(rawLabels)
    .map(date => {
        const dateObj = new Date(date);
        return dateObj.toISOString().split('T')[0];
    })
    .reverse(); // tambahkan ini untuk membalik urutan tanggal


        console.log(labels);
        console.log(rawData);

        // Ambil data per status
        const datasets = statuses.map(status => {
            return {
                label: status,
                data: labels.map(date => rawData[date][status]),
                borderColor: getColor(status),
                backgroundColor: getColor(status, 0.2),
                fill: true,
                tension: 0.3
            };
        });

        function getColor(status, opacity = 1) {
            const colors = {
                'menunggu pembayaran': `rgba(234, 179, 8, ${opacity})`,
                'menunggu acc': `rgba(34, 197, 94, ${opacity})`,
                'proses legalisir': `rgba(59, 130, 246, ${opacity})`,
                'pengiriman': `rgba(251, 191, 36, ${opacity})`,
                'selesai': `rgba(16, 185, 129, ${opacity})`,
                'ditolak': `rgba(239, 68, 68, ${opacity})`,
            };
            return colors[status] || `rgba(107, 114, 128, ${opacity})`; // default abu-abu
        }

        const ctx = document.getElementById('transactionChart').getContext('2d');
        new Chart(ctx, {
            type: 'line',
            data: {
                labels: labels.map(label => new Date(label).toLocaleDateString('id-ID', {
                    weekday: 'short',
                    day: 'numeric'
                })),
                datasets: datasets
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'top'
                    },
                    tooltip: {
                        mode: 'index',
                        intersect: false,
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            stepSize: 1
                        }
                    }
                }
            }
        });
    </script>


@endsection
