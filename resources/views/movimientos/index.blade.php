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
            @foreach ($categorias as $datos)
            <tr>
                <td>{{$datos->id}}</td>
                <td>{{$datos->nom_categoria}}</td>
                <td></td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <br>
    <a href="{{url('/categorias/create')}}" class="btn btn-success">
        Registrar Nueva Categoria
    </a>
    <br>
    <br>
    {!! $categorias->Links() !!}
</div>
@endsection
