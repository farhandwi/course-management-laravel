@extends('layouts.app')

@section('content')
    <div class="container mx-auto mt-6">
        <nav class="mb-4">
            <a href="{{ route('courses.my') }}" class="text-blue-600">Home</a> /
            <span class="text-gray-600">Course / Detail</span>
        </nav>
        <div class="flex">
            <div class="w-full lg:w-1/4">
                @foreach ($contentsWithPivot as $index => $content)
                    @php
                        $previousCompleted =
                            $index === 0 || ($contentsWithPivot[$index - 1]->pivot->completed ?? false);
                        $disabled = !$previousCompleted ? 'opacity-50 cursor-not-allowed' : '';
                        $progress = $content->pivot->completed ?? 0;
                    @endphp
                    <div class="mb-4">
                        <div class="p-4 bg-white shadow rounded-lg {{ $disabled }}">
                            <div class="flex justify-between items-center">
                                <span class="text-lg font-bold">Step {{ $index + 1 }}</span>
                                <span>{{ $progress * 100 }}%</span>
                            </div>
                            <p class="mt-2 text-gray-600">{{ $content->title }}</p>
                            @if ($previousCompleted)
                                <a href="{{ route('content-detail', [$course->id, $content->id]) }}"
                                    class="block mt-4 bg-blue-500 text-white text-center py-2 rounded-lg">Mulai</a>
                            @else
                                <span class="block mt-4 bg-gray-500 text-white text-center py-2 rounded-lg">Terkunci</span>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="w-full lg:w-3/4 pl-6">
                <img src="{{ $course->photo }}" alt="{{ $course->title }}"
                    class="w-full h-64 object-cover rounded-lg shadow-md">
                <h1 class="text-3xl font-bold mt-6">{{ $course->title }}</h1>
                <p class="mt-4 text-gray-700">{{ $course->description }}</p>
            </div>
        </div>
    </div>
@endsection
