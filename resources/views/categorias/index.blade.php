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
            <h1>Lista de categorias</h1>
            <tr>
                <th>#</th>
                <th>Nombre</th>
                <th>Accion</th>
            </tr>
        </thead>

        <tbody>
            @foreach ($categorias as $datos)
            <tr>
                <td>{{$datos->id}}</td>
                <td>{{$datos->nom_categoria}}</td>
                <td>
                    <a href="{{url('/categorias/'.$datos->id. '/edit')}}" class="btn btn-warning">
                        Editar
                    </a> 
                    |   
                    <form action="{{url('/categorias/'.$datos->id)}}" method="post" class="d-inline">
                        @csrf
                        {{method_field('DELETE')}}
                        <input type="submit" onclick="return confirm('¿Deseas Eliminar?')" value="Eliminar" class="btn btn-danger">
                    </form>
                </td>
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
