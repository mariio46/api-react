<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    public function definition(): array
    {
        return [
            // 'category_id' => rand(1, 6),
            // 'type_id' => rand(1, 2),
            'name' => fake()->sentence(),
            'slug' => fn (array $attributes) => str($attributes['name'])->lower()->slug() . '-' . mt_rand(11111, 99999),
            'description' => fake()->paragraph(1),
            'price' => fake()->randomFloat(2, 100, 1000000),
        ];
    }
}
