@extends('layouts.app')
@section('content')

<div class="container">
    @if(Session::has('mensaje'))
        <div class="alert alert-success alert-dismissible" role="alert">
            {{Session::get('mensaje')}}
        </div>
    @endif

    <form method="GET" action="{{route('productos.index')}}">
        <label for="buscar">Nombre del producto</label>
        <input type="text" name="buscar" id="buscar" value="{{request('buscar')}}">
        <label for="id_categoria">Categoria</label>
        <select name="id_categoria" id="id_categoria">
            <option value="">Todas las categorias</option>
            @foreach ($categorias as $categoria)
                <option value="{{$categoria->id}}" @selected(request('id_categoria') == $categoria->id)>
                    {{$categoria->nom_categoria}}
                </option>
            @endforeach
        </select>

        <label for="estado_producto">Estado</label>
        <select name="estado_producto" id="estado_producto">
            <option value="">Todos</option>
            <option value="activo" @selected(request('estado_producto') === '1')>Activos</option>
            <option value="inactivo" @selected(request('estado_producto') === '0')>Inactivos</option>
        </select>

        <button type="submit" class="btn btn-info">Buscar</button>
        |
        <a href="{{route('productos.index')}}" class="btn btn-warning">Limpiar</a>
    </form>
    <br>
    <br>
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
                    @if (in_array(auth()->user()->rol, ['administrador', 'inventario']))
                    <a href="{{route('productos.edit', $datos)}}" class="btn btn-warning">
                        Editar
                    </a>
                    @endif
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
    @if (in_array(auth()->user()->rol, ['administrador', 'inventario']))
    <a href="{{route('productos.create')}}" class="btn btn-success">
        Registrar Nuevo Producto
    </a>
    @endif
    |
    <a href="{{url('/indicadores/')}}" class="btn btn-success">
        Indicadores
    </a>
    <br>
    <br>
    {!! $productos->Links() !!}
</div>
@endsection
