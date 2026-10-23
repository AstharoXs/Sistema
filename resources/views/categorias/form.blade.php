
    <form action="{{url('/categorias')}}" method="post" enctype="multipart/form-data">
    @csrf
    Formulario que tendra los datos para crear o actualizar las categorias
    <br>
        <div class="form-group">
            <input class="form-control" type="texto" value="{{isset($categoria->nom_categoria)?$categoria->nom_categoria:old('nom_categoria')}}" name="nom_categoria" id="nom_categoria" placeholder="Introduzca Nombre">
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
    <a href="{{url('/categorias')}}" class="btn btn-info">
        Regresar
    </a>
