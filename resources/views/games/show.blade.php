@extends('layouts.app')

@section('content')
    <div class="container mx-auto my-8 p-4 bg-gray-800 shadow-md rounded-lg max-w-lg"> <!-- Shortened width -->
        <h1 class="mb-4 text-center text-2xl font-bold text-white">{{ $game->name }}</h1>

        <!-- Row for Thumbnail Image -->
        <div class="flex justify-center mb-4">
            <img src="{{ asset('storage/' . $game->thumbnail_image_path) }}" alt=" " class="h-60 object-contain rounded-lg"> <!-- Adjusted height -->
        </div>

        <!-- Row for Publisher and Developer Images -->
        <div class="flex justify-around mb-4">
            <!-- Publisher Image -->
            <div class="flex flex-col items-center">
                <img src="{{ asset('storage/' . $game->publisher_image_path) }}" alt=" " class="h-32 w-32 object-contain rounded-lg mb-2"> <!-- Adjusted height -->
                <p class="text-gray-300 text-center"><strong>Publisher:</strong> {{ $game->publisher_name }}</p>
            </div>

            <!-- Developer Image -->
            <div class="flex flex-col items-center">
                <img src="{{ asset('storage/' . $game->developer_image_path) }}" alt=" " class="h-32 w-32 object-contain rounded-lg mb-2"> <!-- Adjusted height -->
                <p class="text-gray-300 text-center"><strong>Developer:</strong> {{ $game->developer_name }}</p>
            </div>
        </div>

        <h2 class="text-xl text-white mt-4">Tags:</h2>
        <div class="mt-2">
            @foreach($game->tags as $tag)
                <span class="inline-block px-2 py-1 text-xs font-semibold text-white rounded-full {{ $tag->color }}">
                    {{ ucfirst($tag->name) }}
                </span>
            @endforeach
        </div>
    </div>
@endsection
