@extends('layouts.dashboard')

@section('content')
    <div class="">
        <div class="border border-gray-200 rounded-2xl p-5 bg-white">
            <div class="flex justify-between items-center mb-4">
                <div>
                    <h1 class="text-xl font-bold text-cyan-700">Riwayat Legalisir Ijazah</h1>
                    <p class="text-gray-500">
                        Berikut adalah progress legalisir ijazah yang telah diajukan
                    </p>
                </div>
                <button type="submit"
                    class="bg-cyan-600 text-white px-6 py-2 rounded-xl hover:bg-cyan-700 hover:shadow transition-all duration-300">
                    Ajukan Legalisir
                </button>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full text-sm text-left text-gray-600">
                    <thead class="bg-gray-100 text-gray-700 uppercase text-xs font-semibold">
                        <tr>
                            <th class="px-4 py-3">No</th>
                            <th class="px-4 py-3">Tanggal</th>
                            <th class="px-4 py-3">Status</th>
                            <th class="px-4 py-3 text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="border-b hover:bg-gray-50">
                            <td class="px-4 py-3">2</td>
                            <td class="px-4 py-3">2025-01-18</td>
                            <td class="px-4 py-3">
                                <span
                                    class="bg-yellow-100 text-yellow-700 border border-yellow-300 px-3 py-1 rounded-full text-xs">Pending</span>
                            </td>
                            <td class="px-4 py-3 text-center">
                                <button
                                    class="text-cyan-600 hover:underline hover:text-cyan-700 transition-all duration-200">
                                    Detail
                                </button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>


        </div>
    </div>
@endsection
