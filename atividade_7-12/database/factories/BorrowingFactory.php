<?php

namespace Database\Factories;

use App\Models\Borrowing;
use App\Models\User;
use App\Models\Book;
use Illuminate\Database\Eloquent\Factories\Factory;

class BorrowingFactory extends Factory
{
    protected $model = Borrowing::class;

    public function definition()
    {
        return [
            'user_id' => User::factory(), // Cria um novo usuário ou usa um existente
            'book_id' => Book::inRandomOrder()->first()->id, // Seleciona um livro aleatório
            'borrowed_at' => $this->faker->dateTimeBetween('-1 month', 'now'), // Data de empréstimo
            'returned_at' => $this->faker->optional()->dateTimeBetween('now', '+1 month'), // Data de devolução opcional
        ];
    }
}