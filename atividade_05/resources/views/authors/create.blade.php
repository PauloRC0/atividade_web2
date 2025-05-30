@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="my-4">Adicionar Autor</h1>

    <form action="{{ route('authors.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="name" class="form-label">Nome do Autor</label>
            <input type="text" name="name" id="name" class="form-control" value="{{ old('name') }}" required>

            @error('name')
                <div class="text-danger mt-1">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-success">Salvar</button>
        <a href="{{ route('authors.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
@endsection