@extends('layouts.app')

@section('content')
    <div class="container mx-auto mt-6">
        <div class="text-center">
            <h1 class="text-3xl font-bold">Semua Course</h1>
            <p class="text-gray-500">{{ $courseCount }} Topik Pembelajaran</p>
            <p class="mt-4 text-gray-600">Lihat semua topik pembelajaran dari beragam kategori di sini!</p>
        </div>

        <div class="flex justify-between items-center mt-8">
            <form method="GET" action="{{ route('courses.index') }}" class="w-full flex space-x-4">
                <div class="flex items-center w-1/2">
                    <select id="division_id" name="division_id"
                        class="block appearance-none w-full bg-white border border-gray-200 text-gray-700 py-2 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500">
                        <option value="">Semua Divisi</option>
                        @foreach ($divisions as $division)
                            <option value="{{ $division->id }}"
                                {{ request()->input('division_id') == $division->id ? 'selected' : '' }}>
                                {{ $division->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="relative w-1/2">
                    <input type="text" name="search" placeholder="Cari Course" value="{{ request()->input('search') }}"
                        class="block w-full pl-10 pr-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-400">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                            xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M21 21l-4.35-4.35m0 0a7.5 7.5 0 10-10.6 0 7.5 7.5 0 0010.6 0z"></path>
                        </svg>
                    </div>
                </div>

                <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                    Cari
                </button>
            </form>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mt-8">
            @foreach ($courses as $course)
                <div class="bg-white shadow-md rounded-lg overflow-hidden">
                    <img src="{{ $course->photo }}" alt="{{ $course->title }}" class="w-full h-32 object-cover">
                    <div class="p-4">
                        <h3 class="text-lg font-semibold">{{ Str::limit($course->title, 40) }}</h3>
                        <p class="mt-2 text-gray-600">{{ Str::limit($course->description, 100) }}</p>
                        <p class="mt-4 text-blue-500">{{ $course->contents_count }} Materi</p>
                        <button
                            class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mt-4 registerButton"
                            data-course-id="{{ $course->id }}" data-course-title="{{ $course->title }}"
                            data-course-image="{{ $course->photo }}">
                            Daftar Kelas
                        </button>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="mt-8">
            {{ $courses->withQueryString()->links() }}
        </div>
    </div>

    <!-- Modal HTML -->
    <div id="registerModal" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 hidden">
        <div class="bg-white rounded-lg shadow-lg p-6 w-96">
            <h2 class="text-xl font-bold mb-4">Konfirmasi Pendaftaran Kelas</h2>
            <p class="text-gray-600 mb-6">Apakah Anda yakin ingin mendaftar untuk kursus ini?</p>
            <div id="coursePreview" class="mb-4">
                <!-- Preview dari course akan ditambahkan di sini melalui JavaScript -->
            </div>
            <div class="flex justify-between">
                <button id="cancelButton" class="bg-gray-500 text-white py-2 px-4 rounded">Batal</button>
                <form id="registerForm" method="POST" action="#">
                    @csrf
                    <button type="submit" class="bg-blue-500 text-white py-2 px-4 rounded">Daftar Kelas</button>
                </form>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const registerModal = document.getElementById('registerModal');
            const cancelButton = document.getElementById('cancelButton');
            const coursePreview = document.getElementById('coursePreview');
            const registerForm = document.getElementById('registerForm');

            document.querySelectorAll('.registerButton').forEach(button => {
                button.addEventListener('click', function(event) {
                    event.preventDefault();

                    @if (auth()->check())
                        const courseId = this.getAttribute('data-course-id');
                        const courseTitle = this.getAttribute('data-course-title');
                        const courseImage = this.getAttribute('data-course-image');
                        const courseLink = "{{ route('courses.register', ':id') }}".replace(':id',
                            courseId);

                        // Set the action of the form to the correct URL
                        registerForm.action = courseLink;

                        // Update the course preview in the modal
                        coursePreview.innerHTML = `
                        <img src="${courseImage}" alt="${courseTitle}" class="w-full h-32 object-cover mb-4">
                        <h3 class="text-lg font-semibold">${courseTitle}</h3>
                    `;

                        // Show the modal
                        registerModal.classList.remove('hidden');
                    @else
                        window.location.href = "{{ route('login') }}";
                    @endif
                });
            });

            cancelButton.addEventListener('click', function() {
                registerModal.classList.add('hidden');
            });
        });
    </script>
@endsection
