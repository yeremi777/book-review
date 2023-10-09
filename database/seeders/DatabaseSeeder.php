<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Book;
use App\Models\Review;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Book::factory(33)->create()->each(function ($book) {
            $num_reviews = random_int(5, 30);

            Review::factory()->count($num_reviews)->good()->for($book)->create();
        });

        Book::factory(33)->create()->each(function ($book) {
            $num_reviews = random_int(5, 30);

            Review::factory()->count($num_reviews)->average()->for($book)->create();
        });

        Book::factory(34)->create()->each(function ($book) {
            $num_reviews = random_int(5, 30);

            Review::factory()->count($num_reviews)->bad()->for($book)->create();
        });
    }
}
