<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Article>
 */
class ArticleFactory extends Factory
{
    public function definition(): array
    {
        return [
            'title' => fake()->sentence(),
            'slug' => fn (array $attributes) => str()->slug($attributes['title']) . '-' . mt_rand(111111, 999999),
            // 'image' => fake()->imageUrl(width: 1280, height: 720, category: 'product', format: 'jpg'),
            // 'image' => "images/static/raw-1.webp",
            'image' => 'images/static/raw-' . rand(1, 11) . '.webp',
            'excerpt' => fake()->paragraph(1),
            'body' => fake()->paragraph(8),
        ];
    }
}
