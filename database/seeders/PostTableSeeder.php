<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Post;
use App\Models\Technology;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

class PostTableSeeder extends Seeder
{
    public function run(): void
    {
        Schema::disableForeignKeyConstraints();
        Post::truncate();
        Schema::enableForeignKeyConstraints();

        $cats = Category::pluck('id');
        $techs = Technology::pluck('id');

        for ($i = 1; $i <= 10; $i++) {
            $post = Post::create([
                'title' => 'Post Judul Ke-' . $i,
                'slug' => 'post-judul-ke-' . $i,
                'short_description' => 'Ringkasan post ke-' . $i,
                'description' => 'Deskripsi untuk post judul ke-' . $i,
                'status' => $i % 2 ? 'published' : 'draft',
                'post_date' => now()->subDays($i)->toDateString(),
                'category_id' => $cats->random(),
            ]);
            $post->technologies()->sync($techs->random(2));
        }
    }
}