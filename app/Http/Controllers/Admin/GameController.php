<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\GameRequest;
use App\Models\Game;
use App\Models\Tag;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Str;
use Illuminate\View\View;

class GameController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:create games')->only(['create', 'store']);
        $this->middleware('permission:edit games')->only(['edit', 'update']);
        $this->middleware('permission:delete games')->only('destroy');
    }

    public function index(): View
    {
        $games = Game::with('tags')->paginate(10);
        return view('admin.games.index', compact('games'));
    }

    public function create(): View
    {
        $tags = Tag::all();
        return view('admin.games.create', compact('tags'));
    }

    public function store(GameRequest $request): RedirectResponse
    {
        $validated = $request->validated();

        $validated['slug'] = Str::slug($validated['title']);

        $game = Game::create($validated);

        if ($request->hasFile('developer_image')) {
            $path = $request->file('developer_image')->store('developers', 'public');
            $game->developer_image = $path;
        }

        if ($request->hasFile('publisher_image')) {
            $path = $request->file('publisher_image')->store('publishers', 'public');
            $game->publisher_image = $path;
        }

        if ($request->hasFile('thumbnail')) {
            $path = $request->file('thumbnail')->store('games', 'public');
            $game->thumbnail = $path;
        }

        $game->save();

        if ($request->has('tags')) {
            $game->tags()->sync($request->tags);
        }

        return redirect()->route('admin.games.index')
            ->with('success', __('games.messages.created'));
    }

    public function edit(Game $game): View
    {
        $tags = Tag::all();
        return view('admin.games.edit', compact('game', 'tags'));
    }

    public function update(GameRequest $request, Game $game): RedirectResponse
    {
        $validated = $request->validated();
        $game->update($validated);

        if ($request->hasFile('developer_image')) {
            $path = $request->file('developer_image')->store('developers', 'public');
            $game->developer_image = $path;
        }

        if ($request->hasFile('publisher_image')) {
            $path = $request->file('publisher_image')->store('publishers', 'public');
            $game->publisher_image = $path;
        }

        if ($request->hasFile('thumbnail')) {
            $path = $request->file('thumbnail')->store('games', 'public');
            $game->thumbnail = $path;
        }

        $game->save();

        if ($request->has('tags')) {
            $game->tags()->sync($request->tags);
        }

        return redirect()->route('admin.games.index')
            ->with('success', __('games.messages.updated'));
    }

    public function destroy(Game $game): RedirectResponse
    {
        $game->delete();
        return redirect()->route('admin.games.index')
            ->with('success', __('games.messages.deleted'));
    }
}
