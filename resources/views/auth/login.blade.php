@extends('layouts.app')

@section('content')
    <div class="container mx-auto px-4 py-12 flex justify-center">
        <div class="w-full max-w-md">
            <h2 class="text-2xl font-bold text-center text-blue-600 mb-4">Masuk ke Akun 👇</h2>
            <p class="text-center text-gray-600 mb-8">Masuk ke akun Anda dan temukan beragam pembelajaran baru!</p>
            @if (session('status'))
                <div class="bg-green-100 text-green-800 p-4 rounded mb-4">
                    {{ session('status') }}
                </div>
            @endif

            @if ($errors->any())
                <div class="bg-red-100 text-red-800 p-4 rounded mb-4">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <form action="{{ route('login') }}" method="POST" class="bg-white shadow-md rounded-lg px-8 pt-6 pb-8 mb-4">
                @csrf
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="username">
                        Enter Username
                    </label>
                    <input
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                        id="username" type="text" placeholder="Username" name="username" required>
                </div>
                <div class="mb-6">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="password">
                        Password
                    </label>
                    <input
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline"
                        id="password" type="password" placeholder="******************" name="password" required>
                </div>
                <div class="flex items-center justify-between mb-4">
                    <label class="inline-flex items-center">
                        <input type="checkbox" class="form-checkbox h-5 w-5 text-blue-600">
                        <span class="ml-2 text-gray-600">Remember Me</span>
                    </label>
                    <div class="justify-end items-end text-right">
                        <p class="text-gray-600 ml-0 pl-0 inline-flex">Lupa Password?</p>
                        <a class="inline-block align-baseline font-bold text-sm text-blue-600 hover:text-blue-800"
                            href="#">
                            Klik di Sini
                        </a>
                    </div>
                </div>
                <div class="flex items-center justify-center">
                    <button
                        class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline"
                        type="submit">
                        Login
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
