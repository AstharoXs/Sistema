@extends('layouts.app')
@section('content')

<div class="container">
    @if(Session::has('mensaje'))
        <div class="alert alert-success alert-dismissible" role="alert">
            {{Session::get('mensaje')}}
        </div>
    @endif

    <table class="table table-light">
        <thead class="thead-light">
            <h1>Lista de datos de los productos</h1>
            <tr>
                <th>#</th>
                <th>Foto</th>
                <th>Nombre</th>
                <th>Detalle</th>
                <th>Cantidad</th>
                <th>Precio</th>
                <th>Estado</th>
                <th>Categoria</th>
                <th>Accion</th>
            </tr>
        </thead>

        <tbody>
            @foreach ($productos as $datos)
            <tr>
                <td>{{$datos->id}}</td>
                <td><img src="{{asset('storage').'/'.$datos->foto_producto}}" alt="" width="220" height="120"></td>
                <td>{{$datos->nom_producto}}</td>
                <td>{{$datos->detalle_producto}}</td>
                <td>{{$datos->cant_producto}}</td>
                <td>{{$datos->valor_producto}}</td>
                <td>{{$datos->estado_producto}}</td>
                <td>{{$datos->categoria?->nom_categoria ?? 'Sin Categoria'}}</td>
                <td>
                    <a href="{{url('/productos/'.$datos->id. '/edit')}}" class="btn btn-warning">
                        Editar
                    </a> 
                    |   
                    <form action="{{url('/productos/'.$datos->id)}}" method="post" class="d-inline">
                        @csrf
                        {{method_field('DELETE')}}
                        <input type="submit" onclick="return confirm('¿Deseas Eliminar el Producto?')" value="Eliminar" class="btn btn-danger">
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <br>
    <a href="{{url('/productos/create')}}" class="btn btn-success">
        Registrar Nuevo Producto
    </a>
    <br>
    <br>
    {!! $productos->Links() !!}
</div>
@endsection
