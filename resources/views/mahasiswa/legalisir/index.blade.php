@extends('layouts.dashboard')

@section('content')
    <div class="">
        <div class="grid gap-3 lg:grid-cols-2">
            {{-- left --}}
            <div class="grid grid-rows-4 gap-3">
                {{-- one --}}
                <div class="flex row-span-1 p-5 bg-white rounded-2xl border border-gray-200">
                    <div class="flex gap-3 items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor"
                            class="p-2 h-12 text-cyan-600 rounded-lg border bg-cyan-500/10 border-cyan-500/50">
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
                <div class="row-span-3 p-5 bg-white rounded-2xl border border-gray-200">
                    <div class="flex justify-between">
                        <h1 class="text-xl font-bold text-cyan-700">Data Alumni</h1>
                        <a href={{ route('biodata.index') }}
                            class="flex gap-1 items-center text-sm text-cyan-700 hover:underline">
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
                            <p class="text-sm text-gray-500">No Ijazah</p>
                            <p class="font-semibold text-gray-700">{{ Auth::user()->student->nomor_ijazah ?? '-' }}</p>
                        </div>
                    </div>
                </div>
            </div>

            {{-- right --}}

            <div class="p-5 bg-white rounded-2xl border border-gray-200">
                <h1 class="text-xl font-bold text-cyan-700">Ketentuan Legalisir Ijazah</h1>
                <p class="text-gray-500">
                    Berikut adalah ketentuan legalisir ijazah yang harus dipenuhi
                </p>
                <hr class="my-3">

                <ul class="space-y-3 list-disc list-inside text-gray-700">
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
        <div class="p-5 mt-3 bg-white rounded-2xl border border-gray-200">
            <div class="flex justify-between items-center">
                <div class="">
                    <h1 class="text-xl font-bold text-cyan-700">File Ijazah</h1>
                    <p class="text-gray-500">
                        Upload file ijazah untuk mengajukan legalisir
                    </p>
                </div>
                @if (isset($file_ijazah))
                    <a href="{{ route('mahasiswa.transaksi.create') }}"
                    class="px-6 py-2 text-white bg-cyan-600 rounded-xl transition-all duration-300 h-fit hover:bg-cyan-700 hover:shadow">
                    Ajukan Legalisir
                </a>
                @endif
            </div>
            <hr class="my-3">
            <form action="{{ route('mahasiswa.legalisir.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="mb-6">
                    <label class="block mb-2 font-semibold text-gray-700">File Ijazah</label>
                    <div class="flex flex-col gap-4 items-center p-4 w-full bg-gray-50 rounded-xl border md:flex-row md:justify-between">
                        <div class="flex gap-3 items-center">
                            <img src="{{ asset('image/pdf.png') }}" alt="" class="object-cover w-12 h-12 rounded-lg" id="ijazahPreview">
                            <div class="flex flex-col">
                                <p class="text-sm text-gray-500 truncate" id="ijazahFileName">
                                    {{ isset($file_ijazah) ? $file_ijazah->file_name : 'Tidak ada file yang diunggah' }}
                                </p>
                                @if (isset($file_ijazah))
                                    <a href="{{ asset( $file_ijazah->file) }}" target="_blank" class="text-sm text-cyan-600 hover:underline">Lihat File</a>
                                @endif
                            </div>
                        </div>

                        <div class="flex flex-col gap-3 items-center md:flex-row">
                            <input type="number" name="input_ijazah" id="input_ijazah" value="{{ $file_ijazah->jumlah ?? 1 }}"
                                class="p-2 w-full text-gray-700 bg-gray-100 rounded-xl border border-gray-200 md:w-32"
                                placeholder="Jumlah Ijazah">

                            <div class="relative w-full md:w-auto">
                                <input type="file" name="file_ijazah" id="file_ijazah" class="absolute inset-0 w-full h-full opacity-0 cursor-pointer"
                                    onchange="updatePreview('file_ijazah', 'ijazahPreview', 'ijazahFileName')">
                                <button type="button" onclick="document.getElementById('file_ijazah').click()"
                                    class="p-2 w-full text-center text-cyan-600 rounded-xl border md:w-auto bg-cyan-500/10 border-cyan-500/50">
                                    Upload File
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="mb-6">
                    <label class="block mb-2 font-semibold text-gray-700">File Transkrip Nilai - Opsional</label>
                    <div class="flex flex-col gap-4 items-center p-4 w-full bg-gray-50 rounded-xl border md:flex-row md:justify-between">
                        <div class="flex gap-3 items-center">
                            <img src="{{ asset('image/pdf.png') }}" alt="" class="object-cover w-12 h-12 rounded-lg" id="transkripPreview">
                            <div class="flex flex-col">
                                <p class="text-sm text-gray-500 truncate" id="transkripFileName">
                                    {{ isset($file_transkrip) ? $file_transkrip->file_name : 'Tidak ada file yang diunggah' }}
                                </p>
                                @if (isset($file_transkrip))
                                    <a href="{{ asset( $file_transkrip->file) }}" target="_blank" class="text-sm text-cyan-600 hover:underline">Lihat File</a>
                                @endif
                            </div>
                        </div>
                        <div class="flex flex-col gap-3 items-center md:flex-row">
                            <input type="number" name="input_transkrip" id="input_transkrip" value="{{ $file_transkrip->jumlah ?? 1 }}"
                                class="p-2 w-full text-gray-700 bg-gray-100 rounded-xl border border-gray-200 md:w-32"
                                placeholder="Jumlah Transkrip">
                            <div class="relative w-full md:w-auto">
                                <input type="file" name="file_transkrip" id="file_transkrip" class="absolute inset-0 w-full h-full opacity-0 cursor-pointer"
                                    onchange="updatePreview('file_transkrip', 'transkripPreview', 'transkripFileName')">
                                <button type="button" onclick="document.getElementById('file_transkrip').click()"
                                    class="p-2 w-full text-center text-cyan-600 rounded-xl border md:w-auto bg-cyan-500/10 border-cyan-500/50">
                                    Upload File
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="mb-6">
                    <label class="block mb-2 font-semibold text-gray-700">Akta Mengajar - Opsional</label>
                    <div class="flex flex-col gap-4 items-center p-4 w-full bg-gray-50 rounded-xl border md:flex-row md:justify-between">
                        <div class="flex gap-3 items-center">
                            <img src="{{ asset('image/pdf.png') }}" alt="" class="object-cover w-12 h-12 rounded-lg" id="aktaMengajarPreview">
                            <div class="flex flex-col">
                                <p class="text-sm text-gray-500 truncate" id="aktaMengajarFileName">
                                    {{ isset($file_akta) ? $file_akta->file_name : 'Tidak ada file yang diunggah' }}
                                </p>
                                @if (isset($file_akta))
                                    <a href="{{ asset( $file_akta->file) }}" target="_blank" class="text-sm text-cyan-600 hover:underline">Lihat File</a>
                                @endif
                            </div>
                        </div>
                        <div class="flex flex-col gap-3 items-center md:flex-row">
                            <input type="number" name="input_akta" id="input_akta" value="{{ $file_akta->jumlah ?? 1 }}"
                                class="p-2 w-full text-gray-700 bg-gray-100 rounded-xl border border-gray-200 md:w-32"
                                placeholder="Jumlah Akta">
                            <div class="relative w-full md:w-auto">
                                <input type="file" name="file_akta" id="file_akta" class="absolute inset-0 w-full h-full opacity-0 cursor-pointer"
                                    onchange="updatePreview('file_akta', 'aktaMengajarPreview', 'aktaMengajarFileName')">
                                <button type="button" onclick="document.getElementById('file_akta').click()"
                                    class="p-2 w-full text-center text-cyan-600 rounded-xl border md:w-auto bg-cyan-500/10 border-cyan-500/50">
                                    Upload File
                                </button>
                            </div>
                        </div>
                    </div>
                </div>



                <div class="flex gap-3 justify-end">
                    <button type="submit"
                        class="px-6 py-2 text-white bg-cyan-600 rounded-xl transition-all duration-300 hover:bg-cyan-700 hover:shadow">
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
                // document.getElementById(imgId).src = e.target.result;
                document.getElementById(fileNameId).textContent = file.name;
            };

            if (file) {
                reader.readAsDataURL(file);
            }
        }
    </script>
@endsection
