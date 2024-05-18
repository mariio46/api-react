<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    public function definition(): array
    {
        return [
            'name' => fake()->sentence(),
            'slug' => fn (array $attributes) => str($attributes['name'])->slug() . '-' . mt_rand(11111, 99999),
            'description' => fake()->paragraph(1),
            'price' => fake()->randomFloat(2, 100, 1000000),
        ];
    }
}
