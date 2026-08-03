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
        $commitCount = 0;
        try {
            $output = shell_exec('git rev-list --count HEAD 2>&1');
            return 'DEBUG OUTPUT: ' . var_export($output, true);
            /*
            if ($output && is_numeric(trim($output))) {
                $commitCount = (int) trim($output);
            }
            */
        } catch (\Throwable $e) {
            return 'ERROR: ' . $e->getMessage();
        }

        $stats = [
            'total_games' => Game::count(),
            'total_tags' => Tag::count(),
            'total_commits' => $commitCount,
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
