<?php

namespace Database\Seeders;

use App\Models\Game;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Database\Seeder;

class ExampleSeeder extends Seeder
{
    public function run(): void
    {
        $adminUser = User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@example.com',
            'password' => bcrypt('password'),
        ]);

        $adminUser->assignRole('Admin');

        /*
        $tags = Tag::factory(5)->create();

        Game::factory(20)->create()->each(function ($game) use ($tags) {
            $game->tags()->attach(
                $tags->random(rand(1, 3))->pluck('id')->toArray()
            );
        });
        */
    }
}
