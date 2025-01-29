@extends('layouts.admin')

@section('content')
<div class="">
    <div class="p-5 bg-white border border-gray-200 rounded-2xl">
        <div class="flex items-center justify-between mb-4">
            <div>
                <h1 class="text-xl font-semibold text-cyan-700">Data Mahasiswa</h1>
                <p class="text-sm text-gray-500">
                    Berikut adalah semua data mahasiswa yang terdaftar
                </p>
            </div>
            <a href="{{ route('admin.student.create') }}" class="p-2 text-white bg-cyan-700 rounded-xl">Tambah Mahasiswa</a>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-sm text-left text-gray-600">
                <thead class="text-xs font-semibold text-gray-700 uppercase bg-gray-100">
                    <tr>
                        <th class="px-4 py-3">No</th>
                        <th class="px-4 py-3">Nama Mahasiswa</th>
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
                                <a href="{{ route('admin.student.edit', $student->id) }}"
                                    class="transition-all duration-200 text-cyan-600 hover:underline hover:text-cyan-700">
                                    Edit
                                </a>

                                <form action="{{ route('admin.student.delete', $student->id) }}" method="POST">
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
        </div>
    </div>
</div>
@endsection
