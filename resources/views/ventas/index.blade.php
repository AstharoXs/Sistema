
@extends('layouts.app')

@section('content')
<div class="container">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Listado de ventas</h2>
    </div>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="card">
        <div class="card-body">

            <div class="table-responsive">
                <table class="table table-bordered table-striped">

                    <thead>
                        <tr>
                            <th>N° Venta</th>
                            <th>Fecha</th>
                            <th>Cliente</th>
                            <th>Usuario</th>
                            <th>Total</th>
                            <th>Estado</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse($ventas as $venta)
                            <tr>
                                <td>{{ $venta->id }}</td>
                                <td>{{ $venta->fecha }}</td>
                                <td>{{ $venta->cliente->nombre ?? 'Sin cliente' }}</td>
                                <td>{{ $venta->usuario->name ?? 'No disponible' }}</td>
                                <td>${{ number_format($venta->total, 2) }}</td>
                                <td>{{ ucfirst($venta->estado) }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center">
                                    No hay ventas registradas.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
                <a href="{{ route('ventas.create') }}" class="btn btn-primary">
                    Nueva venta
                </a>
            </div>
            {{ $ventas->links() }}
        </div>
    </div>
</div>
@endsection
