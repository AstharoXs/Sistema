@extends('layouts.app')
@section('content')

    <div class="container">
        <h1>Formulario para Registrar Productos</h1>
        <form action="{{url('/productos')}}" method="post" enctype="multipart/form-data">
            @csrf
            @include('productos.form',['modo'=>'Guardar'])
        </form>
    </div>

@endsection