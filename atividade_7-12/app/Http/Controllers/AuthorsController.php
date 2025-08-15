<?php

namespace App\Http\Controllers;

use App\Models\Author;
use App\Models\Category;
use Illuminate\Http\Request;

class AuthorsController extends Controller
{
    // Exibe uma lista de categorias
    public function index()
    {
        $authors = Author::all();
        return view('authors.index', compact('authors'));
    }

    // Mostra o formulário para criar uma nova categoria
    public function create()
    {
        return view('authors.create');
    }

    // Armazena uma nova categoria no banco de dados
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|unique:authors|max:255',
        ]);

        Author::create($request->all());

        return redirect()->route('authors.index')->with('success', 'Autor criado com sucesso.');
    }

    // Exibe uma categoria específica
    public function show(Author $author)
    {
        return view('authors.show', compact('author'));
    }

    // Mostra o formulário para editar uma categoria existente
    public function edit(Author $author)
    {
        $category = Category::all();
        return view('authors.edit', compact('author', 'category'));
    }
    

    // Atualiza uma categoria no banco de dados
    public function update(Request $request, Author $author)
    {
        $request->validate([
            'name' => 'required|string|unique:authors,name,' . $author->id . '|max:255',
        ]);

        $author->update($request->all());

        return redirect()->route('authors.index')->with('success', 'Autor atualizado com sucesso.');
    }

    // Remove uma categoria do banco de dados
    public function destroy(Author $author)
    {
        $author->delete();

        return redirect()->route('authors.index')->with('success', 'Autor excluído com sucesso.');
    }
}
