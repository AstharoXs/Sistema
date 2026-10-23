<?php

namespace App\Http\Controllers;

use App\Models\empleado;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class EmpleadoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $listado['empleados'] = empleado::paginate(3);

        return view('empleados.index', $listado);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //Acceder a create.blade.php de la vista para crear los empleados
        return view('empleados.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $msj = [
            'require' => 'El :attribute es requerido',
            'Foto.require' => 'La foto es requerida'
        ];
        
        $datosEmpleado = $request->validate([
            'Nombres' => ['required', 'string', 'max:100'],
            'PrimerApel' => ['required', 'string', 'max:100'],
            'SegundoApel' => ['required', 'string', 'max:100'],
            'Correo' => ['required', 'email', 'max:100'],
            'Foto' => ['required', 'image', 'max:10048'],
        ], $msj);

        // $datosEmpleado = request()->all();
        $datosEmpleado = request()->except('_token');

        if ($request->hasFile('Foto')) {
            $datosEmpleado['Foto']=$request->file('Foto')->store('uploads','public');
        }

        empleado::insert($datosEmpleado);
        // return response()->json($datosEmpleado);
        return redirect('empleados')->with('mensaje','Registro ingresado con exito.');

    }

    /**
     * Display the specified resource.
     */
    public function show(empleado $empleado)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        //
        $empleado = empleado::findOrFail($id);
        return view('empleados.update', compact('empleado'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $msj = [
            'require' => 'El :attribute es requerido',
            'Foto.require' => 'La foto es requerida'
        ];
        
        $datosEmpleado = $request->validate([
            'Nombres' => ['required', 'string', 'max:100'],
            'PrimerApel' => ['required', 'string', 'max:100'],
            'SegundoApel' => ['required', 'string', 'max:100'],
            'Correo' => ['required', 'email', 'max:100'],
            'Foto' => ['required', 'image', 'max:10048'],
        ], $msj);

        if ($request->hasFile('Foto')){
            $validacion['Foto'] = 'require|max:10000|mimes:jpg,png,jpeg';
            $msj['Foto.required'] = 'La Foto es requerida';
        }

        $datos = request()->except(['_token','_method']);
        if($request->hasFile('Foto')){
            $datos['Foto']=$request->file('Foto')->store('uploads','public');
        }

        empleado::where('id','=',$id)->update($datos);
        $empleado = empleado::findOrFail($id);
        return redirect('empleados')->with('mensaje','Registro actualizado correctamente.');

    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //
        $empleado = empleado::findOrFail($id);
        if(Storage::delete('public/'.$empleado->Foto)){
            empleado::destroy($id);
        }

        return redirect('empleados')->with('mensaje','Registro eliminado exitosamente.');
    }
}
