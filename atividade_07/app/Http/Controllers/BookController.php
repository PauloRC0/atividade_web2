<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\User;
use App\Models\Publisher;
use App\Models\Author;
use App\Models\Category;
use Illuminate\Http\Request;

class BookController extends Controller
{
    // Formulário com input de ID
    public function createWithId()
    {
        return view('books.create-id');
    }

    // Salvar livro com input de ID
    public function storeWithId(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'publisher_id' => 'required|exists:publishers,id',
            'author_id' => 'required|exists:authors,id',
            'category_id' => 'required|exists:categories,id',
            'capa_livro' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        Book::create($request->all());

        return redirect()->route('books.index')->with('success', 'Livro criado com sucesso.');
    }

    // Formulário com input select
    public function createWithSelect()
    {
        $publishers = Publisher::all();
        $authors = Author::all();
        $categories = Category::all();

        return view('books.create-select', compact('publishers', 'authors', 'categories'));
    }

    // Salvar livro com input select
    public function storeWithSelect(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'publisher_id' => 'required|exists:publishers,id',
            'author_id' => 'required|exists:authors,id',
            'category_id' => 'required|exists:categories,id',
            'capa_livro' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $path = $request->file('capa_livro')->store('livros', 'public');

        Book::create([
            'title' => $request->title,
            'publisher_id' => $request->publisher_id,
            'author_id' => $request->author_id,
            'category_id' => $request->category_id,
            'capa_livro' => $request->capa_livro,
        ]);


        return redirect()->route('books.index')->with('success', 'Livro criado com sucesso.');
    }
    public function edit(Book $book)
    {
    $publishers = Publisher::all();
    $authors = Author::all();
    $categories = Category::all();

    return view('books.edit', compact('book', 'publishers', 'authors', 'categories'));
    }
    public function update(Request $request, Book $book)
    {
    $request->validate([
        'title' => 'required|string|max:255',
        'publisher_id' => 'required|exists:publishers,id',
        'author_id' => 'required|exists:authors,id',
        'category_id' => 'required|exists:categories,id',
        'capa_livro' => 'image|mimes:jpeg,png,jpg|max:2048',
    ]);

    $book->update($request->all());

    return redirect()->route('books.index')->with('success', 'Livro atualizado com sucesso.');
    }
    public function show(Book $book)
    {
    // Carregando autor, editora e categoria do livro com eager loading
    $book->load(['author', 'publisher', 'category']);

    // Carregar todos os usuários para o formulário de empréstimo
    $users = User::all();

    return view('books.show', compact('book','users'));
    }
    public function index()
    {
    // Carregar os livros com autores usando eager loading e paginação
    $books = Book::with('author')->paginate(20);

    return view('books.index', compact('books'));

    }
}
