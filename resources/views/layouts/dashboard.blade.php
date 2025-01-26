<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Sistem Pelayanan Legalisir Ijazah')</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:ital,wght@0,200..800;1,200..800&display=swap"
        rel="stylesheet">
    @vite('resources/css/app.css')
</head>

<body class="font-sans bg-gray-100">
    <div id="sidebar"
        class="fixed top-0 left-0 h-[96%] bg-white w-60 rounded-3xl transition-all duration-300 z-50 m-4 border">
        <div class="px-5 py-6">
            <h2 class="text-lg font-bold text-cyan-700 mb-4">E-Legalisir Ijazah</h2>
            <ul>
                {{-- Dashboard --}}
                <li
                    class="{{ Request::routeIs('mahasiswa.index') ? 'bg-cyan-500/10 border border-cyan-500/50 text-cyan-600' : 'text-gray-500' }}  rounded-lg mb-2   text-sm">
                    <a href="{{ route('mahasiswa.index') }}" class="flex items-center space-x-3  py-2 px-3">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="size-5">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M3.75 6A2.25 2.25 0 0 1 6 3.75h2.25A2.25 2.25 0 0 1 10.5 6v2.25a2.25 2.25 0 0 1-2.25 2.25H6a2.25 2.25 0 0 1-2.25-2.25V6ZM3.75 15.75A2.25 2.25 0 0 1 6 13.5h2.25a2.25 2.25 0 0 1 2.25 2.25V18a2.25 2.25 0 0 1-2.25 2.25H6A2.25 2.25 0 0 1 3.75 18v-2.25ZM13.5 6a2.25 2.25 0 0 1 2.25-2.25H18A2.25 2.25 0 0 1 20.25 6v2.25A2.25 2.25 0 0 1 18 10.5h-2.25a2.25 2.25 0 0 1-2.25-2.25V6ZM13.5 15.75a2.25 2.25 0 0 1 2.25-2.25H18a2.25 2.25 0 0 1 2.25 2.25V18A2.25 2.25 0 0 1 18 20.25h-2.25A2.25 2.25 0 0 1 13.5 18v-2.25Z" />
                        </svg>
                        <span>Dashboard</span>
                    </a>
                </li>
                {{-- Legalisir --}}
                <li
                    class="{{ Request::routeIs('mahasiswa.legalisir.index') ? 'bg-cyan-500/10 border border-cyan-500/50 text-cyan-600' : 'text-gray-500' }}  rounded-lg mb-2  text-sm">
                    <a href="{{ route('mahasiswa.legalisir.index') }}" class="flex items-center space-x-3  py-2 px-3">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="size-5">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z" />
                        </svg>
                        <span>Legalisir</span>
                    </a>
                </li>
                {{-- Riwayat Legalisir --}}
                <li
                    class="{{ Request::routeIs('mahasiswa.transaksi.index') ? 'bg-cyan-500/10 border border-cyan-500/50 text-cyan-600' : 'text-gray-500' }}  rounded-lg mb-2  text-sm">
                    <a href="{{ route('mahasiswa.transaksi.index') }}" class="flex items-center space-x-3  py-2 px-3">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="size-5">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M19.5 12c0-1.232-.046-2.453-.138-3.662a4.006 4.006 0 0 0-3.7-3.7 48.678 48.678 0 0 0-7.324 0 4.006 4.006 0 0 0-3.7 3.7c-.017.22-.032.441-.046.662M19.5 12l3-3m-3 3-3-3m-12 3c0 1.232.046 2.453.138 3.662a4.006 4.006 0 0 0 3.7 3.7 48.656 48.656 0 0 0 7.324 0 4.006 4.006 0 0 0 3.7-3.7c.017-.22.032-.441.046-.662M4.5 12l3 3m-3-3-3 3" />
                        </svg>
                        <span>Riwayat Legalisir</span>
                    </a>
                </li>

            </ul>

            <!-- Logout -->
            <div class="absolute bottom-0 left-0 right-0 p-4">
                <form action="{{ route('logout') }}" method="POST" class="mt-4">
                    @csrf
                    <button
                        class="flex items-center space-x-2 py-2 px-3 text-red-500 hover:bg-red-50 rounded-lg text-sm w-full">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="size-4">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M8.25 9V5.25A2.25 2.25 0 0 1 10.5 3h6a2.25 2.25 0 0 1 2.25 2.25v13.5A2.25 2.25 0 0 1 16.5 21h-6a2.25 2.25 0 0 1-2.25-2.25V15m-3 0-3-3m0 0 3-3m-3 3H15" />
                        </svg>
                        <span>Logout</span>
                    </button>
                </form>
            </div>
        </div>
    </div>

    <div id="content" class="ml-[17rem] mt-5 mr-5 mb-3">
        <main>
            @yield('content')
        </main>
    </div>


    @include('components.toast')


</body>

</html>
