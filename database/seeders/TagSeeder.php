<?php

namespace Database\Seeders;

use App\Models\Tag;
use Illuminate\Database\Seeder;

class TagSeeder extends Seeder
{
    public function run()
    {
        Tag::query()->create(['name' => 'Alpha', 'color' => 'bg-purple-600']);
        Tag::query()->create(['name' => 'Beta', 'color' => 'bg-emerald-600']);
        Tag::query()->create(['name' => 'Games', 'color' => 'bg-violet-900']);
        Tag::query()->create(['name' => 'Hardware', 'color' => 'bg-blue-800']);
        Tag::query()->create(['name' => 'Software', 'color' => 'bg-yellow-600']);
        Tag::query()->create(['name' => 'Android', 'color' => 'bg-green-400']);
        Tag::query()->create(['name' => 'PC', 'color' => 'bg-zinc-500']);
        Tag::query()->create(['name' => 'Console', 'color' => 'bg-yellow-500']);
        Tag::query()->create(['name' => 'Wii U', 'color' => 'bg-sky-400']);
        Tag::query()->create(['name' => 'Nintendo Switch', 'color' => 'bg-red-600']);
    }
}
