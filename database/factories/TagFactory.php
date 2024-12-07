<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class TagFactory extends Factory
{
    public function definition(): array
    {
        return [
            'name' => $this->faker->unique()->word(),
            'color' => $this->faker->randomElement([
                'primary', 'secondary', 'success',
                'warning', 'danger', 'info',
                'blue', 'azure', 'indigo', 'purple',
                'pink', 'red', 'orange', 'yellow',
                'lime', 'green', 'teal', 'cyan'
            ])
        ];
    }
}
