@extends('layouts.app')

@section('content')
    <div class="container mx-auto mt-3 mb-4">
        <h1 class="text-2xl font-bold mb-6">View Division</h1>

        <div class="mb-4">
            <h2 class="text-lg font-semibold">Division Name</h2>
            <p class="text-gray-700">{{ $division->name }}</p>
        </div>

        <div class="mb-4">
            <h2 class="text-lg font-semibold">Division Description</h2>
            <p class="text-gray-700">{{ $division->description }}</p>
        </div>

        <div class="mt-4 mb-4">
            <a href="{{ route('divisions.edit', $division->id) }}"
                class="bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-2 px-4 rounded">Edit</a>
            <form action="{{ route('divisions.destroy', $division->id) }}" method="POST" class="inline-block">
                @csrf
                @method('DELETE')
                <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded"
                    onclick="return confirm('Are you sure?')">Delete</button>
            </form>
        </div>
    </div>
@endsection
