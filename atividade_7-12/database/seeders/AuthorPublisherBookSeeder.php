<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Author;
use App\Models\Book;
use App\Models\Category;
use App\Models\Publisher;

class AuthorPublisherBookSeeder extends Seeder
{
    public function run()
    {
        if (Category::count() == 0) {
            $this->command->info('No categories found. Please seed categories first.');
            return;
        }

        Author::factory(100)->create()->each(function ($author) {
            $publisher = Publisher::factory()->create();

            $author->books()->createMany(
                Book::factory(10)->make([
                    'category_id' => Category::inRandomOrder()->first()->id,
                    'publisher_id' => $publisher->id,
                ])->toArray()
            );
        });
    }
}
