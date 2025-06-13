<?php

namespace App\Http\Controllers\GestionCompraVenta;

use App\Http\Controllers\Controller;
use App\Models\GestionCompraVenta\NotaIngreso;
use App\Models\GestionCompraVenta\Producto;
use App\Models\GestionCompraVenta\Provedor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class NotaIngresoController extends Controller
{
    public function index()
    {
        $ingresos = NotaIngreso::with('producto', 'provedor')->latest()->get();
        return view('gestioncompraventa.notaingreso.index', compact('ingresos'));
    }

    public function create()
    {
        $productos = Producto::all();
        $provedores = Provedor::all();
        return view('gestioncompraventa.notaingreso.create', compact('productos', 'provedores'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'provedor_id' => 'required|exists:provedor,id',
            'productos' => 'required|array|min:1',
            'productos.*.producto_id' => 'required|exists:producto,id',
            'productos.*.cantidad' => 'required|numeric|min:1',
            'productos.*.precio' => 'required|numeric|min:0',
            'total' => 'required|numeric|min:0',
        ]);

        DB::beginTransaction();

        try {
            foreach ($request->productos as $item) {
                $subtotal = $item['cantidad'] * $item['precio'];

                NotaIngreso::create([
                    'producto_id' => $item['producto_id'],
                    'provedor_id' => $request->provedor_id,
                    'cantidad' => $item['cantidad'],
                    'fecha' => now(),
                    'total' => $subtotal,
                ]);

                // Actualizar el stock del producto
                $producto = Producto::find($item['producto_id']);
                $producto->stock += $item['cantidad'];
                $producto->save();
            }

            DB::commit();

            return redirect()->route('nota_ingreso.index')
                ->with('success', 'Nota de ingreso registrada exitosamente.');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Ocurrió un error: ' . $e->getMessage());
        }
    }

    public function show(NotaIngreso $nota_ingreso)
    {
        return view('nota_ingreso.show', compact('nota_ingreso'));
    }

    public function edit(NotaIngreso $nota_ingreso)
    {
        // Traer todas las filas que conforman la nota (mismo proveedor y fecha)
        $notas = NotaIngreso::where('provedor_id', $nota_ingreso->provedor_id)
            ->whereDate('fecha', $nota_ingreso->fecha)
            ->with('producto')
            ->get();

        // Convertir explicitamente precio a float para evitar errores en JS
        $productos = Producto::all()->map(function ($p) {
            $p->precio = floatval($p->precio);
            return $p;
        });

        $provedores = Provedor::all();

        $total = $notas->sum(fn($item) => $item->cantidad * $item->producto->precio);

        return view('gestioncompraventa.notaingreso.edit', compact('notas', 'productos', 'provedores', 'total'));
    }




    public function update(Request $request, NotaIngreso $nota_ingreso)
    {
        // Validación básica para arrays
        $request->validate([
            'nota_id' => 'required|array',
            'producto_id' => 'required|array',
            'cantidad' => 'required|array',
            'provedor_id' => 'required|exists:provedor,id',
            'fecha' => 'required|date',
        ]);

        $nota_ids = $request->input('nota_id');
        $producto_ids = $request->input('producto_id');
        $cantidades = $request->input('cantidad');

        // Primero eliminamos las filas que no están en el arreglo (por si se eliminó algún producto)
        $notasActuales = NotaIngreso::where('provedor_id', $request->provedor_id)
            ->whereDate('fecha', $request->fecha)
            ->pluck('id')->toArray();

        $idsParaMantener = array_filter($nota_ids, fn($id) => !is_null($id));

        // Eliminar las filas que no están en el formulario (productos eliminados)
        $idsParaEliminar = array_diff($notasActuales, $idsParaMantener);
        NotaIngreso::destroy($idsParaEliminar);

        // Actualizar o crear cada fila enviada
        foreach ($producto_ids as $key => $producto_id) {
            $cantidad = $cantidades[$key];
            $nota_id = $nota_ids[$key] ?? null;

            // Obtener el precio del producto para calcular total
            $producto = Producto::findOrFail($producto_id);
            $total = $cantidad * $producto->precio;

            if ($nota_id) {
                // Actualizar fila existente
                $nota = NotaIngreso::findOrFail($nota_id);
                $nota->update([
                    'producto_id' => $producto_id,
                    'provedor_id' => $request->provedor_id,
                    'cantidad' => $cantidad,
                    'fecha' => $request->fecha,
                    'total' => $total,
                ]);
            } else {
                // Crear nueva fila (producto agregado)
                NotaIngreso::create([
                    'producto_id' => $producto_id,
                    'provedor_id' => $request->provedor_id,
                    'cantidad' => $cantidad,
                    'fecha' => $request->fecha,
                    'total' => $total,
                ]);
            }
        }

        return redirect()->route('nota_ingreso.index')->with('success', 'Nota de ingreso actualizada correctamente.');
    }



    public function destroy(NotaIngreso $nota_ingreso)
    {
        $nota_ingreso->delete();
        return redirect()->route('nota_ingreso.index')->with('success', 'Nota de ingreso eliminada.');
    }
}
