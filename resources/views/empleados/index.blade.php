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
            <h1>Lista de datos de los empleados</h1>
            <tr>
                <th>#</th>
                <th>Foto</th>
                <th>Nombre</th>
                <th>Primer Apellido</th>
                <th>Segundo Apellido</th>
                <th>Correo</th>
                <th>Accion</th>
            </tr>
        </thead>

        <tbody>
            @foreach ($empleados as $datos)
            <tr>
                <td>{{$datos->id}}</td>
                <td><img src="{{asset('storage').'/'.$datos->Foto}}" alt="" width="220" height="120"></td>
                <td>{{$datos->Nombres}}</td>
                <td>{{$datos->PrimerApel}}</td>
                <td>{{$datos->SegundoApel}}</td>
                <td>{{$datos->Correo}}</td>
                <td>
                    <a href="{{url('/empleados/'.$datos->id. '/edit')}}" class="btn btn-warning">
                        Editar
                    </a> 
                    |   
                    <form action="{{url('/empleados/'.$datos->id)}}" method="post" class="d-inline">
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
    <a href="{{url('/empleados/create')}}" class="btn btn-success">
        Registrar Nuevo Empleado
    </a>
    <br>
    <br>
    {!! $empleados->Links() !!}
</div>
@endsection
