@extends('layouts.app')

@section('content')
    <div class="container mx-auto mt-3 mb-4">
        <h1 class="text-2xl font-bold mb-6">Create New User</h1>

        <form action="{{ route('users.store') }}" method="POST">
            @csrf
            <div class="mb-4">
                <label for="username" class="block text-gray-700">Username</label>
                <input type="text"
                    class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                    id="username" name="username" required>
            </div>

            <div class="mb-4">
                <label for="first_name" class="block text-gray-700">First Name</label>
                <input type="text"
                    class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                    id="first_name" name="first_name" required>
            </div>

            <div class="mb-4">
                <label for="last_name" class="block text-gray-700">Last Name</label>
                <input type="text"
                    class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                    id="last_name" name="last_name" required>
            </div>

            <div class="mb-4">
                <label for="email" class="block text-gray-700">Email</label>
                <input type="email"
                    class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                    id="email" name="email" required>
            </div>

            <div class="mb-4">
                <label for="password" class="block text-gray-700">Password</label>
                <input type="password"
                    class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                    id="password" name="password" required>
            </div>

            <div class="mb-4">
                <label for="password_confirmation" class="block text-gray-700">Confirm Password</label>
                <input type="password"
                    class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                    id="password_confirmation" name="password_confirmation" required>
            </div>

            <div class="mb-4">
                <label for="role" class="block text-gray-700">Role</label>
                <select
                    class="block appearance-none w-full bg-gray-200 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                    id="role" name="role" required>
                    <option value="user">User</option>
                    <option value="admin">Admin</option>
                </select>
            </div>

            <div class="mb-4">
                <label for="profile_photo_url" class="block text-gray-700">Profile Photo URL</label>
                <input type="url"
                    class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                    id="profile_photo_url" name="profile_photo_url">
            </div>

            <button type="submit"
                class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Create</button>
        </form>
    </div>
@endsection
