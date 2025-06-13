<?php

namespace App\Http\Controllers\GestionCompraVenta;

use App\Http\Controllers\Controller;
use App\Models\GestionCompraVenta\Categoria;
use App\Models\GestionCompraVenta\Producto;
use Illuminate\Http\Request;

class ProductoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $productos = Producto::paginate(10);
        return view('gestioncompraventa.producto.index', compact('productos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categorias = Categoria::all();
        return view('gestioncompraventa.producto.create', compact('categorias'));
    }
    private function generarCodigoProducto(): string
    {
        // Obtener el último ID existente que empiece con "COD"
        $ultimo = Producto::orderBy('id', 'desc')->first();

        if (!$ultimo) {
            return 'COD001';
        }

        // Extraer la parte numérica del ID: ej. de 'COD015' → 15
        $numero = intval(substr($ultimo->id, 3));

        // Incrementar y formatear con ceros a la izquierda
        $nuevoNumero = str_pad($numero + 1, 3, '0', STR_PAD_LEFT);

        return 'COD' . $nuevoNumero;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $request->validate([
            'nombre' => 'required|string|max:255',
            'descripcion' => 'nullable|string|max:255',
            'precio' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'vencimiento' => 'required|date|after:today',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'categoria_id' => 'required|exists:categoria,id',
        ]);
         $codigo = $this->generarCodigoProducto();
        Producto::create([
        'id' => $codigo,
        'nombre' => $request->nombre,
        'descripcion' => $request->descripcion,
        'precio' => $request->precio,
        'stock' => $request->stock,
        'vencimiento' => $request->vencimiento,
        'foto' => $request->foto,
        'categoria_id' => $request->categoria_id,
    ]);
        return redirect()->route('producto.index')->with('succes', 'Producto Registrado Correctamente');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $categorias = Categoria::all();
        $producto = Producto::findOrFail($id);
        return view('gestioncompraventa.producto.edit', compact('categorias', 'producto'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'descripcion' => 'nullable|string|max:255',
            'precio' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'vencimiento' => 'required|date|after:today',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'categoria_id' => 'required|exists:categoria,id',
        ]);
        $producto = Producto::findOrFail($id);
        $producto->update($request->all());
        return redirect()->route('producto.index')->with('succes', 'Producto Actualizado Correctamente');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $producto = Producto::findOrFail($id);
        $producto->delete();
        return redirect()->route('producto.index')->with('succes', 'Producto Eliminado Correctamente');
    }
}
