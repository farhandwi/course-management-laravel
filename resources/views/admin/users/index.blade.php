@extends('layouts.app')

@section('content')
    <div class="container mx-auto mt-3  mb-4">
        <h1 class="text-2xl font-bold mb-6">User Management</h1>

        <div class="mb-6">
            <a href="{{ route('users.create') }}"
                class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                Add New User
            </a>
        </div>

        <form method="GET" action="{{ route('users.index') }}" class="mb-6">
            <div class="flex flex-wrap -mx-3 mb-6">
                <div class="w-full md:w-1/3 px-3 mb-6 md:mb-0">
                    <input type="text" name="search" value="{{ request()->input('search') }}"
                        class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                        placeholder="Search by Username, Email, or Name">
                </div>
                <div class="w-full md:w-1/3 px-3 mb-6 md:mb-0">
                    <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                        Search
                    </button>
                </div>
            </div>
        </form>

        @if ($users->count())
            <div class="overflow-x-auto">
                <table class="min-w-full bg-white border border-gray-200">
                    <thead>
                        <tr>
                            <th class="py-2 px-4 border-b">#</th>
                            <th class="py-2 px-4 border-b">Username</th>
                            <th class="py-2 px-4 border-b">Email</th>
                            <th class="py-2 px-4 border-b">Full Name</th>
                            <th class="py-2 px-4 border-b">Role</th>
                            <th class="py-2 px-4 border-b">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                            <tr>
                                <td class="py-2 px-4 border-b">{{ $user->id }}</td>
                                <td class="py-2 px-4 border-b">{{ $user->username }}</td>
                                <td class="py-2 px-4 border-b">{{ $user->email }}</td>
                                <td class="py-2 px-4 border-b">{{ $user->full_name }}</td>
                                <td class="py-2 px-4 border-b">{{ ucfirst($user->role) }}</td>
                                <td class="py-2 px-4 border-b">
                                    <a href="{{ route('users.show', $user->id) }}"
                                        class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-1 px-2 rounded text-sm">View</a>
                                    <a href="{{ route('users.edit', $user->id) }}"
                                        class="bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-1 px-2 rounded text-sm">Edit</a>
                                    <form action="{{ route('users.destroy', $user->id) }}" method="POST"
                                        class="inline-block">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="bg-red-500 hover:bg-red-700 text-white font-bold py-1 px-2 rounded text-sm"
                                            onclick="return confirm('Are you sure?')">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="mt-4">
                {{ $users->links() }}
            </div>
        @else
            <p class="text-gray-600">No users found.</p>
        @endif
    </div>
@endsection
