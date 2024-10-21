@extends('layouts.app')

@section('content')
    <div class="container mx-auto my-8 p-6 bg-gray-800 shadow-md rounded-lg">
        <h1 class="mb-4 text-center text-xl font-bold text-white">Games</h1>

        <div class="flex flex-col sm:flex-row justify-between mb-4 space-y-2 sm:space-y-0 sm:space-x-4">
            <form action="{{ route('games.index') }}" method="GET" class="flex items-center flex-1">
                <input type="text" name="search" placeholder="Search..."
                       class="px-4 py-2 rounded-lg bg-gray-700 text-white border border-gray-600 sm:w-80 md:w-64 lg:w-48"/>
                <button type="submit" class="ml-2 px-4 py-2 bg-blue-500 hover:bg-blue-600 text-white rounded-lg">
                    Search
                </button>
            </form>

            <div class="relative flex-shrink-0 sm:ml-2">
                <button id="tag-filter-toggle" class="px-4 py-2 bg-blue-500 hover:bg-blue-600 text-white rounded-lg">
                    Filter by Tags
                </button>
                <div id="tag-filter-options" class="hidden mt-2 bg-gray-700 rounded-lg shadow-lg p-4 absolute z-50">
                    <form action="{{ route('games.index') }}" method="GET" class="space-y-2">
                        @foreach($tags as $tag)
                            <div class="flex items-center whitespace-nowrap">
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
                        <button type="submit"
                                class="mt-2 px-4 py-2 bg-blue-500 hover:bg-blue-600 text-white rounded-lg">Apply Filter
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-600 table-fixed">
                <thead class="bg-gray-700">
                <tr>
                    <th class="px-4 py-2 text-left text-sm font-medium text-gray-300 sticky top-0 bg-gray-700 z-10" style="width: 40%;">Name
                    </th>
                    <th class="px-4 py-2 text-left text-sm font-medium text-gray-300 sticky top-0 bg-gray-700 z-10" style="width: 40%;">Tags
                    </th>
                    <th class="px-4 py-2 text-right text-sm font-medium text-gray-300 sticky top-0 bg-gray-700 z-10" style="width: 20%;">Actions
                    </th>
                </tr>
                </thead>
                <tbody class="bg-gray-800 divide-y divide-gray-600">
                @foreach($games as $game)
                    <tr>
                        <td class="px-4 py-2 text-sm text-gray-200 whitespace-nowrap">{{ $game->name }}</td>
                        <td class="px-4 py-2 text-sm text-gray-200">
                            <div class="flex flex-wrap text-sm text-gray-200 space-x-2">
                                @foreach($game->tags->sortBy('name') as $tag)
                                    <span
                                        class="inline-block text-white text-xs font-semibold px-2.5 py-0.5 rounded-full {{ $tag->color }} whitespace-nowrap">
                                        {{ ucfirst($tag->name) }}
                                    </span>
                                @endforeach
                            </div>
                        </td>
                        <td class="px-4 py-2 text-sm text-right flex justify-end space-x-2">
                            <!-- Desktop Action Buttons (Hidden on mobile) -->
                            <div class="hidden sm:flex space-x-2">
                                @auth
                                    <a href="{{ route('games.edit', $game->id) }}" class="bg-yellow-500 hover:bg-yellow-600 text-white font-bold py-1 px-2 rounded text-xs">Edit</a>
                                    <form action="{{ route('games.destroy', $game->id) }}" method="POST" class="inline-block">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="bg-red-500 hover:bg-red-600 text-white font-bold py-1 px-2 rounded text-xs">Delete</button>
                                    </form>
                                @endauth
                                <a href="{{ route('games.show', $game->id) }}" class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-1 px-2 rounded text-xs">Info</a>
                            </div>

                            <!-- Mobile Dropdown Menu -->
                            <div x-data="{ open: false }" class="relative sm:hidden">
                                <button @click="open = !open" class="inline-flex justify-center items-center px-4 py-2 text-sm font-medium text-gray-300 bg-gray-700 hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-gray-800 focus:ring-gray-500 rounded-md">
                                    Actions
                                    <svg class="-mr-1 ml-2 h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 011.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                    </svg>
                                </button>

                                <div x-show="open" @click.away="open = false" class="absolute right-0 mt-2 w-40 rounded-md shadow-lg z-50 bg-gray-700 ring-1 ring-black ring-opacity-5 focus:outline-none">
                                    <div class="py-1" role="none">
                                        @auth
                                            <a href="{{ route('games.edit', $game->id) }}" class="block rounded text-left px-3 py-1 text-sm text-white bg-yellow-500 hover:bg-yellow-600">Edit</a>
                                            <form action="{{ route('games.destroy', $game->id) }}" method="POST" class="block">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="rounded w-full text-left px-3 py-1 text-white bg-red-500 hover:bg-red-600">Delete</button>
                                            </form>
                                        @endauth
                                        <a href="{{ route('games.show', $game->id) }}" class="block rounded text-left px-3 py-1 text-white bg-blue-500 hover:bg-blue-600">Info</a>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>

        <div class="flex flex-col sm:flex-row justify-end space-x-2 mt-4">
            @foreach($games as $game)
                <div class="sm:hidden flex flex-col mb-2">
                    @auth
                        <a href="{{ route('games.edit', $game->id) }}" class="bg-yellow-500 hover:bg-yellow-600 text-white font-bold py-1 px-2 rounded text-xs">Edit</a>
                        <form action="{{ route('games.destroy', $game->id) }}" method="POST" class="inline-block">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="bg-red-500 hover:bg-red-600 text-white font-bold py-1 px-2 rounded text-xs">Delete</button>
                        </form>
                    @endauth
                    <a href="{{ route('games.show', $game->id) }}" class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-1 px-2 rounded text-xs">Info</a>
                </div>
            @endforeach
        </div>

        <div class="py-4">
            {{ $games->links('vendor.pagination.tailwind') }}
        </div>
    </div>

    <script>
        // Toggle the visibility of the tag filter options
        document.getElementById('tag-filter-toggle').addEventListener('click', function () {
            const options = document.getElementById('tag-filter-options');
            options.classList.toggle('hidden');
        });

        // Show color on selection
        document.querySelectorAll('input[type="checkbox"]').forEach(function (checkbox) {
            const label = document.querySelector(`label[for="${checkbox.id}"]`);
            if (checkbox.checked) {
                label.classList.add(checkbox.getAttribute('data-color'));
            } else {
                label.classList.remove(checkbox.getAttribute('data-color'));
            }
            checkbox.addEventListener('change', function () {
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
