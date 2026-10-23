<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use Illuminate\Http\Request;

class CategoriaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $listado['categorias'] = Categoria::paginate(3);

        return view('categorias.index', $listado);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //Acceder a create.blade.php de categorias
        return view('categorias.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $msj = [
            'require' => 'El :attribute es requerido',
        ];
        
        $datosCategoria = $request->validate([
            'nom_categoria' => ['required', 'string', 'max:100']
        ], $msj);

        // $datosCategoria = request()->all();
        $datosCategoria = request()->except('_token');

        Categoria::insert($datosCategoria);
        // return response()->json($datosCategoria);
        return redirect('categorias')->with('mensaje','Registro ingresado con exito.');
    }

    /**
     * Display the specified resource.
     */
    public function show(categorias $categorias)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        //
        $categorias = Categoria::findOrFail($id);
        return view('categorias.update', compact('categorias'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $msj = [
            'require' => 'El :attribute es requerido'
        ];
        
        $datosCategoria = $request->validate([
            'nom_categoria' => ['required', 'string', 'max:100'],
        ], $msj);

        $datos = request()->except(['_token','_method']);

        Categoria::where('id','=',$id)->update($datos);
        $categorias = Categoria::findOrFail($id);
        return redirect('categorias')->with('mensaje','Registro actualizado correctamente.');;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //
        $categorias = Categoria::findOrFail($id);
        return redirect('categorias')->with('mensaje','Ctegoria eliminada exitosamente.');
    }
}
