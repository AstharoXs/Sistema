@extends('layouts.app')
@section('content')

    <div class="container">
        <h3>FORMULARIO PARA ACTUALIZAR LAS CATEGORIAS</h3>
        <form action="{{url('/categorias/'.$categorias->id)}}" method="post" enctype="multipart/form-data">
            @csrf
            {{method_field('PATCH')}}
            @include('categorias.form',['modo'=>'Actualizar'])
        </form>
    </div>

@endsection