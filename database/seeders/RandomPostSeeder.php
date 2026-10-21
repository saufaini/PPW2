<?php

namespace Database\Seeders;

use App\Models\Post;
use Illuminate\Database\Seeder;

class RandomPostSeeder extends Seeder
{
    public function run(): void
    {
        for ($i = 1; $i <= 25; $i++) {
            Post::create([
                'title'       => fake()->sentence(4),
                'description' => fake()->paragraph(),
                'status'      => fake()->randomElement(['published', 'draft']),
            ]);
        }
    }
}