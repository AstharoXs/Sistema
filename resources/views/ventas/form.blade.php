@extends('layouts.app')

@section('content')

<div class="container mt-4">
    <h2 class="mb-4">Registrar venta</h2>
    <form action="{{ route('ventas.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label class="form-label">Cliente</label>
            <select name="id_cliente" class="form-select">
                <option value="">Venta sin cliente registrado</option>
                @foreach ($clientes as $cliente)
                    <option value="{{ $cliente->id }}">
                        {{ $cliente->nombre }}
                    </option>
                @endforeach
            </select>
        </div>
        <hr>
        <h5 class="mb-3">Productos</h5>

        @for ($i = 0; $i < 3; $i++)
            <fieldset class="border rounded p-3 mb-3">
                <legend class="float-none w-auto px-2 fs-6">
                    Producto {{ $i + 1 }}
                </legend>
                <div class="row">
                    <div class="col-md-8 mb-3">
                        <label class="form-label">Producto</label>
                        <select
                            name="productos[{{ $i }}][id_producto]"
                            class="form-select">
                            <option value="">Seleccione producto</option>
                            @foreach ($productos as $producto)
                                <option value="{{ $producto->id }}">
                                    {{ $producto->nom_producto }} -
                                    ${{ $producto->valor_producto }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label">Cantidad</label>
                        <input
                            type="number"
                            name="productos[{{ $i }}][cantidad]"
                            class="form-control"
                            min="1"
                            placeholder="Cantidad">
                    </div>
                </div>
            </fieldset>
        @endfor
        <button type="submit" class="btn btn-primary">
            Registrar venta
        </button>
        |
        <a href="{{ route('ventas.index') }}" class="btn btn-secondary">
            Cancelar
        </a>
    </form>
</div>
@endsection
