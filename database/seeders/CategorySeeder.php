<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Category::create([
            'name' => 'Tech',
            'slug' => 'tech',
            'color' => '#007BFF',
        ]);

        Category::create([
            'name' => 'Gadgets',
            'slug' => 'gadgets',
            'color' => '#FD7E14',
        ]);

        Category::create([
            'name' => 'Robotics',
            'slug' => 'robotics',
            'color' => '#AC1754',
        ]);

        Category::create([
            'name' => 'Startups',
            'slug' => 'startups',
            'color' => '#FFC107',
        ]);

        Category::create([
            'name' => 'Artificial Intelligence',
            'slug' => 'artificial-intelligence',
            'color' => '#6F42C1',
        ]);

        Category::create([
            'name' => 'Cybersecurity',
            'slug' => 'cyber-security',
            'color' => '#DC3545',
        ]);

        Category::create([
            'name' => 'Science',
            'slug' => 'science',
            'color' => '#28A745',
        ]);

        Category::create([
            'name' => 'Software',
            'slug' => 'software',
            'color' => '#17A2B8',
        ]);

        Category::create([
            'name' => 'Hardware',
            'slug' => 'hardware',
            'color' => '#6C757D',
        ]);
    }
}
