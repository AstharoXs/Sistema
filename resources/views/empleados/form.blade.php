
    <form action="{{url('/empleados')}}" method="post" enctype="multipart/form-data">
    @csrf
    Formulario que tendra los datos para crear o actualizar los empleados
    <br>
        <div class="form-group">
            <input class="form-control" type="texto" value="{{isset($empleado->Nombres)?$empleado->Nombres:old('Nombres')}}" name="Nombres" id="Nombres" placeholder="Introduzca Nombre">
        </div>
        <br>
        <div class="">
            <input class="form-control" type="texto" value="{{isset($empleado->PrimerApel)?$empleado->PrimerApel:old('PrimerApel')}}" name="PrimerApel" id="PrimerApel" placeholder="Introduzca Primer Apellido">
        </div>
        <br>
        <div class="form-group">
            <input class="form-control" type="texto" value="{{isset($empleado->SegundoApel)?$empleado->SegundoApel:old('SegundoApel')}}" name="SegundoApel" id="SegundoApel" placeholder="Introduzca Segundo Apellido">
        </div>
        <br>
        <div class="form-group">
            <input class="form-control" type="texto" value="{{isset($empleado->Correo)?$empleado->Correo:old('Correo')}}" name="Correo" id="Correo" placeholder="Introduzca correo">
        </div>
        <br>
        <div>
            <input class="form-control" type="file" name="Foto" id="Foto">
            <br>
                @if(isset($empleado->Foto))
                    <img src="{{asset('storage').'/'.$empleado->Foto}}" alt="" width="220" height="120">
                @endif
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
    <a href="{{url('/empleados')}}" class="btn btn-info">
        Regresar
    </a>
