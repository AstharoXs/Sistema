@extends('layouts.app')

@section('content')

<div class="container mt-4">
    @if(Session::has('mensaje'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ Session::get('mensaje') }}

            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Lista de categorías</h2>

        <a href="{{ url('/categorias/create') }}" class="btn btn-success">
            Registrar nueva categoría
        </a>
    </div>
    <div class="table-responsive">
        <table class="table table-bordered table-striped table-hover align-middle">
            <thead class="table-light">
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($categorias as $datos)
                    <tr>
                        <td>{{ $datos->id }}</td>
                        <td>{{ $datos->nom_categoria }}</td>
                        <td>
                            <a href="{{ url('/categorias/'.$datos->id.'/edit') }}"
                               class="btn btn-warning btn-sm">
                                Editar
                            </a>
                            |
                            <form action="{{ url('/categorias/'.$datos->id) }}"
                                  method="POST"
                                  class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                        onclick="return confirm('¿Deseas eliminar esta categoría?')"
                                        class="btn btn-danger btn-sm">
                                    Eliminar
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3" class="text-center">
                            No hay categorías registradas.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="mt-3">
        {{ $categorias->links() }}
    </div>
</div>
@endsection
