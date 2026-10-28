@extends('layouts.app')
@section('content')

<div class="container">
    <h1>Resumen del inventario</h1>
    <br>
    <p>Total de productos: {{ $totalProductos }}</p>
    <p>Total de categorias: {{ $totalCategorias }}</p>
    <p>Productos agotados: {{ $productosAgotados }}</p>
    <p>VAlor estimado: ${{ number_format($valorInventario, 2) }}</p>

    <h2>Productos con 5 unidades o menos</h2>
    <table class="table">
        <thead>
            <tr>
                <th>Producto</th>
                <th>Existencias</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($productosBajos as $producto)
            <tr>
                <td>{{ $producto->nom_producto }}</td>
                <td>{{ $producto->cant_producto }}</td>
            </tr>
            @empty
                <tr>
                    <td colspan="2">No hay alertas de stock bajo.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
    <a href="{{url('/productos')}}" class="btn btn-info">
        Regresar
    </a>
</div>
@endsection