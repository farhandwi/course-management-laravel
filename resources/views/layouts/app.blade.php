<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <link href="{{ mix('css/app.css') }}" rel="stylesheet">
    @vite('resources/css/app.css')
</head>

<body class="bg-gray-100 font-sans antialiased">
    <div class="min-h-screen flex flex-col">
        <!-- Navigation -->
        <nav class="bg-white shadow-md py-4">
            <div class="container mx-auto px-4 flex justify-between items-center">
                <div class="flex items-center space-x-4">
                    <button id="hamburger-btn" class="md:hidden focus:outline-none">
                        <svg class="w-6 h-6 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                            xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 6h16M4 12h16m-7 6h7"></path>
                        </svg>
                    </button>
                    <a href="#">
                        <img src="https://learning.detik.com/frontpage/assets/images/navbar/logo.png" alt="Logo"
                            class="h-4">
                    </a>
                </div>
                <div class="flex items-center space-x-4">
                    @auth
                        @if (Auth::user()->role === 'user')
                            <a href="{{ route('user.courses.index') }}"
                                class="hidden md:block text-gray-600 hover:text-blue-600 border-b-2 border-transparent hover:border-blue-600">All
                                Course</a>
                            <a href="{{ route('courses.my') }}" class="hidden md:block text-gray-600 hover:text-blue-600">My
                                Course</a>
                        @endif

                        @if (Auth::user()->role === 'admin')
                            <a href="{{ route('users.index') }}"
                                class="hidden md:block text-gray-600 hover:text-blue-600 border-b-2 border-transparent hover:border-blue-600">Users</a>
                            <a href="{{ route('courses.index') }}"
                                class="hidden md:block text-gray-600 hover:text-blue-600 border-b-2 border-transparent hover:border-blue-600">Courses</a>
                            <a href="{{ route('divisions.index') }}"
                                class="hidden md:block text-gray-600 hover:text-blue-600 border-b-2 border-transparent hover:border-blue-600">Divisions</a>
                            <a href="{{ route('admin.dashboard') }}"
                                class="hidden md:block text-gray-600 hover:text-blue-600 border-b-2 border-transparent hover:border-blue-600">Dashboard</a>
                        @endif

                        <div class="relative">
                            <button id="profile-dropdown" class="focus:outline-none">
                                <img src="{{ Auth::user()->profile_photo_url ?? '/icon/profile.png' }}" alt="Profile"
                                    class="rounded-full h-8 w-8">
                            </button>
                            <div id="profile-menu" class="hidden absolute right-0 mt-2 w-48 bg-white shadow-md rounded-lg">
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit"
                                        class="block w-full text-left px-4 py-2 text-gray-600 hover:bg-gray-100">Logout</button>
                                </form>
                            </div>
                        </div>
                    @else
                        <a href="{{ route('register') }}"
                            class="text-blue-600 border border-blue-600 rounded-2xl px-4 py-2 hover:bg-blue-600 hover:text-white transition">Register</a>
                        <a href="{{ route('login') }}" class="text-white bg-blue-600 rounded-2xl px-4 py-2">Login</a>
                    @endauth
                </div>
            </div>

            <!-- Mobile Menu -->
            <div id="mobile-menu" class="hidden md:hidden bg-white">
                <div class="flex justify-center mt-2">
                    <input type="text" placeholder="Cari Course"
                        class="w-11/12 max-w-xs rounded-full bg-gray-100 px-4 py-2 text-sm">
                </div>

                @auth
                    @if (Auth::user()->role === 'user')
                        <a href="{{ route('user.courses.index') }}" class="block px-4 py-2 text-blue-600">All Course</a>
                        <a href="{{ route('courses.my') }}" class="block px-4 py-2 text-gray-600">My Course</a>
                    @endif

                    @if (Auth::user()->role === 'admin')
                        <a href="{{ route('admin.dashboard') }}" class="block px-4 py-2 text-gray-600">Dashboard</a>
                    @endif

                    <div class="border-t mt-2">
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit"
                                class="block w-full text-left px-4 py-2 text-gray-600 hover:bg-gray-100">Logout</button>
                        </form>
                    </div>
                @endauth
            </div>
        </nav>

        <!-- Page Content -->
        <main class="flex-grow">
            @yield('content')
        </main>

        <!-- Footer -->
        <footer class="bg-white shadow-md py-6">
            <div class="container mx-auto px-4">
                <div class="flex flex-col md:flex-row justify-between items-center">
                    <div class="flex items-center space-x-2">
                        <img src="https://learning.detik.com/frontpage/assets/images/navbar/logo.png"
                            alt="detikcom logo" class="h-10">
                    </div>
                    <div class="hidden md:flex space-x-8">
                        <a href="#" class="text-blue-600">All Course</a>
                        <a href="#" class="text-blue-600">My Course</a>
                        <a href="#" class="text-blue-600">Dashboard</a>
                    </div>
                </div>
                <div class="flex justify-start space-x-4 mt-6">
                    <a href="#"><img src="/icon/facebook.png" alt="Facebook" class="h-8"></a>
                    <a href="#"><img src="/icon/twitter.png" alt="Twitter" class="h-8"></a>
                    <a href="#"><img src="/icon/instagram.png" alt="Instagram" class="h-8"></a>
                    <a href="#"><img src="/icon/linkedin.png" alt="LinkedIn" class="h-8"></a>
                    <a href="#"><img src="/icon/youtube.png" alt="YouTube" class="h-8"></a>
                </div>
                <div class="md:hidden flex justify-center space-x-8 mt-6">
                    <a href="#" class="text-blue-600">All Course</a>
                    <a href="#" class="text-blue-600">My Course</a>
                    <a href="#" class="text-blue-600">Dashboard</a>
                </div>
            </div>
            <div class="container mx-auto text-center mt-6">
                <p class="text-gray-600">Copyright © 2024 detik.com Learning. All rights reserved.</p>
            </div>
        </footer>

    </div>

    <script>
        document.getElementById('hamburger-btn').addEventListener('click', function() {
            var menu = document.getElementById('mobile-menu');
            menu.classList.toggle('hidden');
        });

        document.getElementById('profile-dropdown').addEventListener('click', function() {
            var menu = document.getElementById('profile-menu');
            menu.classList.toggle('hidden');
        });
    </script>
</body>

</html>
