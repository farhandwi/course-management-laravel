@extends('layouts.app')

@section('content')
    <div class="container mx-auto px-4 py-12 flex justify-center">
        <div class="w-full max-w-md">
            <h2 class="text-2xl font-bold text-center text-blue-600 mb-4">Buat Akun 📝</h2>
            <p class="text-center text-gray-600 mb-8">Buat akun Anda dan temukan beragam pembelajaran baru!</p>
            @if ($errors->any())
                <div class="bg-red-100 text-red-800 p-4 rounded mb-4">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <form action="{{ route('register') }}" method="POST" class="bg-white shadow-md rounded-lg px-8 pt-6 pb-8 mb-4">
                @csrf
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="username">
                        Username
                    </label>
                    <input
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                        id="username" type="text" name="username" placeholder="Username" required>
                </div>
                <div class="flex space-x-2 mb-4">
                    <div class="w-1/2">
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="first_name">
                            First Name
                        </label>
                        <input
                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                            id="first_name" type="text" name="first_name" placeholder="First Name" required>
                    </div>
                    <div class="w-1/2">
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="last_name">
                            Last Name
                        </label>
                        <input
                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                            id="last_name" type="text" name="last_name" placeholder="Last Name" required>
                    </div>
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="email">
                        Email
                    </label>
                    <input
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                        id="email" type="email" name="email" placeholder="Email" required>
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="password">
                        Password
                    </label>
                    <div class="relative">
                        <input
                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                            id="password" type="password" name="password" placeholder="Password" required>
                    </div>
                </div>
                <div class="mb-6">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="password_confirmation">
                        Confirm Password
                    </label>
                    <div class="relative">
                        <input
                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                            id="password_confirmation" type="password" name="password_confirmation"
                            placeholder="Confirm Password" required>
                    </div>
                </div>
                <div class="flex items-center justify-center">
                    <button
                        class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-full focus:outline-none focus:shadow-outline"
                        type="submit">
                        Register
                    </button>
                </div>
            </form>
            <p class="text-center text-gray-600">Sudah Punya Akun? <a href="{{ route('login') }}"
                    class="text-blue-600">Login di sini</a></p>
        </div>
    </div>
@endsection
