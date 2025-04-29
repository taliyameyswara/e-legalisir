@extends('layouts.dashboard')

@section('title', 'Dashboard - E-Legalisir')

@section('content')
    <div class="">
        <!-- Header Section -->
        <div>
            <h1 class="text-2xl font-bold text-cyan-700">Sistem Pelayanan Legalisir Ijazah</h1>
            <p class="mt-1 text-gray-600">
                Selamat datang, <span class="font-semibold">{{ Auth::user()->name }}</span> di Sistem Pelayanan
                Legalisir Ijazah.
            </p>
        </div>

        <!-- Menu Section -->
        <div class="grid grid-cols-1 gap-6 mt-4 md:grid-cols-2 lg:grid-cols-3">
            <!-- Menu Card 1 -->
            <div
                class="p-5 bg-white rounded-2xl border border-gray-200 transition-all hover:bg-cyan-50 hover:border-cyan-400">
                <div class="flex gap-4 items-center">
                    <div
                        class="flex justify-center items-center w-12 h-12 rounded-lg border bg-cyan-500/10 border-cyan-500/50">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="w-6 h-6 text-cyan-600">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z" />
                        </svg>
                    </div>
                    <div>
                        <h2 class="text-lg font-semibold text-gray-700">Ajukan Legalisir</h2>
                        <p class="text-sm text-gray-500">Ajukan legalisir ijazah Anda dengan mudah.</p>
                    </div>
                </div>
                <a href={{ route('mahasiswa.legalisir.index') }}
                    class="inline-block mt-4 text-sm font-medium text-cyan-600 hover:underline">
                    Lihat Selengkapnya
                </a>
            </div>

            <!-- Menu Card 2 -->
            <div
                class="p-5 bg-white rounded-2xl border border-gray-200 transition-all hover:bg-cyan-50 hover:border-cyan-400">
                <div class="flex gap-4 items-center">
                    <div
                        class="flex justify-center items-center w-12 h-12 rounded-lg border bg-cyan-500/10 border-cyan-500/50">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="w-6 h-6 text-cyan-600">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M19.5 12c0-1.232-.046-2.453-.138-3.662a4.006 4.006 0 0 0-3.7-3.7 48.678 48.678 0 0 0-7.324 0 4.006 4.006 0 0 0-3.7 3.7c-.017.22-.032.441-.046.662M19.5 12l3-3m-3 3-3-3m-12 3c0 1.232.046 2.453.138 3.662a4.006 4.006 0 0 0 3.7 3.7 48.656 48.656 0 0 0 7.324 0 4.006 4.006 0 0 0 3.7-3.7c.017-.22.032-.441.046-.662M4.5 12l3 3m-3-3-3 3" />
                        </svg>
                    </div>
                    <div>
                        <h2 class="text-lg font-semibold text-gray-700">Riwayat Pengajuan</h2>
                        <p class="text-sm text-gray-500">Lihat riwayat pengajuan legalisir Ijazah Anda.</p>
                    </div>
                </div>
                <a href={{ route('mahasiswa.legalisir.index') }}
                    class="inline-block mt-4 text-sm font-medium text-cyan-600 hover:underline">
                    Lihat Selengkapnya
                </a>
            </div>

            <!-- Menu Card 3 -->
            <div
                class="p-5 bg-white rounded-2xl border border-gray-200 transition-all hover:bg-cyan-50 hover:border-cyan-400">
                <div class="flex gap-4 items-center">
                    <div
                        class="flex justify-center items-center w-12 h-12 rounded-lg border bg-cyan-500/10 border-cyan-500/50">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="w-12 h-6 text-cyan-600">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M9.879 7.519c1.171-1.025 3.071-1.025 4.242 0 1.172 1.025 1.172 2.687 0 3.712-.203.179-.43.326-.67.442-.745.361-1.45.999-1.45 1.827v.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9 5.25h.008v.008H12v-.008Z" />
                        </svg>
                    </div>
                    <div>
                        <h2 class="text-lg font-semibold text-gray-700">Tata Cara Legalisir</h2>
                        <p class="text-sm text-gray-500">Dapatkan informasi dan bantuan terkait tata cara legalisir.</p>
                    </div>
                </div>
                <button onclick="toggleModal()" class="mt-4 text-sm font-medium text-cyan-600 hover:underline">
                    Lihat Selengkapnya
                </button>
            </div>

            <div id="modal"
                class="flex hidden fixed inset-0 z-50 justify-center items-center bg-gray-900 bg-opacity-50">
                <div class="relative p-6 w-96 bg-white rounded-lg shadow-lg">
                    <h2 class="mb-4 text-lg font-semibold text-gray-700">Tata Cara Legalisir</h2>
                    <p class="mb-4 text-sm text-gray-600">
                        1. Login ke sistem menggunakan akun Anda.<br>
                        2. Pilih menu "Ajukan Legalisir" dan isi formulir yang tersedia.<br>
                        3. Unggah dokumen yang diperlukan.<br>
                        4. Lakukan pembayaran sesuai instruksi yang diberikan.<br>
                        5. Tunggu proses verifikasi dari admin.<br>
                        6. Cek status pengajuan secara berkala di "Riwayat Legalisir".<br>
                    </p>
                    <button onclick="toggleModal()"
                        class="px-4 py-2 text-white bg-cyan-600 rounded-lg hover:bg-cyan-700">Tutup</button>
                </div>
            </div>

        </div>
    </div>

     {{-- Tutorial Section --}}
     <div class="grid gap-3 mt-3 lg:grid-cols-2">
        {{-- Video Tutorial --}}
        <div class="p-5 bg-white rounded-2xl border border-gray-200">
            <div class="flex gap-3 items-center mb-4">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="w-6 h-6 text-cyan-600">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.91 11.672a.375.375 0 0 1 0 .656l-5.603 3.113a.375.375 0 0 1-.557-.328V8.887c0-.286.307-.466.557-.327l5.603 3.112Z" />
                </svg>
                <h2 class="text-lg font-semibold text-cyan-700">Video Tutorial</h2>
            </div>
            <div class="overflow-hidden relative rounded-xl aspect-video">
                <iframe
                    class="absolute top-0 left-0 w-full h-full"
                    src="https://www.youtube.com/embed/IpFX2vq8HKw"
                    title="Tutorial Legalisir Online"
                    frameborder="0"
                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                    allowfullscreen>
                </iframe>
            </div>
            <p class="mt-3 text-sm text-gray-600">
                Video tutorial ini akan membantu Anda memahami proses legalisir ijazah online dari awal hingga akhir.
            </p>
        </div>

        {{-- PDF Guides --}}
        <div class="p-5 bg-white rounded-2xl border border-gray-200">
            <div class="flex gap-3 items-center mb-4">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="w-6 h-6 text-cyan-600">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z" />
                </svg>
                <h2 class="text-lg font-semibold text-cyan-700">Panduan PDF</h2>
            </div>
            <div class="space-y-3">
                <a href="" class="flex gap-3 items-center p-3 rounded-lg border transition-all duration-200 hover:bg-gray-50 group">
                    <div class="p-2 bg-red-50 rounded-lg">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="w-6 h-6 text-red-600">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M7.5 7.5h-.75A2.25 2.25 0 0 0 4.5 9.75v7.5a2.25 2.25 0 0 0 2.25 2.25h7.5a2.25 2.25 0 0 0 2.25-2.25v-7.5a2.25 2.25 0 0 0-2.25-2.25h-.75m-6 3.75 3 3m0 0 3-3m-3 3V1.5m6 9h.75a2.25 2.25 0 0 1 2.25 2.25v7.5a2.25 2.25 0 0 1-2.25 2.25h-7.5a2.25 2.25 0 0 1-2.25-2.25v-.75" />
                        </svg>
                    </div>
                    <div class="flex-1">
                        <h3 class="font-medium text-gray-800">Panduan Lengkap Legalisir</h3>
                        <p class="text-sm text-gray-600">Dokumen PDF berisi panduan detail proses legalisir</p>
                    </div>
                    <span class="text-sm text-cyan-600 group-hover:underline">Download</span>
                </a>


            </div>
        </div>
    </div>

    <script>
        function toggleModal() {
            document.getElementById('modal').classList.toggle('hidden');
        }
    </script>
@endsection
