@extends('layouts.app')

@section('title', 'Login')

@section('content')
    <div class="flex justify-center items-center min-h-screen bg-gray-100">
        <div class="bg-white p-8 rounded-2xl border w-full max-w-md">
            <h2 class="text-2xl font-semibold text-center text-cyan-600">Masuk Admin</h2>
            <p class="text-gray-500 text-center mb-6">Silahkan masuk sebagai <strong>admin</strong> untuk melanjutkan</p>
            <form action="{{ route('login.admin') }}" method="POST">
                @csrf
                <div class="mb-4">
                    <label for="name" class="block text-sm font-medium text-gray-700">Email</label>
                    <input type="text" name="email" placeholder="Masukkan email admin" required
                        class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-cyan-500 focus:border-cyan-500 sm:text-sm">
                </div>

                <div class="mb-4">
                    <label for="nim" class="block text-sm font-medium text-gray-700">Password</label>
                    <input type="password" name="password" placeholder="Masukkan password" required
                        class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-cyan-500 focus:border-cyan-500 sm:text-sm">
                </div>

                <button type="submit"
                    class="w-full py-2 px-4 bg-cyan-600 text-white rounded-lg hover:bg-cyan-700 focus:outline-none focus:ring-2 focus:ring-cyan-500 focus:ring-opacity-50">
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
