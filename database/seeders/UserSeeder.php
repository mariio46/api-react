<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::factory()->create([
            'name' => 'Mario',
            'username' => 'mario46_',
            'email' => 'mariomad2296@gmail.com',
        ])->assignRole('superadmin');

        User::factory()->create([
            'name' => 'Fitra',
            'username' => 'fitra46_',
            'email' => 'fitra@gmail.com',
        ])->assignRole('admin');

        User::factory(98)->create()->each(fn (User $user) => $user->assignRole('member'));
    }
}
