<?php

namespace Database\Seeders;

use App\Models\Tag;
use Illuminate\Database\Seeder;

class TagSeeder extends Seeder
{
    public function run()
    {
        Tag::query()->create(['name' => 'Android', 'color' => 'bg-green-600']);
        Tag::query()->create(['name' => 'Games', 'color' => 'bg-green-600']);
        Tag::query()->create(['name' => 'Beta', 'color' => 'bg-green-600']);
        Tag::query()->create(['name' => 'PC', 'color' => 'bg-gray-500']);
        Tag::query()->create(['name' => 'Console', 'color' => 'bg-yellow-500']);
        Tag::query()->create(['name' => 'Nintendo Switch', 'color' => 'bg-red-600']);
        Tag::query()->create(['name' => 'Alpha', 'color' => 'bg-purple-600']);
        Tag::query()->create(['name' => 'Hardware', 'color' => 'bg-blue-600']);
        Tag::query()->create(['name' => 'Software', 'color' => 'bg-pink-600']);
        Tag::query()->create(['name' => 'Wii U', 'color' => 'bg-blue-600']);
    }
}
