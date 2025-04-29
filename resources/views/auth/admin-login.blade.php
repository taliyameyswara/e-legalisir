@extends('layouts.app')

@section('title', 'Login')

@section('content')
    <div class="flex justify-center items-center min-h-screen bg-gray-100">
        <div class="p-8 w-full max-w-md bg-white rounded-2xl border">
            <h2 class="text-2xl font-semibold text-center text-cyan-600">Masuk Admin</h2>
            <p class="mb-6 text-center text-gray-500">Silahkan masuk sebagai <strong>admin</strong> untuk melanjutkan</p>
            <form action="{{ route('login.admin') }}" method="POST">
                @csrf
                <div class="mb-4">
                    <label for="name" class="block text-sm font-medium text-gray-700">Email</label>
                    <input type="text" name="email" placeholder="Masukkan email admin" required
                        class="block px-3 py-2 mt-1 w-full rounded-lg border border-gray-300 focus:outline-none focus:ring-cyan-500 focus:border-cyan-500 sm:text-sm">
                </div>

                <div class="mb-4">
                    <label for="nim" class="block text-sm font-medium text-gray-700">Password</label>
                    <input type="password" name="password" placeholder="Masukkan password" required
                        class="block px-3 py-2 mt-1 w-full rounded-lg border border-gray-300 focus:outline-none focus:ring-cyan-500 focus:border-cyan-500 sm:text-sm">
                </div>

                <div class="mb-4">
                    <label for="captcha" class="block text-sm font-medium text-gray-700">Captcha</label>
                    <div class="flex gap-2 items-center">
                        <span class="captcha">{!! captcha_img() !!}</span>
                        <button type="button" id="refresh"
                            class="p-2 text-cyan-600 bg-cyan-50 rounded-lg hover:bg-cyan-100 focus:outline-none">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" class="w-5 h-5">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M16.023 9.348h4.992v-.001M2.985 19.644v-4.992m0 0h4.992m-4.993 0 3.181 3.183a8.25 8.25 0 0 0 13.803-3.7M4.031 9.865a8.25 8.25 0 0 1 13.803-3.7l3.181 3.182m0-4.991v4.99" />
                            </svg>
                        </button>
                    </div>
                    <input type="text" name="captcha" placeholder="Masukkan captcha" required
                        class="block px-3 py-2 mt-2 w-full rounded-lg border border-gray-300 focus:outline-none focus:ring-cyan-500 focus:border-cyan-500 sm:text-sm">
                </div>


                <script>
                    document.getElementById('refresh').addEventListener('click', function() {
                        fetch('/refresh/captcha')
                            .then(response => response.json())
                            .then(data => {
                                document.querySelector('.captcha').innerHTML = data.captcha;
                            });
                    });
                </script>

                <button type="submit"
                    class="px-4 py-2 w-full text-white bg-cyan-600 rounded-lg hover:bg-cyan-700 focus:outline-none focus:ring-2 focus:ring-cyan-500 focus:ring-opacity-50">
                    Masuk
                </button>
            </form>

            @if ($errors->any())
                <div class="mt-4 text-red-500">
                    @foreach ($errors->all() as $error)
                        <p>{{ $error }}</p>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
@endsection
