@extends('layouts.app')

@section('content')
    <div class="container mx-auto mt-3 mb-4">
        <h1 class="text-2xl font-bold mb-6">View User</h1>

        <div class="mb-4">
            <h2 class="text-lg font-semibold">Username</h2>
            <p class="text-gray-700">{{ $user->username }}</p>
        </div>

        <div class="mb-4">
            <h2 class="text-lg font-semibold">Full Name</h2>
            <p class="text-gray-700">{{ $user->full_name }}</p>
        </div>

        <div class="mb-4">
            <h2 class="text-lg font-semibold">Email</h2>
            <p class="text-gray-700">{{ $user->email }}</p>
        </div>

        <div class="mb-4">
            <h2 class="text-lg font-semibold">Role</h2>
            <p class="text-gray-700">{{ ucfirst($user->role) }}</p>
        </div>

        <div class="mb-4">
            <h2 class="text-lg font-semibold">Profile Photo</h2>
            @if ($user->profile_photo_url)
                <img src="{{ $user->profile_photo_url }}" alt="{{ $user->full_name }}" class="w-32 h-32 rounded-full">
            @else
                <p class="text-gray-700">No photo available.</p>
            @endif
        </div>

        <div class="mt-4">
            <a href="{{ route('users.edit', $user->id) }}"
                class="bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-2 px-4 rounded">Edit</a>
            <form action="{{ route('users.destroy', $user->id) }}" method="POST" class="inline-block">
                @csrf
                @method('DELETE')
                <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded"
                    onclick="return confirm('Are you sure?')">Delete</button>
            </form>
        </div>
    </div>
@endsection
