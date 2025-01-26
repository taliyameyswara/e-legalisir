@extends('layouts.app')

@section('content')
    <div class="container mx-auto p-6">
        <h1 class="text-2xl font-bold text-gray-700">Halaman E-Legalisir</h1>

        <!-- Data Mahasiswa -->
        <div class="bg-white p-6 mt-4 shadow rounded-lg">
            <h2 class="text-lg font-semibold text-gray-700">Data Mahasiswa</h2>
            <p><strong>NIM:</strong> {{ $user->nim }}</p>
            <p><strong>Nama:</strong> {{ $user->name }}</p>
            <p><strong>Tempat, Tanggal Lahir:</strong> {{ $document->tempat_lahir ?? '-' }},
                {{ $document->tanggal_lahir ?? '-' }}</p>
            <p><strong>Program Studi:</strong> {{ $document->program_studi ?? '-' }}</p>
            <p><strong>No SK Rektor:</strong> {{ $document->nomor_sk_rektor ?? '-' }}</p>
            <p><strong>No Ijazah:</strong> {{ $document->nomor_ijazah ?? '-' }}</p>
        </div>

        <!-- Upload Dokumen -->
        <div class="bg-white p-6 mt-4 shadow rounded-lg">
            <h2 class="text-lg font-semibold text-gray-700">Upload Dokumen</h2>
            <form action="{{ route('mahasiswa.documents.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="mb-4">
                    <label class="block text-gray-700">File Ijazah</label>
                    <input type="file" name="file_ijazah" class="border p-2 rounded w-full">
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700">File Transkrip Nilai (Lembar Pertama)</label>
                    <input type="file" name="file_transkrip_1" class="border p-2 rounded w-full">
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700">File Transkrip Nilai (Lembar Kedua - Opsional)</label>
                    <input type="file" name="file_transkrip_2" class="border p-2 rounded w-full">
                </div>
                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Upload</button>
            </form>
        </div>

        <!-- Pengajuan Legalisir -->
        <div class="bg-white p-6 mt-4 shadow rounded-lg">
            <h2 class="text-lg font-semibold text-gray-700">Pengajuan Legalisir</h2>
            <p>Status: <span class="text-blue-600 font-semibold">{{ $document->status ?? 'Belum ada pengajuan' }}</span></p>
            @if ($document && $document->status === 'menunggu pembayaran')
                <form action="{{ route('mahasiswa.documents.submit') }}" method="POST">
                    @csrf
                    <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded mt-4">Ajukan Legalisir</button>
                </form>
            @endif
        </div>
    </div>
@endsection
