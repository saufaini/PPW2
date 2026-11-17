<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Post;
use App\Models\Technology;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class RandomPostSeeder extends Seeder
{
    public function run(): void
    {
        $cats = Category::pluck('id');
        $techs = Technology::pluck('id');

        for ($i = 1; $i <= 25; $i++) {
            $judul = fake()->sentence(4);

            $post = Post::create([
                'title' => $judul,
                'slug' => Str::slug($judul) . '-' . Str::random(5),
                'short_description' => fake()->sentence(10),
                'description' => fake()->paragraph(),
                'status' => fake()->randomElement(['published', 'draft']),
                'post_date' => fake()->date(),
                'category_id' => $cats->random(),
            ]);
            $post->technologies()->sync($techs->random(2));
        }
    }
}