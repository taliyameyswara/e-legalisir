@extends('layouts.dashboard')

@section('content')
    <div class="">
        <div class="grid lg:grid-cols-2 gap-3">
            {{-- left --}}
            <div class="grid grid-rows-4 gap-3">
                {{-- one --}}
                <div class="row-span-1 border border-gray-200 rounded-2xl p-5 bg-white flex">
                    <div class="flex gap-3 items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor"
                            class=" h-12 bg-cyan-500/10 border border-cyan-500/50 p-2 rounded-lg text-cyan-600">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z" />
                        </svg>
                        <div class="">
                            <h1 class="text-xl font-bold text-cyan-700">Sistem Pelayanan Legalisir Ijazah</h1>
                            <p class="text-gray-500 ">
                                Selamat datang di Sistem Pelayanan Legalisir Ijazah.
                            </p>
                        </div>
                    </div>
                </div>

                {{-- two --}}
                <div class="row-span-3 border border-gray-200 rounded-2xl p-5 bg-white">
                    <h1 class="text-xl font-bold text-cyan-700">Data Mahasiswa</h1>
                    <p class="text-gray-500">
                        Berikut adalah data mahasiswa yang terdaftar di sistem
                    </p>
                    <hr class="my-3">

                    <div class="grid grid-cols-2 gap-3">
                        <div>
                            <p class="text-gray-500 text-sm">NIM</p>
                            <p class="text-gray-700 font-semibold">{{ $user->nim }}</p>
                        </div>
                        <div>
                            <p class="text-gray-500 text-sm">Nama</p>
                            <p class="text-gray-700 font-semibold">{{ $user->name }}</p>
                        </div>
                        <div>
                            <p class="text-gray-500 text-sm">Tempat, Tanggal Lahir</p>
                            <p class="text-gray-700 font-semibold">{{ $document->tempat_lahir ?? '-' }},
                                {{ $document->tanggal_lahir ?? '-' }}</p>
                        </div>
                        <div>
                            <p class="text-gray-500 text-sm">Program Studi</p>
                            <p class="text-gray-700 font-semibold">{{ $document->program_studi ?? '-' }}</p>
                        </div>
                        <div>
                            <p class="text-gray-500 text-sm">No SK Rektor</p>
                            <p class="text-gray-700 font-semibold">{{ $document->nomor_sk_rektor ?? '-' }}</p>
                        </div>
                        <div>
                            <p class="text-gray-500 text-sm">No Ijazah</p>
                            <p class="text-gray-700 font-semibold">{{ $document->nomor_ijazah ?? '-' }}</p>
                        </div>
                    </div>
                </div>
            </div>

            {{-- right --}}

            <div class="border border-gray-200 rounded-2xl p-5 bg-white">
                <h1 class="text-xl font-bold text-cyan-700">Ketentuan Legalisir Ijazah</h1>
                <p class="text-gray-500">
                    Berikut adalah ketentuan legalisir ijazah yang harus dipenuhi
                </p>
                <hr class="my-3">

                <ul class="list-disc list-inside space-y-3 text-gray-700">
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
                        <ul class="list-decimal list-inside mt-2 space-y-2 pl-5">
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
        <div class="mt-3 border border-gray-200 rounded-2xl p-5 bg-white">
            <div class="flex justify-between items-center">
                <div class="">
                    <h1 class="text-xl font-bold text-cyan-700">File Ijazah</h1>
                    <p class="text-gray-500">
                        Upload file ijazah yang akan diajukan untuk legalisir
                    </p>
                </div>
                @if (isset($document->file_ijazah) && isset($document->file_transkrip_1))
                    <button type="submit" formaction="{{ route('mahasiswa.legalisir.submit') }}"
                        class="bg-green-600 text-white px-6 py-2 h-fit rounded-xl hover:bg-green-700 hover:shadow transition-all duration-300">Ajukan
                        Legalisir</button>
                @endif
            </div>
            <hr class="my-3">
            <form action="{{ route('mahasiswa.legalisir.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="mb-6">
                    <div class="items-end gap-4">
                        <div class="">
                            <label class="block text-gray-700 font-semibold mb-2">File Ijazah</label>
                            <div class="border p-2 rounded-xl bg-gray-50 flex gap-3 items-center">
                                @if (isset($document->file_ijazah))
                                    <div class="flex gap-3 items-center">
                                        <img src="{{ asset('storage/' . $document->file_ijazah) }}" alt="Ijazah Preview"
                                            class="rounded-lg min-w-48 h-28 object-cover" id="ijazahPreview">
                                        <div class="">
                                            <p class="text-sm text-gray-500 truncate" id="ijazahFileName">
                                                {{ basename($document->file_ijazah) }}
                                            </p>
                                            <a href="{{ asset('storage/' . $document->file_ijazah) }}" target="_blank"
                                                class="text-cyan-600 hover:underline text-sm">Lihat Gambar</a>
                                        </div>
                                    </div>
                                @else
                                    <p class="text-gray-500 italic">Tidak ada gambar yang diunggah</p>
                                @endif
                                <input type="file" name="file_ijazah" id="file_ijazah"
                                    class="opacity-0 w-full h-full cursor-pointer"
                                    onchange="updatePreview('file_ijazah', 'ijazahPreview', 'ijazahFileName')">
                                <button type="button" onclick="document.getElementById('file_ijazah').click()"
                                    class="border p-2 rounded-xl mr-2 w-1/2 bg-cyan-500/10 border-cyan-500/50 text-cyan-600 ">
                                    Pilih File Ijazah
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="mb-6">
                    <div>
                        <label class="block text-gray-700 font-semibold mb-2">File Transkrip Nilai (Lembar Pertama)</label>
                        <div class="border p-2 rounded-xl bg-gray-50 flex gap-3 items-center">
                            @if (isset($document->file_transkrip_1))
                                <div class="flex gap-3 items-center">
                                    <img src="{{ asset('storage/' . $document->file_transkrip_1) }}"
                                        alt="Transkrip 1 Preview" class="rounded-lg min-w-48 h-28 object-cover"
                                        id="transkrip1Preview">
                                    <div class="">
                                        <p class="text-sm text-gray-500 truncate" id="transkrip1FileName">
                                            {{ basename($document->file_transkrip_1) }}
                                        </p>
                                        <a href="{{ asset('storage/' . $document->file_transkrip_1) }}" target="_blank"
                                            class="text-cyan-600 hover:underline text-sm">Lihat Gambar</a>
                                    </div>
                                </div>
                            @else
                                <p class="text-gray-500 italic">Tidak ada gambar yang diunggah</p>
                            @endif
                            <input type="file" name="file_transkrip_1" id="file_transkrip_1"
                                class="opacity-0 w-full h-full cursor-pointer"
                                onchange="updatePreview('file_transkrip_1', 'transkrip1Preview', 'transkrip1FileName')">
                            <button type="button" onclick="document.getElementById('file_transkrip_1').click()"
                                class="border p-2 mr-2 w-1/2 rounded-xl bg-cyan-500/10 border-cyan-500/50 text-cyan-600 ">
                                Pilih File Transkrip 1
                            </button>
                        </div>
                    </div>
                </div>

                <div class="mb-6">
                    <div class="">
                        <label class="block text-gray-700 font-semibold mb-2">File Transkrip Nilai (Lembar Kedua) -
                            Opsional</label>
                        <div class="border p-2 rounded-xl bg-gray-50 flex gap-3 items-center">
                            @if (isset($document->file_transkrip_2))
                                <div class="flex gap-3 items-center">
                                    <img src="{{ asset('storage/' . $document->file_transkrip_2) }}"
                                        alt="Transkrip 2 Preview" class="rounded-lg min-w-48 h-28 object-cover"
                                        id="transkrip2Preview">
                                    <div class="">
                                        <p class="text-sm text-gray-500 truncate" id="transkrip2FileName">
                                            {{ basename($document->file_transkrip_2) }}
                                        </p>
                                        <a href="{{ asset('storage/' . $document->file_transkrip_2) }}" target="_blank"
                                            class="text-cyan-600 hover:underline text-sm">Lihat Gambar</a>
                                    </div>
                                </div>
                            @else
                                <p class="text-gray-500 italic w-full">Tidak ada gambar yang diunggah</p>
                            @endif
                            <input type="file" name="file_transkrip_2" id="file_transkrip_2"
                                class="opacity-0 w-full h-full cursor-pointer"
                                onchange="updatePreview('file_transkrip_2', 'transkrip2Preview', 'transkrip2FileName')">
                            <button type="button" onclick="document.getElementById('file_transkrip_2').click()"
                                class="border p-2 rounded-xl mr-2 w-1/2  bg-cyan-500/10 border-cyan-500/50 text-cyan-600 ">
                                Pilih File Transkrip 2
                            </button>
                        </div>
                    </div>
                </div>

                <div class="flex justify-end gap-3">
                    <button type="submit"
                        class="bg-cyan-600 text-white px-6 py-2 rounded-xl hover:bg-cyan-700 hover:shadow transition-all duration-300">Upload</button>
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
