    <form action="{{url('/productos')}}" method="post" enctype="multipart/form-data">
    @csrf
    Formulario que tendra los datos para registrar o actualizar los productos
    <br>
        <div class="form-group">
            <input class="form-control" type="texto" value="{{isset($producto->nom_producto)?$producto->nom_producto:old('nom_producto')}}" name="nom_producto" id="nom_producto" placeholder="Introduzca Nombre">
            @error('nom_producto')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <br>
        <div class="">
            <input class="form-control" type="texto" value="{{isset($producto->detalle_producto)?$producto->detalle_producto:old('detalle_producto')}}" name="detalle_producto" id="detalle_producto" placeholder="Descripcion o detalle">
        </div>
        <br>
        <div class="form-group">
            <input class="form-control" type="number" value="{{isset($producto->cant_producto)?$producto->cant_producto:old('cant_producto')}}" name="cant_producto" id="cant_producto" placeholder="Cantidad">
            @error('cant_producto')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <br>
        <div class="form-group">
            <input class="form-control" type="number" value="{{isset($producto->valor_producto)?$producto->valor_producto:old('valor_producto')}}" name="valor_producto" id="valor_producto" placeholder="Costo">
            @error('valor_producto')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <br>
        <div>
            <input class="form-control" type="file" name="foto_producto" id="foto_producto" accept=".jpg, .jpeg, .png, .webp">
            @error('foto_producto')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            <br>
                @if(isset($producto->foto_producto))
                    <img src="{{asset('storage').'/'.$producto->foto_producto}}" alt="" width="220" height="120">
                @endif
        </div>

        <div class="form-group">
            <label for="id_categoria">Seleccione la categoria del producto</label>
            <select class="form-control" name="id_categoria" id="id_categoria">
                <option value="">Seleccione</option>
                @foreach($categorias as $categoria)
                    <option value="{{$categoria->id}}" @selected(old('id_categoria', $producto->id_categoria ?? '') == $categoria->id)>{{$categoria->nom_categoria}}</option>
                @endforeach
            </select>
            @error('id_categoria')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <br>
        <div class="form-group">
            <label for="estado_producto">Estado</label>
            <select id="estado_producto" name="estado_producto" class="form-control" required>
                <option value="">Seleccione</option>
                <option value="activo" <?= ($data['estado_producto'] ?? 'activo') === 'activo' ? 'selected' : '' ?>>Activo</option>
                <option value="inactivo" <?= ($data['estado_producto'] ?? 'inactivo') === 'inactivo' ? 'selected' : '' ?>>Inactivo</option>
            </select>
        </div>  
        <br>
        <input type="submit" value="{{$modo}} Registro" class="btn btn-warning">
    </form>
    <br>
    @if(count($errors)>0)
        <div class="alert alert-danger" role="alert">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{$error}}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <a href="{{url('/productos')}}" class="btn btn-info">
        Regresar
    </a>
