@extends('layouts.app')

@section('content')
    <div class="container mx-auto mt-3 mb-4">
        <h1 class="text-2xl font-bold mb-6">Create New Course</h1>

        <form action="{{ route('courses.store') }}" method="POST">
            @csrf
            <div class="mb-4">
                <label for="title" class="block text-gray-700">Course Title</label>
                <input type="text"
                    class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                    id="title" name="title" required>
            </div>

            <div class="mb-4">
                <label for="description" class="block text-gray-700">Course Description</label>
                <textarea
                    class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                    id="description" name="description"></textarea>
            </div>

            <div class="mb-4">
                <label for="division_id" class="block text-gray-700">Division</label>
                <select
                    class="block appearance-none w-full bg-gray-200 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                    id="division_id" name="division_id" required>
                    @foreach ($divisions as $division)
                        <option value="{{ $division->id }}">{{ $division->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-4">
                <label for="step_order" class="block text-gray-700">Step Order</label>
                <input type="number"
                    class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                    id="step_order" name="step_order" required>
            </div>

            <button type="submit"
                class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Create</button>
        </form>
    </div>
@endsection
