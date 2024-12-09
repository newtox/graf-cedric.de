<?php

namespace App\Http\Controllers;

use App\Models\Game;
use App\Models\Tag;
use App\Models\User;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function index(): View
    {
        $stats = [
            'total_games' => Game::count(),
            'total_tags' => Tag::count(),
            'total_users' => User::count(),
            'latest_games' => Game::with('tags')->latest()->take(5)->get(),
            'games_by_tag' => Tag::withCount('games')->orderByRaw("
                CASE
                    WHEN name LIKE 'Alpha%' THEN 1
                    WHEN name LIKE 'Beta%' THEN 2
                    WHEN name LIKE 'Games%' THEN 3
                    WHEN name LIKE 'Hardware%' THEN 4
                    WHEN name LIKE 'Software%' THEN 5
                    ELSE 6
                END,
                name ASC
            ")->get()
        ];

        return view('home', compact('stats'));
    }
}
