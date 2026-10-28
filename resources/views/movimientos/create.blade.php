@extends('layouts.app')
@section('content')

<div class="container">
    <h1>Registrar movimiento</h1>
    <form method="POST" action="{{ route('movimientos.store') }}">
        @csrf
        <label>Producto</label>
        <select name="id_producto" required>
            <option value="">Seleccione</option>
            @foreach ($productos as $producto)
                <option value="{{ $producto->id }}">
                    {{ $producto->nom_producto }} (stock: {{ $producto->cant_producto }})
                </option>
            @endforeach
        </select>

        <label>Tipo</label>
        <select name="tipo" required>
            <option value="entrada">Entrada</option>
            <option value="salida">Salida</option>
        </select>

        <label>Cantidad</label>
        <input type="number" name="cantidad" min="1" required>

        <label>Observacion</label>
        <textarea name="observacion"></textarea>

        <button type="submit" class="btn btn-success">Guardar movimiento</button>
    </form>
</div>