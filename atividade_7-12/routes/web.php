<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\AuthorsController;
use App\Http\Controllers\PublishersController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\BorrowingController;
use Illuminate\Support\Facades\Auth;

Route::resource('users', UserController::class);
Route::resource('categories', CategoryController::class);
Route::resource('authors', AuthorsController::class);
Route::resource('publishers', PublishersController::class);

Route::get('/books/create-id-number', [BookController::class, 'createWithId'])->name('books.create.id');
Route::post('/books/create-id-number', [BookController::class, 'storeWithId'])->name('books.store.id');

Route::get('/books/create-select', [BookController::class, 'createWithSelect'])->name('books.create.select');
Route::post('/books/create-select', [BookController::class, 'storeWithSelect'])->name('books.store.select');

Route::resource('books', BookController::class)->except(['create', 'store']);

Route::get('/', function () {
    return view('welcome');
});

// Rota para registrar um empréstimo
Route::post('/books/{book}/borrow', [BorrowingController::class, 'store'])->name('books.borrow');

// Rota para listar o histórico de empréstimos de um usuário
Route::get('/users/{user}/borrowings', [BorrowingController::class, 'userBorrowings'])->name('users.borrowings');

// Rota para registrar a devolução
Route::patch('/borrowings/{borrowing}/return', [BorrowingController::class, 'returnBook'])->name('borrowings.return');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
