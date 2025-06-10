<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Borrowing extends Model
{
    use HasFactory;

    // Campos que podem ser preenchidos
    protected $fillable = ['user_id', 'book_id', 'borrowed_at', 'returned_at'];

    // Relacionamento com User
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relacionamento com Book
    public function book()
    {
        return $this->belongsTo(Book::class);
    }
}