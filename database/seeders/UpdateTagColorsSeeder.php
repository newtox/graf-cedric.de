<?php

namespace Database\Seeders;

use App\Models\Tag;
use Illuminate\Database\Seeder;

class UpdateTagColorsSeeder extends Seeder
{
    public function run(): void
    {
        $colorMap = [
            'Alpha' => 'orange',
            'Beta' => 'yellow',
            'Android' => 'green',
            'Console' => 'purple',
            'Games' => 'blue',
            'Hardware' => 'indigo',
            'Nintendo Switch' => 'red',
            'PC' => 'azure',
            'Software' => 'lime',
            'Wii U' => 'cyan'
        ];

        foreach ($colorMap as $tagName => $color) {
            Tag::where('name', $tagName)->update(['color' => $color]);
        }
    }
}
