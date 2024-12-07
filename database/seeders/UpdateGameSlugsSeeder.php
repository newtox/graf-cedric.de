<?php

namespace Database\Seeders;

use App\Models\Game;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class UpdateGameSlugsSeeder extends Seeder
{
    public function run(): void
    {
        Game::all()->each(function ($game) {
            $game->slug = Str::slug($game->name);
            $game->save();
        });
    }
}
