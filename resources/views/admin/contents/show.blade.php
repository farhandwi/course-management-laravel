@extends('layouts.app')

@section('content')
    <div class="container mx-auto mb-4">
        <h1 class="text-2xl font-bold mb-6">View Content for Course: {{ $content->course->title }}</h1>

        <div class="mb-4">
            <h2 class="text-lg font-semibold">Content Title</h2>
            <p class="text-gray-700">{{ $content->title }}</p>
        </div>

        <div class="mb-4">
            <h2 class="text-lg font-semibold">Content</h2>
            <p class="text-gray-700">{{ $content->content }}</p>
        </div>

        <div class="mb-4">
            <h2 class="text-lg font-semibold">Step Order</h2>
            <p class="text-gray-700">{{ $content->step_order }}</p>
        </div>

        <div class="mt-4">
            <a href="{{ route('contents.edit', $content->id) }}"
                class="bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-2 px-4 rounded">Edit</a>
            <form action="{{ route('contents.destroy', $content->id) }}" method="POST" class="inline-block">
                @csrf
                @method('DELETE')
                <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded"
                    onclick="return confirm('Are you sure?')">Delete</button>
            </form>
        </div>
    </div>
@endsection
