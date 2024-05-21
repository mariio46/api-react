<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class CategoryFactory extends Factory
{
    public function definition(): array
    {
        return [
            'name' => fake()->words(3, true),
            'slug' => fn (array $attributes) => str($attributes['name'])->lower()->slug() . '-' . mt_rand(11111, 99999),
        ];
    }
}
