<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Technology;
use Illuminate\Support\Str;



class TechnologySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach (['Laravel', 'PHP', 'Tailwind CSS', 'MySQL', 'JavaScript'] as $nama) {
            Technology::updateOrCreate(['slug' => Str::slug($nama)], ['name' => $nama]);
        }
    }
}
