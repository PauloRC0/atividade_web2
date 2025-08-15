<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Publisher;
use App\Models\Author;
use App\Models\Category;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BookController extends Controller
{
    public function createWithSelect()
    {
        $publishers = Publisher::all();
        $authors = Author::all();
        $categories = Category::all();

        return view('books.create-select', compact('publishers', 'authors', 'categories'));
    }

    public function storeWithSelect(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'publisher_id' => 'required|exists:publishers,id',
            'author_id' => 'required|exists:authors,id',
            'category_id' => 'required|exists:categories,id',
            'cover_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $data = $request->all();

        // Salvar imagem, se houver
        if ($request->hasFile('cover_image')) {
            $data['cover_image'] = $request->file('cover_image')->store('book_covers', 'public');
        }

        Book::create($data);

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
        $this->authorize('update', Book::class);

        $request->validate([
            'title' => 'required|string|max:255',
            'publisher_id' => 'required|exists:publishers,id',
            'author_id' => 'required|exists:authors,id',
            'category_id' => 'required|exists:categories,id',
            'cover_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $data = $request->all();

        // Atualizar imagem, se houver uma nova
        if ($request->hasFile('cover_image')) {
            if ($book->cover_image) {
                Storage::disk('public')->delete($book->cover_image);
            }
            $data['cover_image'] = $request->file('cover_image')->store('book_covers', 'public');
        }

        $book->update($data);

        return redirect()->route('books.index')->with('success', 'Livro atualizado com sucesso.');
    }

    public function show(Book $book)
    {
        $book->load(['author', 'publisher', 'category']);
        $users = User::all();

        return view('books.show', compact('book', 'users'));
    }
    public function index(Request $request)
    {
        $search = $request->input('search');
        
        $books = Book::query()
            ->when($search, function ($query) use ($search) {
                return $query->where('title', 'like', "%{$search}%");
            })
            ->paginate(10);
        
        return view('books.index', compact('books', 'search'));
    }

    public function destroy(Book $book)
{
    $this->authorize('delete', Book::class);
    
    $book->delete();
    
    return redirect()->route('books.index')
        ->with('success', 'Book deleted successfully');
}

    }

