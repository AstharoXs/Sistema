
@extends('layouts.app')
@section('content')
<div class="container mt-4">
    @if(Session::has('mensaje'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ Session::get('mensaje') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif
    <div class="d-flex justify-content-between align-items-center mb-3">
        <div>
            <h2>Gestión de empleados</h2>
            <p class="text-muted mb-0">Consulta y administra los datos del personal registrado.</p>
        </div>
        <a href="{{ url('/empleados/create') }}" class="btn btn-primary">+ Registrar empleado</a>
    </div>
    <h5 class="mb-3">Personal registrado</h5>
    <div class="table-responsive">
        <table class="table table-bordered table-hover align-middle">
            <thead class="table-light">
                <tr>
                    <th>ID</th>
                    <th>Foto</th>
                    <th>Nombre completo</th>
                    <th>Correo electrónico</th>
                    <th class="text-center">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($empleados as $datos)
                    <tr>
                        <td>{{ $datos->id }}</td>
                        <td>
                            <img src="{{ asset('storage/'.$datos->Foto) }}" alt="Foto del empleado" width="120" height="120" class="rounded" style="object-fit: cover;">
                        </td>
                        <td>
                            <strong>{{ $datos->Nombres }}</strong>
                            <div class="text-muted small">{{ $datos->PrimerApel }} {{ $datos->SegundoApel }}</div>
                        </td>
                        <td>{{ $datos->Correo }}</td>
                        <td class="text-center">
                            <a href="{{ url('/empleados/'.$datos->id.'/edit') }}" class="btn btn-warning btn-sm">Editar</a>
                            <form action="{{ url('/empleados/'.$datos->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" onclick="return confirm('¿Deseas eliminar este empleado?')" class="btn btn-danger btn-sm">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center text-muted">No hay empleados registrados.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="mt-3">
        {{ $empleados->links() }}
    </div>
</div>
@endsection
