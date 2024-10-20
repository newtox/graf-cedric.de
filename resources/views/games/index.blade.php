@extends('layouts.app')

@section('content')
    <div class="container mx-auto my-8 p-6 bg-gray-800 shadow-md rounded-lg">
        <h1 class="mb-4 text-center text-xl font-bold text-white">Games</h1>

        <div class="flex flex-col sm:flex-row justify-between mb-4 space-y-2 sm:space-y-0 sm:space-x-4">
            <form action="{{ route('games.index') }}" method="GET" class="flex items-center flex-1">
                <input type="text" name="search" placeholder="Search..."
                       class="px-4 py-2 rounded-lg bg-gray-700 text-white border border-gray-600 sm:w-80 md:w-64 lg:w-48" />
                <button type="submit" class="ml-2 px-4 py-2 bg-blue-500 hover:bg-blue-600 text-white rounded-lg">Search</button>
            </form>

            <div class="relative flex-shrink-0 sm:ml-2">
                <button id="tag-filter-toggle" class="px-4 py-2 bg-blue-500 hover:bg-blue-600 text-white rounded-lg">Filter by Tags</button>
                <div id="tag-filter-options" class="hidden mt-2 bg-gray-700 rounded-lg shadow-lg p-4 absolute z-10">
                    <form action="{{ route('games.index') }}" method="GET" class="space-y-2">
                        @foreach($tags as $tag)
                            <div class="flex items-center">
                                <input type="checkbox" name="tags[]" value="{{ $tag->id }}" id="tag-{{ $tag->id }}"
                                       class="hidden" data-color="{{ $tag->color }}"
                                    {{ request()->input('tags') && in_array($tag->id, request()->input('tags')) ? 'checked' : '' }}>
                                <label for="tag-{{ $tag->id }}"
                                       class="flex items-center cursor-pointer px-3 py-1 rounded-md border border-gray-600
                            {{ request()->input('tags') && in_array($tag->id, request()->input('tags')) ? $tag->color : 'bg-gray-700' }}">
                                    {{ ucfirst($tag->name) }}
                                </label>
                            </div>
                        @endforeach
                        <button type="submit" class="mt-2 px-4 py-2 bg-blue-500 hover:bg-blue-600 text-white rounded-lg">Apply Filter</button>
                    </form>
                </div>
            </div>
        </div>


        <table class="min-w-full divide-y divide-gray-600">
            <thead class="bg-gray-700">
            <tr>
                <th class="px-4 py-2 text-left text-sm font-medium text-gray-300">Name</th>
                <th class="px-4 py-2 text-left text-sm font-medium text-gray-300">Tags</th>
                <th class="px-4 py-2 text-right text-sm font-medium text-gray-300">Actions</th>
            </tr>
            </thead>
            <tbody class="bg-gray-800 divide-y divide-gray-600">
            @foreach($games as $game)
                <tr>
                    <td class="px-4 py-2 text-sm text-gray-200">{{ $game->name }}</td>
                    <td class="px-4 py-2 text-sm text-gray-200">
                        @foreach($game->tags as $tag)
                            <span class="inline-block text-white text-xs font-semibold mr-2 px-2.5 py-0.5 rounded-full {{ $tag->color }}">{{ ucfirst($tag->name) }}</span>
                        @endforeach
                    </td>
                    <td class="px-4 py-2 text-sm text-right flex justify-end space-x-2">
                        @auth
                            <a href="{{ route('games.edit', $game->id) }}" class="bg-yellow-500 hover:bg-yellow-600 text-white font-bold py-1 px-2 rounded text-xs">Edit</a>
                            <form action="{{ route('games.destroy', $game->id) }}" method="POST" class="inline-block">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="bg-red-500 hover:bg-red-600 text-white font-bold py-1 px-2 rounded text-xs">Delete</button>
                            </form>
                        @endauth
                        <a href="{{ route('games.show', $game->id) }}" class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-1 px-2 rounded text-xs">Show</a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>

        <div class="py-4">
            {{ $games->links('vendor.pagination.tailwind') }}
        </div>
    </div>

    <script>
        // Toggle the visibility of the tag filter options
        document.getElementById('tag-filter-toggle').addEventListener('click', function() {
            const options = document.getElementById('tag-filter-options');
            options.classList.toggle('hidden');
        });

        // Show color on selection
        document.querySelectorAll('input[type="checkbox"]').forEach(function(checkbox) {
            const label = document.querySelector(`label[for="${checkbox.id}"]`);
            if (checkbox.checked) {
                label.classList.add(checkbox.getAttribute('data-color'));
            } else {
                label.classList.remove(checkbox.getAttribute('data-color'));
            }
            checkbox.addEventListener('change', function() {
                if (this.checked) {
                    label.classList.remove('bg-gray-700');
                    label.classList.add(this.getAttribute('data-color'));
                } else {
                    label.classList.remove(this.getAttribute('data-color'));
                    label.classList.add('bg-gray-700');
                }
            });
        });
    </script>
@endsection
