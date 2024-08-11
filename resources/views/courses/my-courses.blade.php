@extends('layouts.app')

@section('content')
    <div class="container mx-auto mt-6">
        <h1 class="text-3xl font-bold mb-6 text-center items-center">Selesaikan Semua Kelas dan Jadilah Juara 🏆</h1>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @forelse($courses as $course)
                <div class="bg-white shadow-md rounded-lg overflow-hidden">
                    <div class="p-4">
                        <img src="{{ $course->photo }}" alt="{{ $course->title }}" class="w-full h-32 object-cover rounded-lg">
                        <div class="mt-4">
                            <h3 class="text-lg font-semibold">{{ Str::limit($course->title, 50) }}</h3>
                            <p class="mt-2 text-gray-600">{{ Str::limit($course->description, 100) }}</p>
                            <p class="mt-4 text-blue-500">{{ $course->contents->count() }} Materi</p>
                        </div>
                        <div class="mt-4">
                            <a href="{{ route('course-detail', $course->id) }}"
                                class="block bg-blue-500 text-white text-center py-2 rounded-lg">Lanjutkan Kelas</a>
                        </div>
                    </div>
                </div>
            @empty
                <p class="text-gray-600">Anda belum mengambil kursus apapun.</p>
            @endforelse
        </div>
    </div>
@endsection
