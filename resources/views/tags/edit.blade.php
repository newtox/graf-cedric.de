@extends('layouts.app')

@section('content')
    <div class="container mx-auto my-8 p-4 bg-gray-800 shadow-md rounded-lg max-w-md"> <!-- Set max width for container -->
        <h1 class="mb-4 text-center text-xl font-bold text-white">Edit Tag</h1>

        <form action="{{ route('tags.update', $tag->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="name" class="form-label text-gray-300">Tag Name</label>
                <input type="text" class="form-control bg-gray-700 text-white border border-gray-600 focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50" name="name" id="name" value="{{ $tag->name }}" required>
            </div>

            <div class="mb-3">
                <label for="color" class="form-label text-gray-300">Badge Color</label>
                <select class="form-select bg-gray-700 text-white border border-gray-600 focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50" name="color" id="color" required>
                    <option value="bg-red-500" {{ $tag->color == 'bg-red-500' ? 'selected' : '' }}>Light Red</option>
                    <option value="bg-red-600" {{ $tag->color == 'bg-red-600' ? 'selected' : '' }}>Red</option>
                    <option value="bg-red-800" {{ $tag->color == 'bg-red-800' ? 'selected' : '' }}>Dark Red</option>
                    <option value="bg-green-400" {{ $tag->color == 'bg-green-400' ? 'selected' : '' }}>Light Green</option>
                    <option value="bg-green-600" {{ $tag->color == 'bg-green-600' ? 'selected' : '' }}>Green</option>
                    <option value="bg-green-800" {{ $tag->color == 'bg-green-800' ? 'selected' : '' }}>Dark Green</option>
                    <option value="bg-blue-500" {{ $tag->color == 'bg-blue-500' ? 'selected' : '' }}>Light Blue</option>
                    <option value="bg-blue-600" {{ $tag->color == 'bg-blue-600' ? 'selected' : '' }}>Blue</option>
                    <option value="bg-blue-800" {{ $tag->color == 'bg-blue-800' ? 'selected' : '' }}>Dark Blue</option>
                    <option value="bg-yellow-300" {{ $tag->color == 'bg-yellow-300' ? 'selected' : '' }}>Light Yellow</option>
                    <option value="bg-yellow-500" {{ $tag->color == 'bg-yellow-500' ? 'selected' : '' }}>Yellow</option>
                    <option value="bg-gray-400" {{ $tag->color == 'bg-gray-400' ? 'selected' : '' }}>Light Grey</option>
                    <option value="bg-gray-500" {{ $tag->color == 'bg-gray-500' ? 'selected' : '' }}>Grey</option>
                    <option value="bg-gray-700" {{ $tag->color == 'bg-gray-700' ? 'selected' : '' }}>Dark Grey</option>
                    <option value="bg-purple-400" {{ $tag->color == 'bg-purple-400' ? 'selected' : '' }}>Light Purple</option>
                    <option value="bg-purple-600" {{ $tag->color == 'bg-purple-600' ? 'selected' : '' }}>Purple</option>
                    <option value="bg-purple-900" {{ $tag->color == 'bg-purple-900' ? 'selected' : '' }}>Dark Purple</option>
                    <option value="bg-indigo-600" {{ $tag->color == 'bg-indigo-600' ? 'selected' : '' }}>Indigo</option>
                    <option value="bg-pink-600" {{ $tag->color == 'bg-indigo-600' ? 'selected' : '' }}>Pink</option>
                </select>
            </div>

            <div class="mt-3">
                <span id="selectedBadge" class="inline-block px-2 py-1 text-xs font-semibold text-white rounded-full {{ $tag->color }}">Selected Color</span>
            </div>

            <button type="submit" class="mt-3 bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded">Update Tag</button>
        </form>

        <script>
            document.getElementById('color').addEventListener('change', function() {
                var badge = document.getElementById('selectedBadge');
                badge.className = 'inline-block px-2 py-1 text-xs font-semibold text-white rounded-full ' + this.value; // Update badge class based on selected value
                badge.textContent = this.options[this.selectedIndex].text; // Update badge text
            });
        </script>
    </div>
@endsection
