@extends('layouts.app')
@section('content')

    <div class="container">
        <h1>Formulario para crear Categorias</h1>
        <form action="{{url('/categorias')}}" method="post" enctype="multipart/form-data">
            @csrf
            @include('categorias.form',['modo'=>'Guardar'])
        </form>
    </div>  

@endsection