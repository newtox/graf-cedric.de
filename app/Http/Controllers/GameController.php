<?php

namespace App\Http\Controllers;

use App\Models\Game;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\View\View;

class GameController extends Controller
{
    public function index(Request $request): View
    {
        $query = Game::with('tags');

        if ($request->has('search')) {
            $query->where(function($q) use ($request) {
                $q->where('games.title', 'like', '%' . $request->search . '%')
                    ->orWhere('games.developer_name', 'like', '%' . $request->search . '%');
            });
        }

        if ($request->has('tags')) {
            $query->whereHas('tags', function ($q) use ($request) {
                $q->whereIn('tags.id', (array) $request->tags);
            });
        }

        $games = $query->paginate(12)->withQueryString();
        $tags = Tag::orderBy('name')->get();

        if ($request->ajax()) {
            return view('games.partials.game-cards', compact('games'));
        }

        return view('games.index', compact('games', 'tags'));
    }

    public function show(Game $game): View
    {
        $game->load('tags');
        return view('games.show', compact('game'));
    }
}