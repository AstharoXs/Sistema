<form action="{{ route('ventas.store') }}" method=""post>
    @csrf

    <div class="container">
        <label>Cliente</label>
        <select name="id_cliente">
            <option value="">Venya sin cliente registrado</option>
            @foreach ($clientesa as $cliente)
                <option value="{{ $cliente->nombre }}"></option>
            @endforeach
        </select>

        @for 
    </div>
</form>