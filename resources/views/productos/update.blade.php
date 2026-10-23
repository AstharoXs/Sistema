@extends('layouts.app')
@section('content')

    <div class="container">
        <h3>FORMULARIO PARA ACTUALIZAR LOS DATOS DE LOS PRODUCTOS</h3>
        <form action="{{url('/productos/'.$producto->id)}}" method="post" enctype="multipart/form-data">
            @csrf
            {{method_field('PATCH')}}
            @include('productos.form',['modo'=>'Actualizar'])
        </form>
    </div>

@endsection