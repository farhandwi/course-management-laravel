@extends('layouts.app')

@section('content')
    <div class="container mx-auto mt-3 mb-4">
        <h1 class="text-2xl font-bold mb-6">View Course</h1>

        <div class="mb-4">
            <h2 class="text-lg font-semibold">Course Title</h2>
            <p class="text-gray-700">{{ $course->title }}</p>
        </div>

        <div class="mb-4">
            <h2 class="text-lg font-semibold">Course Description</h2>
            <p class="text-gray-700">{{ $course->description }}</p>
        </div>

        <div class="mb-4">
            <h2 class="text-lg font-semibold">Course Photo</h2>
            @if ($course->photo)
                <img src="{{ $course->photo }}" alt="{{ $course->title }}" class="w-64 h-auto">
            @else
                <p class="text-gray-700">No photo available.</p>
            @endif
        </div>

        <div class="mb-4">
            <h2 class="text-lg font-semibold">Division</h2>
            <p class="text-gray-700">{{ $course->division->name }}</p>
        </div>

        <div class="mb-4">
            <h2 class="text-lg font-semibold">Step Order</h2>
            <p class="text-gray-700">{{ $course->step_order }}</p>
        </div>

        <div class="mt-10 mb-5">
            <a href="{{ route('courses.edit', $course->id) }}"
                class="bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-2 px-4 rounded">Edit</a>
            <form action="{{ route('courses.destroy', $course->id) }}" method="POST" class="inline-block">
                @csrf
                @method('DELETE')
                <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded"
                    onclick="return confirm('Are you sure?')">Delete</button>
            </form>
        </div>
    </div>
@endsection
