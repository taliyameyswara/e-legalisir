@extends('layouts.superadmin')

@section('content')
<div class="">
    <div class="p-5 bg-white border border-gray-200 rounded-2xl">
        <div class="flex items-center justify-between mb-4">
            <div>
                <h1 class="text-xl font-semibold text-cyan-700">Data Alumni</h1>
                <p class="text-sm text-gray-500">
                    Berikut adalah semua data alumni yang terdaftar
                </p>
            </div>
            <!-- Tombol Aksi -->
            <div class="flex space-x-2">
                <a href="{{ route('superadmin.student.export') }}" class="inline-flex items-center px-4 py-2 text-sm font-medium text-green-600 transition border border-green-600 rounded-lg hover:bg-green-50">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4 mr-2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 8.25H7.5a2.25 2.25 0 0 0-2.25 2.25v9a2.25 2.25 0 0 0 2.25 2.25h9a2.25 2.25 0 0 0 2.25-2.25v-9a2.25 2.25 0 0 0-2.25-2.25H15M9 12l3 3m0 0 3-3m-3 3V2.25" />
                    </svg>
                    Download Excel
                </a>
                <a href="{{ route('superadmin.student.create') }}" class="inline-flex items-center px-4 py-2 text-sm font-medium text-white transition rounded-lg bg-cyan-700 hover:bg-cyan-800">
                    <svg class="w-4 h-4 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                    </svg>
                    Tambah Alumni
                </a>
            </div>
        </div>

        <form action="" method="GET">
            <div class="flex items-center w-1/3 gap-2 mb-4">
                <input
                    type="text"
                    name="search"
                    id="search"
                    placeholder="Cari Alumni..."
                    value="{{ request('search') }}"
                    class="flex-1 px-4 py-2 text-sm transition-all duration-200 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-cyan-500 focus:border-transparent"
                >
                <button
                    type="submit"
                    class="px-4 py-2 text-sm font-medium text-white transition-colors duration-200 rounded-lg bg-cyan-700 hover:bg-cyan-700 focus:outline-none focus:ring-2 focus:ring-cyan-500 focus:ring-offset-2"
                >
                    <div class="flex items-center gap-1">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                        <span>Cari</span>
                    </div>
                </button>
            </div>
        </form>

        <div class="overflow-x-auto">
            <table class="w-full text-sm text-left text-gray-600">
                <thead class="text-xs font-semibold text-gray-700 uppercase bg-gray-100">
                    <tr>
                        <th class="px-4 py-3">No</th>
                        <th class="px-4 py-3">Nama Alumni</th>
                        <th class="px-4 py-3">NIM</th>
                        <th class="px-4 py-3 text-center">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($students as $index => $student)
                        <tr class="border-b hover:bg-gray-50">
                            <td class="px-4 py-3">{{ $index + 1 }}</td>
                            <td class="px-4 py-3">{{ $student->user->name }}</td>
                            <td class="px-4 py-3">{{ $student->user->nim }}</td>
                            <td class="flex flex-row items-center justify-center gap-2 px-4 py-3 text-center">
                                <a href="{{ route('superadmin.student.edit', $student->id) }}"
                                    class="transition-all duration-200 text-cyan-600 hover:underline hover:text-cyan-700">
                                    Edit
                                </a>

                                <form action="{{ route('superadmin.student.delete', $student->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        class="text-red-600 transition-all duration-200 hover:underline hover:text-red-700">
                                        Hapus
                                    </button>
                                </form>

                            </td>
                        </tr>
                    @endforeach

                    {{-- jika tidak ada data transaksi --}}
                    @if ($students->isEmpty())
                        <tr>
                            <td colspan="4" class="py-4 text-center">
                                <p class="text-gray-500">Belum ada data riwayat transaksi legalisir</p>
                            </td>
                        </tr>
                    @endif
                </tbody>
            </table>
            <div class="mt-4">
                {{ $students->links() }}
            </div>
        </div>
    </div>
</div>
@endsection
