@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="my-4">Lista de Categorias</h1>

    @can('create', App\Models\Category::class)
    <a href="{{ route('categories.create') }}" class="btn btn-success mb-3">
        <i class="bi bi-plus"></i> Adicionar Categoria
    </a>
@else
    <button onclick="showUnauthorized()" class="btn btn-success mb-3">
        <i class="bi bi-plus"></i> Adicionar Categoria
    </button>

    <script>
        function showUnauthorized() {
            alert('Ação não autorizada.');
        }
    </script>
@endcan

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <table class="table table-striped">
        <thead>
            <tr>
                <th>#</th>
                <th>Nome</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            @forelse($categories as $category)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $category->name }}</td>
                    <td>
                        <!-- Botão de Visualizar -->
                        <a href="{{ route('categories.show', $category) }}" class="btn btn-info btn-sm">
                            <i class="bi bi-eye"></i> Visualizar
                        </a>

                        <!-- Botão de Editar -->
                        @can('update', App\Models\Category::class)
                        <a href="{{ route('categories.edit', $category) }}" class="btn btn-primary btn-sm">
                            <i class="bi bi-pencil"></i> Editar
                        </a>
                        @endcan

                        <!-- Botão de Excluir -->
                        @can('delete', App\Models\Category::class)
                        <form action="{{ route('categories.destroy', $category) }}" method="POST" style="display: inline;">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger btn-sm" onclick="return confirm('Deseja excluir esta categoria?')">
                                <i class="bi bi-trash"></i> Excluir
                            </button>
                        </form>
                        @endcan
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="3">Nenhuma categoria encontrada.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection