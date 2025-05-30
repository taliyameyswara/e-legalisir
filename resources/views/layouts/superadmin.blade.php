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
            <h2 class="mb-4 text-lg font-bold text-cyan-700">Super Admin E-Legalisir</h2>
            <ul>
                {{-- Dashboard --}}
                <li
                    class="{{ Request::routeIs('superadmin.index') ? 'bg-cyan-500/10 border border-cyan-500/50 text-cyan-600' : 'text-gray-500' }}  rounded-lg mb-2   text-sm">
                    <a href="{{ route('superadmin.index') }}" class="flex items-center px-3 py-2 space-x-3">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="size-5">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M3.75 6A2.25 2.25 0 0 1 6 3.75h2.25A2.25 2.25 0 0 1 10.5 6v2.25a2.25 2.25 0 0 1-2.25 2.25H6a2.25 2.25 0 0 1-2.25-2.25V6ZM3.75 15.75A2.25 2.25 0 0 1 6 13.5h2.25a2.25 2.25 0 0 1 2.25 2.25V18a2.25 2.25 0 0 1-2.25 2.25H6A2.25 2.25 0 0 1 3.75 18v-2.25ZM13.5 6a2.25 2.25 0 0 1 2.25-2.25H18A2.25 2.25 0 0 1 20.25 6v2.25A2.25 2.25 0 0 1 18 10.5h-2.25a2.25 2.25 0 0 1-2.25-2.25V6ZM13.5 15.75a2.25 2.25 0 0 1 2.25-2.25H18a2.25 2.25 0 0 1 2.25 2.25V18A2.25 2.25 0 0 1 18 20.25h-2.25A2.25 2.25 0 0 1 13.5 18v-2.25Z" />
                        </svg>
                        <span>Dashboard</span>
                    </a>
                </li>

                {{-- Data Pengajuan Legalisir --}}
                <li
                    class="{{ Request::routeIs('superadmin.transaksi.index') ? 'bg-cyan-500/10 border border-cyan-500/50 text-cyan-600' : 'text-gray-500' }}  rounded-lg mb-2   text-sm">
                    <a href="{{ route('superadmin.transaksi.index') }}" class="flex items-center px-3 py-2 space-x-3">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="size-5">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z" />
                        </svg>
                        <span>Pengajuan Legalisir</span>
                    </a>
                </li>

                <li class="{{ Request::routeIs('superadmin.kurir.index') ? 'bg-cyan-500/10 border border-cyan-500/50 text-cyan-600' : 'text-gray-500' }}  rounded-lg mb-2   text-sm">
                    <a href="{{ route('superadmin.kurir.index') }}" class="flex items-center px-3 py-2 space-x-3">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 12 3.269 3.125A59.769 59.769 0 0 1 21.485 12 59.768 59.768 0 0 1 3.27 20.875L5.999 12Zm0 0h7.5" />
                        </svg>

                        <span>Pengiriman Legalisir</span>
                    </a>
                </li>

                {{-- Data Mahasiswa --}}
                <li
                    class="{{ Request::routeIs('superadmin.student.index') ? 'bg-cyan-500/10 border border-cyan-500/50 text-cyan-600' : 'text-gray-500' }}  rounded-lg mb-2   text-sm">
                    <a href="{{ route('superadmin.student.index') }}" class="flex items-center px-3 py-2 space-x-3">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                        class="size-5">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z" />
                    </svg>

                    <span>Data Alumni</span>
                    </a>
                </li>
            </ul>

            <!-- Logout -->
            <div class="absolute bottom-0 left-0 right-0 p-4">
                <form action="{{ route('logout') }}" method="POST" class="mt-4">
                    @csrf
                    <button
                        class="flex items-center w-full px-3 py-2 space-x-2 text-sm text-red-500 rounded-lg hover:bg-red-50">
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
