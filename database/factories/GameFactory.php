<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class GameFactory extends Factory
{
    public function definition(): array
    {
        $title = $this->faker->unique()->words(3, true);
        return [
            'title' => $title,
            'slug' => Str::slug($title),
            'developer_name' => $this->faker->company(),
            'publisher_name' => $this->faker->company(),
            'developer_image' => null,
            'publisher_image' => null,
            'thumbnail' => null
        ];
    }
}
