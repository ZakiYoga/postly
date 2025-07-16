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
        // Tech - Biru teknologi yang elegan
        Category::create([
            'name' => 'Tech',
            'slug' => 'tech',
            'color' => '#2563EB', // Blue-600
        ]);

        // Gadgets - Orange yang energik untuk perangkat
        Category::create([
            'name' => 'Gadgets',
            'slug' => 'gadgets',
            'color' => '#EA580C', // Orange-600
        ]);

        // Robotics - Merah gelap yang futuristik
        Category::create([
            'name' => 'Robotics',
            'slug' => 'robotics',
            'color' => '#DC2626', // Red-600
        ]);

        // Startups - Hijau untuk pertumbuhan dan inovasi
        Category::create([
            'name' => 'Startups',
            'slug' => 'startups',
            'color' => '#16A34A', // Green-600
        ]);

        // Space - Ungu gelap untuk misteri luar angkasa
        Category::create([
            'name' => 'Space',
            'slug' => 'space',
            'color' => '#7C3AED', // Violet-600
        ]);

        // Biotech - Teal untuk kehidupan dan biologi
        Category::create([
            'name' => 'Biotech',
            'slug' => 'biotech',
            'color' => '#0D9488', // Teal-600
        ]);

        // Artificial Intelligence - Indigo untuk kecerdasan
        Category::create([
            'name' => 'Artificial Intelligence',
            'slug' => 'artificial-intelligence',
            'color' => '#4F46E5', // Indigo-600
        ]);

        // Cybersecurity - Merah gelap untuk keamanan
        Category::create([
            'name' => 'Cybersecurity',
            'slug' => 'cyber-security',
            'color' => '#B91C1C', // Red-700
        ]);

        // Science - Hijau emerald untuk penelitian
        Category::create([
            'name' => 'Science',
            'slug' => 'science',
            'color' => '#059669', // Emerald-600
        ]);

        // Software - Biru cyan untuk coding
        Category::create([
            'name' => 'Software',
            'slug' => 'software',
            'color' => '#0891B2', // Cyan-600
        ]);

        // Hardware - Abu-abu slate untuk komponen fisik
        Category::create([
            'name' => 'Hardware',
            'slug' => 'hardware',
            'color' => '#475569', // Slate-600
        ]);

        // Programming - Kuning amber untuk kreativitas coding
        Category::create([
            'name' => 'Programming',
            'slug' => 'programming',
            'color' => '#D97706', // Amber-600
        ]);

        // UI/UX - Pink untuk desain dan kreativitas
        Category::create([
            'name' => 'UI/UX',
            'slug' => 'UI-UX',
            'color' => '#DB2777', // Pink-600
        ]);
    }
}
