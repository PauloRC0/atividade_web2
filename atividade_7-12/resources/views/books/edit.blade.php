@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="my-4">Editar Livro</h1>

    <form action="{{ route('books.update', $book->id) }}" method="POST" enctype="multipart/form-data">
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
                <option value="" selected>Selecione uma editora</option>
                @foreach($publishers as $publisher)
                    <option value="{{ $publisher->id }}" @if($book->publisher_id == $publisher->id) selected @endif>
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
                <option value="" selected>Selecione um autor</option>
                @foreach($authors as $author)
                    <option value="{{ $author->id }}" @if($book->author_id == $author->id) selected @endif>
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
                <option value="" selected>Selecione uma categoria</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}" @if($book->category_id == $category->id) selected @endif>
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
            <label for="cover_image" class="form-label">Imagem da Capa</label>
            <input type="file" class="form-control @error('cover_image') is-invalid @enderror" id="cover_image" name="cover_image" accept="image/*">
            @error('cover_image')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror

            @if($book->cover_image)
                <div class="mt-3">
                    <img src="{{ asset('storage/' . $book->cover_image) }}" alt="Capa Atual" class="img-fluid" style="max-height: 200px;">
                </div>
            @endif
        </div>

        <button type="submit" class="btn btn-primary">Atualizar</button>
    </form>
</div>
@endsection
