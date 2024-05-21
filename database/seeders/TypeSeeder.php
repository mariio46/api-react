<?php

namespace Database\Seeders;

use App\Models\Type;
use Illuminate\Database\Seeder;

class TypeSeeder extends Seeder
{
    public function run(): void
    {
        Type::factory()->create(['name' => 'Food']);
        Type::factory()->create(['name' => 'Drink']);
        Type::factory()->create(['name' => 'Snack']);
    }
}
