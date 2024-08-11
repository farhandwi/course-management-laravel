@extends('layouts.app')

@section('content')
    <div class="container mx-auto mt-3 mb-4">
        <h1 class="text-2xl font-bold mb-6">Division Management</h1>

        <div class="mb-6">
            <a href="{{ route('divisions.create') }}"
                class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                Add New Division
            </a>
        </div>

        @if ($divisions->count())
            <div class="overflow-x-auto mb-4">
                <table class="min-w-full bg-white border border-gray-200">
                    <thead>
                        <tr>
                            <th class="py-2 px-4 border-b">#</th>
                            <th class="py-2 px-4 border-b">Name</th>
                            <th class="py-2 px-4 border-b">Description</th>
                            <th class="py-2 px-4 border-b">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($divisions as $division)
                            <tr>
                                <td class="py-2 px-4 border-b">{{ $division->id }}</td>
                                <td class="py-2 px-4 border-b">{{ $division->name }}</td>
                                <td class="py-2 px-4 border-b">{{ $division->description }}</td>
                                <td class="py-2 px-4 border-b">
                                    <a href="{{ route('divisions.show', $division->id) }}"
                                        class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-1 px-2 rounded text-sm">View</a>
                                    <a href="{{ route('divisions.edit', $division->id) }}"
                                        class="bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-1 px-2 rounded text-sm">Edit</a>
                                    <form action="{{ route('divisions.destroy', $division->id) }}" method="POST"
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
                {{ $divisions->links() }}
            </div>
        @else
            <p class="text-gray-600">No divisions found.</p>
        @endif
    </div>
@endsection
