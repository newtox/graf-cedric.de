<?php

namespace App\Http\Controllers;

use App\Models\Game;
use App\Models\Tag;
use Illuminate\Http\Request;

class GameController extends Controller
{
    public function index(Request $request)
    {
        // Get all tags from the database
        $tags = Tag::all();

        // Initialize the query for games without calling get()
        $query = Game::query()->orderBy('name', 'ASC');

        // Handle search query
        if ($request->has('search') && !empty($request->search)) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        // Handle tag filtering
        if ($request->has('tags') && !empty($request->tags)) {
            $query->whereHas('tags', function ($q) use ($request) {
                $q->whereIn('tags.id', $request->tags);
            });
        }

        // Paginate results after building the query
        $games = $query->paginate(10);

        // Return view with games and tags
        return view('games.index', compact('games', 'tags'));
    }

    public function create()
    {
        $tags = Tag::all(); // Fetch all tags for select menu
        return view('games.create', compact('tags'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'thumbnail_image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'publisher_name' => 'required',
            'developer_name' => 'required',
            'publisher_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'developer_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'tags' => 'nullable|array',
            'tags.*' => 'exists:tags,id',
        ]);

        // Store the required thumbnail image
        $thumbnailPath = $request->file('thumbnail_image')->store('images/thumbnails', 'public');

        // Store publisher image if uploaded, or set it to null
        $publisherImagePath = $request->hasFile('publisher_image')
            ? $request->file('publisher_image')->store('images/publishers', 'public')
            : null;

        // Store developer image if uploaded, or set it to null
        $developerImagePath = $request->hasFile('developer_image')
            ? $request->file('developer_image')->store('images/developers', 'public')
            : null;

        // Create the game instance
        $game = Game::create([
            'name' => $request->name,
            'description' => $request->description,
            'thumbnail_image_path' => $thumbnailPath,
            'publisher_name' => $request->publisher_name,
            'developer_name' => $request->developer_name,
            'publisher_image_path' => $publisherImagePath,
            'developer_image_path' => $developerImagePath,
        ]);

        if ($request->tags) {
            $game->tags()->attach($request->tags);
        }

        return redirect()->route('games.index')->with('success', 'Game created successfully.');
    }

    public function edit(Game $game)
    {
        $tags = Tag::all();
        return view('games.edit', compact('game', 'tags'));
    }

    public function show(Game $game)
    {
        $game->load(['tags' => function ($query) {
            $query->orderBy('name', 'ASC');
        }]);
        return view('games.show', compact('game'));
    }

    public function update(Request $request, Game $game)
    {
        $request->validate([
            'name' => 'required',
            'thumbnail_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'publisher_name' => 'required',
            'developer_name' => 'required',
            'publisher_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'developer_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'tags' => 'nullable|array',
            'tags.*' => 'exists:tags,id',
        ]);

        // Update fields
        $game->name = $request->name;
        $game->publisher_name = $request->publisher_name;
        $game->developer_name = $request->developer_name;

        if ($request->hasFile('thumbnail_image')) {
            $game->thumbnail_image_path = $request->file('thumbnail_image')->store('images/thumbnails', 'public');
        }
        if ($request->hasFile('publisher_image')) {
            $game->publisher_image_path = $request->file('publisher_image')->store('images/publishers', 'public');
        }
        if ($request->hasFile('developer_image')) {
            $game->developer_image_path = $request->file('developer_image')->store('images/developers', 'public');
        }

        $game->save();

        // Update tags
        if ($request->tags) {
            $game->tags()->sync($request->tags);
        } else {
            $game->tags()->detach();
        }

        return redirect()->route('games.index')->with('success', 'Game updated successfully.');
    }

    public function destroy(Game $game)
    {
        $game->delete();
        return redirect()->route('games.index')->with('success', 'Game deleted successfully.');
    }
}
