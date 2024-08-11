@extends('layouts.app')

@section('content')
    <div class="container mx-auto mt-3 mb-4">
        <h1 class="text-2xl font-bold mb-6">Course Management</h1>

        <div class="mb-6">
            <a href="{{ route('courses.create') }}"
                class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                Add New Course
            </a>
        </div>

        <form method="GET" action="{{ route('courses.index') }}" class="mb-6">
            <div class="flex flex-wrap -mx-3 mb-6">
                <div class="w-full md:w-1/3 px-3 mb-6 md:mb-0">
                    <input type="text" name="search" value="{{ request()->input('search') }}"
                        class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                        placeholder="Search by Title">
                </div>
                <div class="w-full md:w-1/3 px-3 mb-6 md:mb-0">
                    <select name="division_id"
                        class="block appearance-none w-full bg-gray-200 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500">
                        <option value="">All Divisions</option>
                        @foreach ($divisions as $division)
                            <option value="{{ $division->id }}"
                                {{ request()->input('division_id') == $division->id ? 'selected' : '' }}>
                                {{ $division->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="w-full md:w-1/3 px-3 mb-6 md:mb-0">
                    <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                        Search
                    </button>
                </div>
            </div>
        </form>

        @if ($courses->count())
            <div class="overflow-x-auto">
                <table class="min-w-full bg-white border border-gray-200">
                    <thead>
                        <tr>
                            <th class="py-2 px-4 border-b">#</th>
                            <th class="py-2 px-4 border-b">Title</th>
                            <th class="py-2 px-4 border-b">Division</th>
                            <th class="py-2 px-4 border-b">Step Order</th>
                            <th class="py-2 px-4 border-b">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($courses as $course)
                            <tr>
                                <td class="py-2 px-4 border-b">{{ $course->id }}</td>
                                <td class="py-2 px-4 border-b">{{ $course->title }}</td>
                                <td class="py-2 px-4 border-b">{{ $course->division->name }}</td>
                                <td class="py-2 px-4 border-b">{{ $course->step_order }}</td>
                                <td class="py-2 px-4 border-b">
                                    <a href="{{ route('courses.show', $course->id) }}"
                                        class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-1 px-2 rounded text-sm">View</a>
                                    <a href="{{ route('courses.edit', $course->id) }}"
                                        class="bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-1 px-2 rounded text-sm">Edit</a>
                                    <a href="{{ route('courses.contents.index', $course->id) }}"
                                        class="bg-green-500 hover:bg-green-700 text-white font-bold py-1 px-2 rounded text-sm">Manage
                                        Contents</a>
                                    <form action="{{ route('courses.destroy', $course->id) }}" method="POST"
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
                {{ $courses->links() }}
            </div>
        @else
            <p class="text-gray-600">No courses found.</p>
        @endif
    </div>
@endsection
