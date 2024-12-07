<?php

namespace Database\Seeders;

use App\Models\Game;
use App\Models\Tag;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ImportJsonDataSeeder extends Seeder
{
    public function run(): void
    {
        $json = file_get_contents(storage_path('app/db-backup.json'));
        $data = json_decode($json, true);

        foreach ($data['tags'] as $tag) {
            Tag::create([
                'id' => $tag['id'],
                'name' => $tag['name'],
                'color' => $tag['color'] ?? 'blue',
                'created_at' => $tag['created_at'],
                'updated_at' => $tag['updated_at']
            ]);
        }

        foreach ($data['games'] as $game) {
            $baseSlug = Str::slug($game['name'] ?? $game['title']);
            $slug = $baseSlug;
            $counter = 1;

            while (Game::where('slug', $slug)->exists()) {
                $slug = $baseSlug . '-' . $counter;
                $counter++;
            }

            Game::create([
                'id' => $game['id'],
                'title' => $game['name'] ?? $game['title'],
                'slug' => $slug,
                'thumbnail' => $game['thumbnail_image_path']
                    ? 'images/thumbnails/' . basename($game['thumbnail_image_path'])
                    : null,
                'developer_name' => $game['developer_name'],
                'developer_image' => $game['developer_image_path']
                    ? 'images/developers/' . basename($game['developer_image_path'])
                    : null,
                'publisher_name' => $game['publisher_name'],
                'publisher_image' => $game['publisher_image_path']
                    ? 'images/publishers/' . basename($game['publisher_image_path'])
                    : null,
            ]);
        }

        foreach ($data['game_tag'] as $pivot) {
            DB::table('game_tag')->insert($pivot);
        }
    }
}
