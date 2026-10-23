@extends('layouts.app')
@section('content')

    <div class="container">
        <h3>FORMULARIO PARA ACTUALIZAR LOS DATOS DE LOS EMPLEADOS</h3>
        <form action="{{url('/empleados/'.$empleado->id)}}" method="post" enctype="multipart/form-data">
            @csrf
            {{method_field('PATCH')}}
            @include('empleados.form',['modo'=>'Actualizar'])
        </form>
    </div>

@endsection