@extends('layouts.app')

@section('content')
    <div class="container mx-auto my-8 p-6 bg-gray-800 shadow-md rounded-lg">
        <h1 class="mb-4 text-center text-2xl font-bold text-white">Create Game</h1>

        <form action="{{ route('games.store') }}" method="POST" enctype="multipart/form-data" class="bg-gray-700 p-4 rounded">
            @csrf

            @if ($errors->any())
                <div class="mb-4 text-red-500">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="mb-4">
                <label for="name" class="block text-sm font-medium text-gray-300">Game Name</label>
                <input type="text" name="name" id="name" required placeholder="Enter game name"
                       class="mt-1 block w-full p-2 rounded-md border border-gray-600 bg-gray-800 text-white" />
            </div>

            <div class="mb-4">
                <label for="thumbnail_image" class="block text-sm font-medium text-gray-300">Thumbnail Image</label>
                <input type="file" name="thumbnail_image" id="thumbnail_image"
                       class="mt-1 block w-full p-2 rounded-md border border-gray-600 bg-gray-800 text-white" />
            </div>

            <div class="mb-4">
                <label for="publisher_name" class="block text-sm font-medium text-gray-300">Publisher Name</label>
                <input type="text" name="publisher_name" id="publisher_name" required placeholder="Enter publisher name"
                       class="mt-1 block w-full p-2 rounded-md border border-gray-600 bg-gray-800 text-white" />
            </div>

            <div class="mb-4">
                <label for="developer_name" class="block text-sm font-medium text-gray-300">Developer Name</label>
                <input type="text" name="developer_name" id="developer_name" required placeholder="Enter developer name"
                       class="mt-1 block w-full p-2 rounded-md border border-gray-600 bg-gray-800 text-white" />
            </div>

            <div class="mb-4">
                <label for="publisher_image" class="block text-sm font-medium text-gray-300">Publisher Image</label>
                <input type="file" name="publisher_image" id="publisher_image"
                       class="mt-1 block w-full p-2 rounded-md border border-gray-600 bg-gray-800 text-white" />
            </div>

            <div class="mb-4">
                <label for="developer_image" class="block text-sm font-medium text-gray-300">Developer Image</label>
                <input type="file" name="developer_image" id="developer_image"
                       class="mt-1 block w-full p-2 rounded-md border border-gray-600 bg-gray-800 text-white" />
            </div>

            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-300">Tags</label>
                <div class="relative mt-2">
                    <input type="text" id="tagSearch" placeholder="Search tags..."
                           class="block w-full p-2 rounded-md border border-gray-600 bg-gray-800 text-white focus:border-blue-500 focus:ring-blue-500"
                           oninput="filterTags()" />
                </div>
                <div id="tagList" class="mt-2 space-y-2 max-h-60 overflow-y-auto p-2 bg-gray-700 rounded-md border border-gray-600">
                    @foreach($tags as $tag)
                        <div class="flex items-center">
                            <input type="checkbox" name="tags[]" value="{{ $tag->id }}" id="tag-{{ $tag->id }}"
                                   class="hidden" onclick="toggleTag(this, '{{ $tag->color }}')">
                            <label for="tag-{{ $tag->id }}"
                                   class="flex items-center justify-center h-10 px-4 rounded-md border border-gray-600 text-gray-200
                                   transition-colors duration-200 cursor-pointer bg-gray-800">
                                {{ ucfirst($tag->name) }}
                            </label>
                        </div>
                    @endforeach
                </div>
            </div>

            <button type="submit" class="mt-4 w-full bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 rounded">
                Create Game
            </button>
        </form>
    </div>

    <script>
        function toggleTag(checkbox, color) {
            const label = document.querySelector(`label[for='${checkbox.id}']`);
            if (checkbox.checked) {
                label.classList.add(color); // Change background to tag color
                label.classList.remove('bg-gray-800'); // Remove default color
            } else {
                label.classList.remove(color); // Reset color
                label.classList.add('bg-gray-800'); // Revert to default
            }
        }

        function filterTags() {
            const input = document.getElementById('tagSearch');
            const filter = input.value.toLowerCase();
            const tagList = document.getElementById('tagList');
            const tags = tagList.getElementsByTagName('label');

            for (let i = 0; i < tags.length; i++) {
                const tagText = tags[i].innerText.toLowerCase();
                if (tagText.includes(filter)) {
                    tags[i].parentElement.style.display = ''; // Show the parent element (the div)
                } else {
                    tags[i].parentElement.style.display = 'none'; // Hide the parent element (the div)
                }
            }
        }
    </script>
@endsection
