@extends('layouts.app')
@section('content')

<div class="container">
    @if(Session::has('mensaje'))
        <div class="alert alert-success alert-dismissible" role="alert">
            {{Session::get('mensaje')}}
        </div>
    @endif

    <table class="table table-bordered">
        <thead>
            <h1>Movimientos del inventario</h1>
            <tr>
                <th>Producto</th>
                <th>Tipo</th>
                <th>Cantidad</th>
                <th>Usuario</th>
                <th>Observaciones</th>
                <th>Fecha</th>
            </tr>
        </thead>

        <tbody>
            @forelse ($movimientos as $movimiento)
            <tr>
                <td>{{$movimiento->producto?->nom_producto ?? 'Sin producto'}}</td>
                <td>{{$movimiento->tipo}}</td>
                <td>{{$movimiento->cantidad}}</td>
                <td>{{$movimiento->usuario?->name ?? 'Sin usuario'}}</td>
                <td>{{$movimiento->observacion}}</td>
                <td>{{$movimiento->created_at}}</td>
            </tr>
            @empty
                <tr>
                    <td colspan="2">No hay movimientos registrados.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
    <br>
    <a href="{{url('/movimientos/create')}}" class="btn btn-success">
        Registrar nuevo movimiento
    </a>
    <br>
    <br>
    {!! $movimientos->Links() !!}
</div>
@endsection
