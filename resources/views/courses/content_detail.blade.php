@extends('layouts.app')

@section('content')
    <div class="container mx-auto mt-6">
        <nav class="mb-4">
            <a href="{{ route('courses.my') }}" class="text-blue-600">Home</a> /
            <a href="{{ route('course-detail', $course->id) }}" class="text-blue-600">{{ $course->title }}</a> /
            <span class="text-gray-600">{{ $content->title }}</span>
        </nav>

        <div class="bg-white shadow-md rounded-lg p-6">
            <h1 class="text-3xl font-bold mb-4">{{ $content->title }}</h1>
            <p class="text-gray-700 mb-6">{{ $content->description }}</p>

            <div class="prose">
                {!! $content->body !!} <!-- Body dari konten bisa berupa HTML -->
            </div>

            <div class="mt-6 flex justify-between">
                @if ($previousContent)
                    <a href="{{ route('content-detail', [$course->id, $previousContent->id]) }}"
                        class="bg-gray-500 text-white py-2 px-4 rounded-lg">Sebelumnya</a>
                @endif

                <form action="{{ route('complete-content', [$course->id, $content->id]) }}" method="POST">
                    @csrf
                    <button type="submit" class="bg-blue-500 text-white py-2 px-4 rounded-lg">Tandai Selesai</button>
                </form>

                {{-- @dd(route('complete-content', [$course->id, $content->id])); --}}


                @if ($nextContent)
                    <a href="{{ route('content-detail', [$course->id, $nextContent->id]) }}"
                        class="bg-blue-500 text-white py-2 px-4 rounded-lg">Lanjutkan</a>
                @endif
            </div>
        </div>
    </div>
@endsection
