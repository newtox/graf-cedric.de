@extends('layouts.app')

@section('content')
    <div class="container mx-auto my-8 p-4 bg-gray-800 shadow-md rounded-lg max-w-md"> <!-- Set max width for container -->
        <h1 class="mb-4 text-center text-xl font-bold text-white">Create Tag</h1>

        <form action="{{ route('tags.store') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label for="name" class="form-label text-gray-300">Tag Name</label>
                <input type="text" class="form-control bg-gray-700 text-white border border-gray-600 focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50" name="name" id="name" required placeholder="Enter tag name">
            </div>

            <div class="mb-3">
                <label for="color" class="form-label text-gray-300">Badge Color</label>
                <select class="form-select bg-gray-700 text-white border border-gray-600 focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50" name="color" id="color" required>
                    <option value="bg-red-600">Red</option>
                    <option value="bg-green-600">Green</option>
                    <option value="bg-blue-600">Blue</option>
                    <option value="bg-yellow-500">Yellow</option>
                    <option value="bg-gray-500">Grey</option>
                    <option value="bg-purple-600">Purple</option>
                    <option value="bg-indigo-600">Indigo</option>
                    <option value="bg-pink-600">Pink</option>
                </select>
            </div>

            <div class="mt-3">
                <span id="selectedBadge" class="inline-block px-2 py-1 text-xs font-semibold text-white rounded-full bg-red-600">Red</span>
            </div>

            <button type="submit" class="mt-3 bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded">Create Tag</button>
        </form>

        <script>
            document.getElementById('color').addEventListener('change', function() {
                var badge = document.getElementById('selectedBadge');
                badge.className = 'inline-block px-2 py-1 text-xs font-semibold text-white rounded-full ' + this.value;
                badge.textContent = this.options[this.selectedIndex].text; // Update badge text
            });
        </script>
    </div>
@endsection
