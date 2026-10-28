<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProductoRequest;
use App\Http\Requests\UpdateProductoRequest;
use App\Models\Producto;
use App\Models\Categoria;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        //
        $consulta = Producto::query()->with('categoria');

        if ($request->filled('buscar')) {
            $consulta->where(
                'nom_producto',
                'like',
                '%'. $request->input('buscar').'%'
            );
        }

        if ($request->filled('id_categoria')) {
            $consulta->where(
                'id_categoria',
                $request->input('id_categoria')
            );
        }

        if ($request->filled('estado_producto')) {
            $consulta->where(
                'estado_producto',
                $request->input('estado_producto')
            );
        }

        $productos = $consulta->orderBy('nom_producto')
            ->paginate(3)
            ->withQueryString();
        
        $categorias = Categoria::orderBy('nom_categoria')->get();

        return view(
            'productos.index',
            compact('productos', 'categorias')
        );

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
    public function store(StoreProductoRequest $request)
    {
        $datos = $request->validated();

        if ($request->hasFile('foto_producto')) {
            $datos['foto_producto'] = $request
                ->file('foto_producto')
                ->store('productos', 'public');
        }
        
        Producto::create($datos);

        return redirect()->route('productos.index')->with('success','Registro ingresado con exito.');
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
        //
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
    public function update(UpdateProductoRequest $request, Producto $producto)
    {
        $datos = $request->validated();

        if ($request->hasFile('foto_producto')) {
            $datos['foto_producto'] = $request
                ->file('foto_producto')
                ->store('productos', 'public');
        } else {
            unset($datos['foto_producto']);
        }

        $producto->update($datos);
        return redirect()->route('productos.index')->with('success','Registro actualizado correctamente.');
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
