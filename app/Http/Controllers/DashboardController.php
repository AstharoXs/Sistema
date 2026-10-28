<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Categoria;
use App\Models\Producto;

class DashboardController extends Controller
{
    public function index()
    {
        $totalProductos = Producto::count();
        $totalCategorias = Categoria::count();

        $productosAgotados = Producto::where(
            'cant_producto', 0
        )->count();

        $productosBajos = Producto::where(
            'cant_producto', '<=', 5
        )->orderBy('cant_producto')->get();

        $valorInventario = Producto::selectRaw(
            'COALESCE(SUM(cant_producto * valor_producto), 0) as total'
        )->value('total');

        return view('indicadores.index', compact(
            'totalProductos',
            'totalCategorias',
            'productosAgotados',
            'productosBajos',
            'valorInventario'
        ));
    }
}
