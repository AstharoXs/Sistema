<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use App\Models\Categoria;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $productos = Producto::paginate(3);
        $categorias = Categoria::all();

        return view('productos.index', compact('productos', 'categorias'));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //Acceder a create.blade.php de Productos
        $categorias = Categoria::all();
        $modo = 'Crear';
        $producto = new Producto();

        return view('productos.create', compact(
            'categorias',
            'modo',
            'producto'
        ));

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $msj = [
            'require' => 'El :attribute es requerido',
            'foto_producto.require' => 'La foto es requerida',
            'id_categoria.exists' => 'La categoría seleccionada no existe',
            'estado_producto.in' => 'El estado seleccionado no es válido'
        ];
        
        $datosProducto = $request->validate([
            'nom_producto' => ['required', 'string', 'max:100'],
            'detalle_producto' => ['required', 'string', 'max:100'],
            'cant_producto' => ['required', 'numeric', 'min:0'],
            'valor_producto' => ['required', 'numeric', 'min:0'],
            'foto_producto' => ['required', 'image', 'max:10048'],
            'estado_producto' => ['required', 'in:activo,inactivo', 'max:10048'],
            'id_categoria' => ['required', 'exists:categorias,id'],
        ], $msj);

        // $datosProducto = request()->all();
        $datosProducto = request()->except('_token');

        if ($request->hasFile('foto_producto')) {
            $datosProducto['foto_producto']=$request->file('foto_producto')->store('uploads','public');
        }

        

        Producto::insert($datosProducto);
        // return response()->json($datosProducto);
        return redirect('productos')->with('mensaje','Registro ingresado con exito.');
    }

    /**
     * Display the specified resource.
     */
    public function show(productos $productos)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        //Ñ
        $producto = Producto::findOrFail($id);
        $categorias = Categoria::all();
        $modo = 'Editar';

        return view('productos.update', compact(
            'producto',
            'categorias',
            'modo'
        ));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $msj = [
            'require' => 'El :attribute es requerido',
            'foto_producto.require' => 'La foto es requerida',
            'id_categoria.exists' => 'La categoría seleccionada no existe',
            'estado_producto.in' => 'El estado seleccionado no es válido'
        ];
        
        $datosProducto = $request->validate([
            'nom_producto' => ['required', 'string', 'max:100'],
            'detalle_producto' => ['required', 'string', 'max:100'],
            'cant_producto' => ['required', 'numeric', 'min:0'],
            'valor_producto' => ['required', 'numeric', 'min:0'],
            'foto_producto' => ['required', 'image', 'max:10048'],
            'estado_producto' => ['required', 'in:activo,inactivo', 'max:10048'],
            'id_categoria' => ['required', 'exists:categorias,id'],
        ], $msj);

        if ($request->hasFile('foto_producto')){
            $validacion['foto_producto'] = 'require|max:10000|mimes:jpg,png,jpeg';
            $msj['foto_producto.required'] = 'La Foto es requerida';
        }

        $datos = request()->except(['_token','_method']);
        if($request->hasFile('foto_producto')){
            $datos['foto_producto']=$request->file('foto_producto')->store('uploads','public');
        }

        Producto::where('id','=',$id)->update($datos);
        $productos = Producto::findOrFail($id);
        return redirect('productos')->with('mensaje','Registro actualizado correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //
        $productos = Producto::findOrFail($id);
        if(Storage::delete('public/'.$productos->foto_producto)){
            Producto::destroy($id);
        }

        return redirect('productos')->with('mensaje','Registro eliminado exitosamente.');
    }
}
