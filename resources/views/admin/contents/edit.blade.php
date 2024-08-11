@extends('layouts.app')

@section('content')
    <div class="container mx-auto mb-4 mt-4">
        <h1 class="text-2xl font-bold mb-6">Edit Content for Course: {{ $content->course->title }}</h1>

        <form action="{{ route('contents.update', $content->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-4">
                <label for="title" class="block text-gray-700">Content Title</label>
                <input type="text"
                    class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                    id="title" name="title" value="{{ $content->title }}" required>
            </div>

            <div class="mb-4">
                <label for="content" class="block text-gray-700">Content</label>
                <textarea
                    class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                    id="content" name="content" required>{{ $content->content }}</textarea>
            </div>

            <div class="mb-4">
                <label for="step_order" class="block text-gray-700">Step Order</label>
                <input type="number"
                    class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                    id="step_order" name="step_order" value="{{ $content->step_order }}" required>
            </div>

            <button type="submit"
                class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Update</button>
        </form>
    </div>
@endsection
