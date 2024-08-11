@extends('layouts.app')

@section('content')
    <div class="container mx-auto mt-4 mb-4">
        <h1 class="text-2xl font-bold mb-6">Manage Content for Course: {{ $course->title }}</h1>

        <div class="mb-6">
            <a href="{{ route('courses.contents.create', $course->id) }}"
                class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                Add New Content
            </a>
        </div>

        @if ($contents->count())
            <div class="overflow-x-auto">
                <table class="min-w-full bg-white border border-gray-200">
                    <thead>
                        <tr>
                            <th class="py-2 px-4 border-b">#</th>
                            <th class="py-2 px-4 border-b">Title</th>
                            <th class="py-2 px-4 border-b">Step Order</th>
                            <th class="py-2 px-4 border-b">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($contents as $content)
                            <tr>
                                <td class="py-2 px-4 border-b">{{ $content->id }}</td>
                                <td class="py-2 px-4 border-b">{{ $content->title }}</td>
                                <td class="py-2 px-4 border-b">{{ $content->step_order }}</td>
                                <td class="py-2 px-4 border-b">
                                    <a href="{{ route('contents.show', $content->id) }}"
                                        class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-1 px-2 rounded text-sm">View</a>
                                    <a href="{{ route('contents.edit', $content->id) }}"
                                        class="bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-1 px-2 rounded text-sm">Edit</a>
                                    <form action="{{ route('contents.destroy', $content->id) }}" method="POST"
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
                {{ $contents->links() }}
            </div>
        @else
            <p class="text-gray-600">No content found for this course.</p>
        @endif
    </div>
@endsection
