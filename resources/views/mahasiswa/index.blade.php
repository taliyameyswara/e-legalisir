@extends('layouts.dashboard')

@section('title', 'Dashboard - E-Legalisir')

@section('content')
    <div class="">
        <!-- Header Section -->
        <div>
            <h1 class="text-2xl font-bold text-cyan-700">Sistem Pelayanan Legalisir Ijazah</h1>
            <p class="text-gray-600 mt-1">
                Selamat datang, <span class="font-semibold">{{ Auth::user()->name }}</span> di Sistem Pelayanan
                Legalisir Ijazah.
            </p>
        </div>

        <!-- Menu Section -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mt-4">
            <!-- Menu Card 1 -->
            <div
                class="bg-white border border-gray-200 rounded-2xl  p-5 hover:bg-cyan-50 hover:border-cyan-400 transition-all">
                <div class="flex items-center gap-4">
                    <div
                        class="h-12 w-12 flex items-center justify-center bg-cyan-500/10 border border-cyan-500/50 rounded-lg">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="h-6 w-6 text-cyan-600">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z" />
                        </svg>
                    </div>
                    <div>
                        <h2 class="text-lg font-semibold text-gray-700">Ajukan Legalisir</h2>
                        <p class="text-gray-500 text-sm">Ajukan legalisir ijazah Anda dengan mudah.</p>
                    </div>
                </div>
                <a href="#" class="mt-4 inline-block text-sm font-medium text-cyan-600 hover:underline">
                    Lihat Selengkapnya
                </a>
            </div>

            <!-- Menu Card 2 -->
            <div
                class="bg-white border border-gray-200 rounded-2xl  p-5 hover:bg-cyan-50 hover:border-cyan-400 transition-all">
                <div class="flex items-center gap-4">
                    <div
                        class="h-12 w-12 flex items-center justify-center bg-cyan-500/10 border border-cyan-500/50 rounded-lg">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="h-6 w-6 text-cyan-600">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M19.5 12c0-1.232-.046-2.453-.138-3.662a4.006 4.006 0 0 0-3.7-3.7 48.678 48.678 0 0 0-7.324 0 4.006 4.006 0 0 0-3.7 3.7c-.017.22-.032.441-.046.662M19.5 12l3-3m-3 3-3-3m-12 3c0 1.232.046 2.453.138 3.662a4.006 4.006 0 0 0 3.7 3.7 48.656 48.656 0 0 0 7.324 0 4.006 4.006 0 0 0 3.7-3.7c.017-.22.032-.441.046-.662M4.5 12l3 3m-3-3-3 3" />
                        </svg>
                    </div>
                    <div>
                        <h2 class="text-lg font-semibold text-gray-700">Riwayat Pengajuan</h2>
                        <p class="text-gray-500 text-sm">Lihat riwayat pengajuan legalisir Ijazah Anda.</p>
                    </div>
                </div>
                <a href="#" class="mt-4 inline-block text-sm font-medium text-cyan-600 hover:underline">
                    Lihat Selengkapnya
                </a>
            </div>

            <!-- Menu Card 3 -->
            <div
                class="bg-white border border-gray-200 rounded-2xl  p-5 hover:bg-cyan-50 hover:border-cyan-400 transition-all">
                <div class="flex items-center gap-4">
                    <div
                        class="h-12 w-12 flex items-center justify-center bg-cyan-500/10 border border-cyan-500/50 rounded-lg">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="h-6 w-12 text-cyan-600">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M9.879 7.519c1.171-1.025 3.071-1.025 4.242 0 1.172 1.025 1.172 2.687 0 3.712-.203.179-.43.326-.67.442-.745.361-1.45.999-1.45 1.827v.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9 5.25h.008v.008H12v-.008Z" />
                        </svg>
                    </div>
                    <div>
                        <h2 class="text-lg font-semibold text-gray-700">Tata Cara Legalisir</h2>
                        <p class="text-gray-500 text-sm">Dapatkan informasi dan bantuan terkait tata cara legalisir.</p>
                    </div>
                </div>
                <a href="#" class="mt-4 inline-block text-sm font-medium text-cyan-600 hover:underline">
                    Lihat Selengkapnya
                </a>
            </div>
        </div>
    </div>
@endsection
