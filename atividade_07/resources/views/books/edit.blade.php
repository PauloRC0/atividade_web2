@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="my-4">Editar Livro</h1>

    <form action="{{ route('books.update', $book) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="title" class="form-label">Título</label>
            <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" value="{{ old('title', $book->title) }}" required>
            @error('title')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="publisher_id" class="form-label">Editora</label>
            <select class="form-select @error('publisher_id') is-invalid @enderror" id="publisher_id" name="publisher_id" required>
                <option value="" disabled>Selecione uma editora</option>
                @foreach($publishers as $publisher)
                <option value="{{ $publisher->id }}" {{ $publisher->id == $book->publisher_id ? 'selected' : '' }}>
                    {{ $publisher->name }}
                </option>
                @endforeach
            </select>
            @error('publisher_id')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="author_id" class="form-label">Autor</label>
            <select class="form-select @error('author_id') is-invalid @enderror" id="author_id" name="author_id" required>
                <option value="" disabled>Selecione um autor</option>
                @foreach($authors as $author)
                <option value="{{ $author->id }}" {{ $author->id == $book->author_id ? 'selected' : '' }}>
                    {{ $author->name }}
                </option>
                @endforeach
            </select>
            @error('author_id')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="category_id" class="form-label">Categoria</label>
            <select class="form-select @error('category_id') is-invalid @enderror" id="category_id" name="category_id" required>
                <option value="" disabled>Selecione uma categoria</option>
                @foreach($categories as $category)
                <option value="{{ $category->id }}" {{ $category->id == $book->category_id ? 'selected' : '' }}>
                    {{ $category->name }}
                </option>
                @endforeach
            </select>
            @error('category_id')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">Capa atual</label><br>
            @if($book->capa_livro)
            <img src="{{ asset('storage/' . $book->capa_livro) }}" alt="Capa atual" style="max-width: 150px; height: auto;">
            @else
            <p>Sem imagem cadastrada.</p>
            @endif
        </div>

        
        <div class="mb-3">
            <label for="capa_livro" class="form-label">Alterar Capa</label>
            <input type="file" class="form-control @error('capa_livro') is-invalid @enderror" id="capa_livro" name="capa_livro" accept="image/*">
            @error('capa_livro')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>

        <button type="submit" class="btn btn-success">Atualizar</button>
        <a href="{{ route('books.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
@endsection