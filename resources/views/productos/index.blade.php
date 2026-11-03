@extends('layouts.app')

@section('content')

<div class="container mt-4">
    @if(Session::has('mensaje'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ Session::get('mensaje') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif
    <h2 class="mb-4">Lista de productos</h2>

    <form method="GET" action="{{ route('productos.index') }}" class="mb-4">
        <div class="row g-3">
            <div class="col-md-4">
                <label for="buscar" class="form-label">Nombre del producto</label>
                <input type="text" name="buscar" id="buscar"
                       class="form-control"
                       value="{{ request('buscar') }}"
                       placeholder="Buscar producto...">
            </div>
            <div class="col-md-3">
                <label for="id_categoria" class="form-label">Categoría</label>
                <select name="id_categoria" id="id_categoria" class="form-select">
                    <option value="">Todas las categorías</option>

                    @foreach ($categorias as $categoria)
                        <option value="{{ $categoria->id }}"
                            @selected(request('id_categoria') == $categoria->id)>
                            {{ $categoria->nom_categoria }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-2">
                <label for="estado_producto" class="form-label">Estado</label>
                <select name="estado_producto" id="estado_producto" class="form-select">
                    <option value="">Todos</option>
                    <option value="activo" @selected(request('estado_producto') === 'activo')>
                        Activos
                    </option>
                    <option value="inactivo" @selected(request('estado_producto') === 'inactivo')>
                        Inactivos
                    </option>
                </select>
            </div>
            <div class="col-md-3 d-flex align-items-end gap-2">
                <button type="submit" class="btn btn-info">
                    Buscar
                </button>
                |
                <a href="{{ route('productos.index') }}" class="btn btn-secondary">
                    Limpiar
                </a>
            </div>
        </div>
    </form>

    <div class="table-responsive">
        <table class="table table-bordered table-striped table-hover align-middle">
            <thead class="table-light">
                <tr>
                    <th>ID</th>
                    <th>Foto</th>
                    <th>Nombre</th>
                    <th>Detalle</th>
                    <th>Cantidad</th>
                    <th>Precio</th>
                    <th>Estado</th>
                    <th>Categoría</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($productos as $datos)
                    <tr>
                        <td>{{ $datos->id }}</td>
                        <td>
                            <img src="{{ asset('storage/'.$datos->foto_producto) }}"
                                 alt="Foto del producto"
                                 width="75"
                                 height="60"
                                 style="object-fit: cover;">
                        </td>
                        <td>{{ $datos->nom_producto }}</td>
                        <td>{{ $datos->detalle_producto }}</td>
                        <td>{{ $datos->cant_producto }}</td>
                        <td>${{ number_format($datos->valor_producto, 2) }}</td>
                        <td>{{ $datos->estado_producto }}</td>
                        <td>
                            {{ $datos->categoria?->nom_categoria ?? 'Sin categoría' }}
                        </td>
                        <td>
                            @if (in_array(auth()->user()->rol, ['administrador', 'inventario']))
                                <a href="{{ route('productos.edit', $datos) }}"
                                   class="btn btn-warning btn-sm mb-1">
                                    Editar
                                </a>
                            @endif
                            |
                            <form action="{{ url('/productos/'.$datos->id) }}"
                                  method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                        onclick="return confirm('¿Deseas eliminar el producto?')"
                                        class="btn btn-danger btn-sm">
                                    Eliminar
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="9" class="text-center">
                            No hay productos registrados.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="d-flex justify-content-between align-items-center flex-wrap gap-2 mt-3">
        <div>
            @if (in_array(auth()->user()->rol, ['administrador', 'inventario']))
                <a href="{{ route('productos.create') }}" class="btn btn-success">
                    Registrar nuevo producto
                </a>
            @endif
            <a href="{{ url('/indicadores/') }}" class="btn btn-primary">
                Indicadores
            </a>
        </div>
        <div>
            {{ $productos->links() }}
        </div>
    </div>
</div>
@endsection
