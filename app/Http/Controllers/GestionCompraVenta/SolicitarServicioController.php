<?php

namespace App\Http\Controllers\GestionCompraVenta;

use App\Http\Controllers\Controller;
use App\Models\GestionarMascota\Mascota;
use Illuminate\Support\Facades\DB;
use App\Models\GestionCompraVenta\Detalle;
use App\Models\GestionCompraVenta\Producto;
use App\Models\GestionCompraVenta\Recibo;
use App\Models\GestionCompraVenta\Servicio;
use App\Models\GestionCompraVenta\SolicitarServicio;
use App\Models\GestionPersonal\Atencion;
use App\Models\GestionPersonal\Cliente;
use Illuminate\Http\Request;

class SolicitarServicioController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $recibos = Recibo::with(['cliente', 'mascota', 'servicios'])
            ->orderByDesc('id')
            ->paginate(10);

        return view('gestioncompraventa.solicitarservicio.index', compact('recibos'));
    }


    public function solicitarServicio()
    {
        $clientes = Cliente::whereHas('personal', function ($query) {
            $query->where('tipo', 'cliente');
        });
        $atencion = Atencion::whereHas('personal', function ($query) {
            $query->where('tipo', 'atencion');
        })->with('personal');
        return view('gestioncompraventa.solicitarservicio.asigancioncliente', compact('clientes', 'atencion'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {

        // Obtienes el cliente_id enviado desde la vista anterior
        $clienteId = $request->query('cliente_id');
        $atencionId = $request->query('atencion_id');
        if (!$clienteId) {
            // Si no hay cliente seleccionado, puedes redirigir o mostrar error
            return redirect()->route('solicitar-servicio.seleccionar-cliente')
                ->with('error', 'Debe seleccionar un cliente primero.');
        }
        if (!$atencionId) {
            // Si no hay cliente seleccionado, puedes redirigir o mostrar error
            return redirect()->route('solicitar-servicio.seleccionar-cliente')
                ->with('error', 'Debe seleccionar un Personal se atencion primero.');
        }
        $cliente = Cliente::findOrFail($clienteId);
        $atencion = Atencion::findOrFail($atencionId);
        $mascotas = $cliente->mascotas()->get();
        $productos = Producto::all();
        $servicios = Servicio::all();

        return view('gestioncompraventa.solicitarservicio.create', compact('cliente', 'mascotas', 'productos', 'servicios', 'atencion'));
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'cliente_id' => 'required|exists:cliente,id',
            'atencion_id' => 'required|exists:atencion,id',
            'mascota_id' => 'required|exists:mascota,id',
            'servicios' => 'nullable|array',
            'servicios.*' => 'exists:servicio,id',
            'productos' => 'nullable|array',
            'productos.*' => 'exists:producto,id',
            'cantidades' => 'nullable|array',
            'cantidades.*' => 'integer|min:1'
        ]);

        DB::beginTransaction();
        try {
            // 1. Crear el recibo vacío
            $recibo = Recibo::create([
                'cliente_id' => $request->cliente_id,
                'atencion_id' => $request->atencion_id,
                'mascota_id' => $request->mascota_id,
                'fecha' => now(),
                'total' => 0 // se calculará después
            ]);

            $total = 0;

            // 2. Registrar servicios (tabla pivot solicitar_servicio)
            if ($request->has('servicios')) {
                foreach ($request->servicios as $servicioId) {
                    $servicio = Servicio::findOrFail($servicioId);
                    $total += $servicio->precio;

                    SolicitarServicio::create([
                        'recibo_id' => $recibo->id,
                        'servicio_id' => $servicio->id,
                    ]);
                }
            }

            // 3. Registrar productos (tabla pivot detalle)
            if ($request->has('productos')) {
                foreach ($request->productos as $index => $productoId) {
                    $cantidad = intval($request->cantidades[$index] ?? 1);
                    $producto = Producto::findOrFail($productoId);
                    $subtotal = $producto->precio * $cantidad;
                    $total += $subtotal;

                    // Puedes usar attach si tienes relación belongsToMany
                    $recibo->productos()->attach($producto->id, [
                        'cantidad' => $cantidad,
                        'subtotal' => $subtotal,
                    ]);
                }
            }

            // 4. Actualizar total en el recibo
            $recibo->update(['total' => $total]);

            DB::commit();
            return redirect()->route('solicitar-servicio.index')->with('success', 'Atención registrada correctamente.');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withInput()->with('error', 'Error al registrar atención: ' . $e->getMessage());
        }
    }




    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $recibo = Recibo::with([
            'cliente.personal',
            'mascota',
            'servicios',
            'productos' => function ($q) {
                $q->withPivot('cantidad', 'subtotal');
            }
        ])->findOrFail($id);

        return view('gestioncompraventa.solicitarservicio.show', compact('recibo'));
    }




    /**
     * Show the form for editing the specified resource.
     */
    // Importa modelos arriba del controlador


    public function edit($id)
    {
        // Carga el recibo con las relaciones servicios y productos (detalle)
        $recibo = Recibo::with([
            'mascota',
            'cliente',
            'servicios',
            'productos'  // productos con pivot cantidad y subtotal
        ])->findOrFail($id);

        // Todas las mascotas del cliente para el select
        $mascotas = $recibo->cliente->mascotas ?? collect();

        // Todos los servicios y productos para seleccionar
        $servicios = Servicio::all();
        $productos = Producto::all();

        return view('gestioncompraventa.solicitarservicio.edit', compact('recibo', 'mascotas', 'servicios', 'productos'));
    }



    public function update(Request $request, $id)
    {
        $request->validate([
            'mascota_id' => 'required|exists:mascota,id',
            'servicios' => 'required|array|min:1',
            'servicios.*' => 'exists:servicio,id',
            'productos' => 'nullable|array',
            'productos.*' => 'exists:producto,id',
            'cantidades' => 'nullable|array',
            'cantidades.*' => 'integer|min:1',
        ]);

        $recibo = Recibo::findOrFail($id);

        // Actualiza la mascota
        $recibo->mascota_id = $request->mascota_id;
        $recibo->save();

        // Sincroniza servicios (tabla pivote solicitar_servicio)
        $recibo->servicios()->sync($request->servicios);

        // Actualiza productos con cantidades y subtotal (tabla pivote detalle)
        // Sincronizar muchos a muchos con campos adicionales requiere formato especial
        $productosSync = [];

        if ($request->productos && $request->cantidades) {
            foreach ($request->productos as $index => $producto_id) {
                $cantidad = $request->cantidades[$index] ?? 0;
                if ($cantidad > 0) {
                    $producto = Producto::find($producto_id);
                    if ($producto) {
                        $subtotal = $producto->precio * $cantidad;
                        $productosSync[$producto_id] = [
                            'cantidad' => $cantidad,
                            'subtotal' => $subtotal,
                            'created_at' => now(),
                            'updated_at' => now(),
                        ];
                    }
                }
            }
        }

        // Si productosSync no está vacío, sincroniza con tabla pivote 'detalle', sino desvincula todos productos
        $recibo->productos()->sync($productosSync);

        // Recalcular y guardar el total en recibo
        $totalServicios = $recibo->servicios->sum('precio');
        $totalProductos = collect($productosSync)->sum('subtotal');
        $recibo->total = $totalServicios + $totalProductos;
        $recibo->save();

        return redirect()->route('solicitar-servicio.index')
            ->with('success', 'Atención actualizada correctamente.');
    }




    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $recibo = Recibo::findOrFail($id);

        // Elimina el recibo y, gracias a la configuración de cascada, se eliminarán:
        // - los registros de solicitar_servicio
        // - los registros de detalle
        $recibo->delete();

        return redirect()->route('solicitar-servicio.index')
            ->with('success', 'Recibo y registros asociados eliminados correctamente.');
    }
}
