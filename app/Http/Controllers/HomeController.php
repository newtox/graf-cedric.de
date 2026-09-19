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
        $commitCount = (int) env('TOTAL_COMMITS', 0);
        $stats = [
            'total_games' => Game::count(),
            'total_tags' => Tag::count(),
            'total_commits' => $commitCount,
            'latest_games' => Game::with(['tags', 'developer'])->latest()->take(5)->get(),
            'games_by_tag' => Tag::withCount('games')->get(),
        ];
        return view('home', compact('stats'));
    }
}
