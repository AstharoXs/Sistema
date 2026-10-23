@extends('layouts.app')
@section('content')

    <div class="container">
        <h1>Formulario para crear Empleados</h1>
        <form action="{{url('/empleados')}}" method="post" enctype="multipart/form-data">
            @csrf
            @include('empleados.form',['modo'=>'Guardar'])
        </form>
    </div>

@endsection