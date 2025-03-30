@extends('layouts.dashboard')

@section('content')
    <div class="">
        <div class="grid gap-3 lg:grid-cols-2">
            {{-- left --}}
            <div class="grid grid-rows-4 gap-3">
                {{-- one --}}
                <div class="flex row-span-1 p-5 bg-white border border-gray-200 rounded-2xl">
                    <div class="flex items-center gap-3">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor"
                            class="h-12 p-2 border rounded-lg bg-cyan-500/10 border-cyan-500/50 text-cyan-600">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z" />
                        </svg>
                        <div class="">
                            <h1 class="text-xl font-semibold text-cyan-700">Sistem Pelayanan Legalisir Ijazah</h1>
                            <p class="text-sm text-gray-500">
                                Selamat datang di Sistem Pelayanan Legalisir Ijazah.
                            </p>
                        </div>
                    </div>
                </div>

                {{-- two --}}
                <div class="row-span-3 p-5 bg-white border border-gray-200 rounded-2xl">
                    <div class="flex justify-between">
                        <h1 class="text-xl font-bold text-cyan-700">Data Alumni</h1>
                        <a href={{ route('biodata.index') }}
                            class="flex items-center gap-1 text-sm text-cyan-700 hover:underline">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" class="size-5">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                            </svg>
                            <span>Edit Biodata</span>
                        </a>
                    </div>
                    <p class="text-gray-500">
                        Berikut adalah data alumni yang terdaftar di sistem
                    </p>
                    <hr class="my-3">

                    <div class="grid grid-cols-2 gap-3">
                        <div>
                            <p class="text-sm text-gray-500">NIM</p>
                            <p class="font-semibold text-gray-700">{{ Auth::user()->nim }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500">Nama</p>
                            <p class="font-semibold text-gray-700">{{ Auth::user()->name }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500">Tempat, Tanggal Lahir</p>
                            <p class="font-semibold text-gray-700">{{ Auth::user()->student->tempat_lahir ?? '-' }},
                                {{ Auth::user()->student->tanggal_lahir ?? '-' }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500">Program Studi</p>
                            <p class="font-semibold text-gray-700">{{ Auth::user()->student->program_studi ?? '-' }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500">No SK Rektor</p>
                            <p class="font-semibold text-gray-700">{{ Auth::user()->student->nomor_sk_rektor ?? '-' }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500">No Ijazah</p>
                            <p class="font-semibold text-gray-700">{{ Auth::user()->student->nomor_ijazah ?? '-' }}</p>
                        </div>
                    </div>
                </div>
            </div>

            {{-- right --}}

            <div class="p-5 bg-white border border-gray-200 rounded-2xl">
                <h1 class="text-xl font-bold text-cyan-700">Ketentuan Legalisir Ijazah</h1>
                <p class="text-gray-500">
                    Berikut adalah ketentuan legalisir ijazah yang harus dipenuhi
                </p>
                <hr class="my-3">

                <ul class="space-y-3 text-gray-700 list-disc list-inside">
                    <li>
                        Biaya legalisir ijazah dengan menggunakan <span class="font-semibold text-gray-800">Virtual
                            Account</span>.
                    </li>
                    <li>
                        File yang akan diunggah harus dalam format <span
                            class="font-semibold text-gray-800">jpg/jpeg/png</span>
                        dengan kualitas baik.
                    </li>
                    <li>
                        Ukuran file tidak melebihi <span class="font-semibold text-gray-800">1 megabyte</span> dan
                        disarankan menggunakan mesin scan.
                    </li>
                    <li>
                        File ijazah harus discan dalam bentuk <span class="font-semibold text-gray-800">landscape</span>,
                        dengan posisi logo di atas.
                    </li>
                    <li>
                        File transkrip nilai harus disesuaikan dengan ketentuan berikut:
                        <ul class="pl-5 mt-2 space-y-2 list-decimal list-inside">
                            <li>
                                Ukuran kertas <span class="font-semibold text-gray-800">A4</span> discan dalam bentuk
                                <span class="font-semibold text-gray-800">portrait</span>. Jika ada dua sisi, maka
                                discan dalam file terpisah.
                            </li>
                            <li>
                                Ukuran transkrip nilai dengan kertas <span class="font-semibold text-gray-800">A3</span>
                                dipindai dalam ukuran <span class="font-semibold text-gray-800">A4 landscape</span>
                                dalam satu file.
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>

        {{-- four --}}
        <div class="p-5 mt-3 bg-white border border-gray-200 rounded-2xl">
            <div class="flex items-center justify-between">
                <div class="">
                    <h1 class="text-xl font-bold text-cyan-700">File Ijazah</h1>
                    <p class="text-gray-500">
                        Upload file ijazah untuk mengajukan legalisir
                    </p>
                </div>
                @if (isset($file_ijazah))
                    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>

                    <div x-data="{ open: false }" class="relative">
                        <button @click="open = !open"
                            class="px-6 py-2 text-white transition-all duration-300 bg-cyan-600 h-fit rounded-xl hover:bg-cyan-700 hover:shadow">
                            Ajukan Legalisir
                        </button>

                        <div x-show="open" @click.away="open = false"
                            class="absolute right-0 w-64 mt-2 overflow-hidden bg-white border border-gray-200 shadow-md rounded-xl">
                            <a href="{{ route('mahasiswa.transaksi.create', ['type' => 'cod']) }}"
                                class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Pengiriman ke rumah
                            </a>
                            <hr class="">
                            <a href="{{ route('mahasiswa.transaksi.create', ['type' => 'ambil-kampus']) }}"
                                class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Pengambilan di Fakultas
                                Kampus</a>
                        </div>
                    </div>
                @endif
            </div>
            <hr class="my-3">
            <form action="{{ route('mahasiswa.legalisir.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="mb-6">
                    <label class="block mb-2 font-semibold text-gray-700">File Ijazah </label>
                    <div class="flex items-center gap-3 p-2 border rounded-xl bg-gray-50">
                        <div class="flex items-center gap-3">
                            <img src="{{ isset($file_ijazah) ? asset( $file_ijazah->file) : asset('image/default.png') }}"
                                alt="Ijazah Preview" class="object-cover rounded-lg min-w-48 h-28" id="ijazahPreview">
                            <div>
                                <p class="text-sm text-gray-500 truncate" id="ijazahFileName">
                                    {{ isset($file_ijazah) ? $file_ijazah->file_name : 'Tidak ada file yang diunggah' }}
                                </p>
                                @if (isset($file_ijazah))
                                    <a href="{{ asset( $file_ijazah->file) }}" target="_blank"
                                        class="text-sm text-cyan-600 hover:underline">Lihat Gambar</a>
                                @endif
                            </div>
                        </div>
                        <input type="number" name="input_ijazah" id="input_ijazah"
                        class="p-2 text-gray-700 bg-gray-100 border border-gray-200 rounded-xl"
                        placeholder="Input Jumlah ijazah">
                        <input type="file" name="file_ijazah" id="file_ijazah"
                            class="w-full h-full opacity-0 cursor-pointer"
                            onchange="updatePreview('file_ijazah', 'ijazahPreview', 'ijazahFileName')">
                        <button type="button" onclick="document.getElementById('file_ijazah').click()"
                            class="w-1/2 p-2 border rounded-xl bg-cyan-500/10 border-cyan-500/50 text-cyan-600">
                            Pilih File Ijazah
                        </button>
                    </div>
                </div>

                <div class="mb-6">
                    <label class="block mb-2 font-semibold text-gray-700">File Transkrip Nilai -
                        Opsional</label>
                    <div class="flex items-center gap-3 p-2 border rounded-xl bg-gray-50">
                        <div class="flex items-center gap-3">
                            <img src="{{ isset($file_transkrip) ? asset( $file_transkrip->file) : asset('image/default.png') }}"
                                alt="Transkrip 1 Preview" class="object-cover rounded-lg min-w-48 h-28"
                                id="transkrip1Preview">
                            <div>
                                <p class="text-sm text-gray-500 truncate" id="transkrip1FileName">
                                    {{ isset($file_transkrip) ? $file_transkrip->file_name : 'Tidak ada file yang diunggah' }}
                                </p>
                                @if (isset($file_transkrip))
                                    <a href="{{ asset( $file_transkrip->file) }}" target="_blank"
                                        class="text-sm text-cyan-600 hover:underline">Lihat Gambar</a>
                                @endif
                            </div>
                        </div>
                        <input type="number" name="input_transkrip" id="input_transkrip"
                            class="p-2 text-gray-700 bg-gray-100 border border-gray-200 rounded-xl"
                            placeholder="Input Jumlah Transkrip">
                        <input type="file" name="file_transkrip" id="file_transkrip"
                            class="w-full h-full opacity-0 cursor-pointer"
                            onchange="updatePreview('file_transkrip', 'transkrip1Preview', 'transkrip1FileName')">
                        <button type="button" onclick="document.getElementById('file_transkrip').click()"
                            class="w-1/2 p-2 border rounded-xl bg-cyan-500/10 border-cyan-500/50 text-cyan-600">
                            Pilih File Transkrip 1
                        </button>
                    </div>
                </div>


                <div class="mb-6">
                    <label class="block mb-2 font-semibold text-gray-700">Akta Mengajar -
                        Opsional</label>
                    <div class="flex items-center gap-3 p-2 border rounded-xl bg-gray-50">
                        <div class="flex items-center gap-3">

                            <img src="{{ isset($file_akta) ? asset( $file_akta->file) : asset('image/default.png') }}"
                                alt="Transkrip 2 Preview" class="object-cover rounded-lg min-w-48 h-28"
                                id="aktaMengajarPreview">
                            <div>
                                <p class="text-sm text-gray-500 truncate" id="aktaMengajarFileName">
                                    {{ isset($file_akta) ? $file_akta->file_name : 'Tidak ada file yang diunggah' }}
                                </p>
                                @if (isset($file_akta))
                                    <a href="{{ asset( $file_akta->file) }}" target="_blank"
                                        class="text-sm text-cyan-600 hover:underline">Lihat Gambar</a>
                                @endif
                            </div>
                        </div>
                        <input type="number" name="input_akta" id="input_akta"
                        class="p-2 text-gray-700 bg-gray-100 border border-gray-200 rounded-xl"
                        placeholder="Input Jumlah akta">
                        <input type="file" name="file_akta" id="file_akta"
                            class="w-full h-full opacity-0 cursor-pointer"
                            onchange="updatePreview('file_akta', 'aktaMengajarPreview', 'aktaMengajarFileName')">
                        <button type="button" onclick="document.getElementById('file_akta').click()"
                            class="w-1/2 p-2 border rounded-xl bg-cyan-500/10 border-cyan-500/50 text-cyan-600">
                            Pilih File Akta Mengajar
                        </button>
                    </div>
                </div>

                <div class="flex justify-end gap-3">
                    <button type="submit"
                        class="px-6 py-2 text-white transition-all duration-300 bg-cyan-600 rounded-xl hover:bg-cyan-700 hover:shadow">
                        Upload
                    </button>
                </div>
            </form>



        </div>

    </div>

    <script>
        function updatePreview(inputId, imgId, fileNameId) {
            const input = document.getElementById(inputId);
            const file = input.files[0];
            const reader = new FileReader();

            reader.onload = function(e) {
                document.getElementById(imgId).src = e.target.result;
                document.getElementById(fileNameId).textContent = file.name;
            };

            if (file) {
                reader.readAsDataURL(file);
            }
        }
    </script>
@endsection
