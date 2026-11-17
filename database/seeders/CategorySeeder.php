<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        // use App\Models\Category;
        // use Illuminate\Support\Str;

        foreach (['Web Application', 'Mobile App', 'UI Design', 'Data Science'] as $nama) {
            Category::updateOrCreate(['slug' => Str::slug($nama)], ['name' => $nama]);
        }
    }
}
