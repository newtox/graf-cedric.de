@extends('layouts.app')

@section('content')
    <div class="container mx-auto my-8 p-4 bg-gray-800 shadow-md rounded-lg">
        <h1 class="mb-4 text-center text-xl font-bold text-white">Tags</h1>

        <table class="min-w-full divide-y divide-gray-600">
            <thead class="bg-gray-700">
            <tr>
                <th class="px-4 py-2 text-left text-sm font-medium text-gray-300">Name</th>
                <th class="px-4 py-2 text-left text-sm font-medium text-gray-300">Color</th>
                <th class="px-4 py-2 text-left text-sm font-medium text-gray-300">Actions</th>
            </tr>
            </thead>
            <tbody class="bg-gray-800 divide-y divide-gray-600">
            @foreach($tags as $tag)
                <tr>
                    <td class="px-4 py-2 text-sm text-gray-200">{{ $tag->name }}</td>
                    <td class="px-4 py-2 text-sm text-gray-200">
                        @php
                            // Mapping Tailwind CSS color classes to normal names
                            $colorNames = [
                                'bg-red-600' => 'Red',
                                'bg-green-600' => 'Green',
                                'bg-blue-600' => 'Blue',
                                'bg-yellow-500' => 'Yellow',
                                'bg-gray-500' => 'Gray',
                                'bg-purple-600' => 'Purple',
                                'bg-indigo-600' => 'Indigo',
                                'bg-pink-600' => 'Pink',
                            ];
                            $colorName = $colorNames[$tag->color] ?? 'Unknown';
                        @endphp
                        <span class="inline-block px-2 py-1 text-xs font-semibold text-white rounded-full {{ $tag->color }}">
                                {{ $colorName }}
                            </span>
                    </td>
                    <td class="px-4 py-2 text-sm flex space-x-2">
                        <a href="{{ route('tags.edit', $tag->id) }}" class="bg-yellow-500 hover:bg-yellow-600 text-white font-bold py-1 px-2 rounded text-xs">Edit</a>
                        <form action="{{ route('tags.destroy', $tag->id) }}" method="POST" class="inline-block">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="bg-red-500 hover:bg-red-600 text-white font-bold py-1 px-2 rounded text-xs">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
