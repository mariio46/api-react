<?php

namespace Database\Seeders;

use App\Models\Article;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory()->create([
            'name' => 'Mario',
            'username' => 'mario46_',
            'email' => 'mariomad2296@gmail.com',
        ]);
        User::factory()->create([
            'name' => 'Fitra',
            'username' => 'fitra46_',
            'email' => 'fitra@gmail.com',
        ]);

        User::factory(10)->create();

        // Article::factory(2)->create();
        Article::factory(90)->create();
        // Article::factory(90 * 20)->create();
    }
}
