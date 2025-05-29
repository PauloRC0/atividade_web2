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
        // Gera 100 autores, cada um com 10 livros
        Author::factory(100)->create()->each(function ($author) {
            // Gera uma editora para cada autor
            $publisher = Publisher::factory()->create();

            // Cria 10 livros para cada autor, associando uma categoria existente
            $author->books()->createMany(
                Book::factory(10)->make([
                    'category_id' => Category::inRandomOrder()->first()->id,
                    'publisher_id' => $publisher->id,
                ])->toArray()
            );
        });
    }
}
