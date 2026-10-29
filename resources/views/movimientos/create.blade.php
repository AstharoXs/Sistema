@extends('layouts.app')

@section('content')

<div class="container mt-4">
    <h1 class="mb-4">Registrar movimiento</h1>

    <div class="card shadow-sm">
        <div class="card-body">

            <form method="POST" action="{{ route('movimientos.store') }}">
                @csrf

                <div class="mb-3">
                    <label for="id_producto" class="form-label">
                        Producto
                    </label>

                    <select name="id_producto" id="id_producto"
                            class="form-select" required>
                        <option value="">Seleccione un producto</option>

                        @foreach ($productos as $producto)
                            <option value="{{ $producto->id }}">
                                {{ $producto->nom_producto }}
                                (Stock: {{ $producto->cant_producto }})
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label for="tipo" class="form-label">
                        Tipo de movimiento
                    </label>

                    <select name="tipo" id="tipo"
                            class="form-select" required>
                        <option value="entrada">Entrada</option>
                        <option value="salida">Salida</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label for="cantidad" class="form-label">
                        Cantidad
                    </label>

                    <input type="number" name="cantidad" id="cantidad"
                           class="form-control" min="1" required>
                </div>

                <div class="mb-3">
                    <label for="observacion" class="form-label">
                        Observaciones
                    </label>

                    <textarea name="observacion" id="observacion"
                              class="form-control" rows="3"></textarea>
                </div>

                <button type="submit" class="btn btn-info">
                    Guardar movimiento
                </button>

                <a href="{{ route('movimientos.index') }}"
                   class="btn btn-danger">
                    Cancelar
                </a>

            </form>

        </div>
    </div>
</div>

@endsection
