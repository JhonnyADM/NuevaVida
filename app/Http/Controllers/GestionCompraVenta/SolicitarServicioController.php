<?php

namespace App\Http\Controllers\GestionCompraVenta;

use App\Http\Controllers\Controller;
use App\Models\GestionarMascota\Mascota;
use Illuminate\Support\Facades\DB;
use App\Models\GestionCompraVenta\Detalle;
use App\Models\GestionCompraVenta\Producto;
use App\Models\GestionCompraVenta\Promocion;
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
        $promociones = Promocion::with('servicios')->where('estado', 'activo')->get();

        return view('gestioncompraventa.solicitarservicio.create', compact('cliente', 'mascotas', 'productos', 'servicios', 'atencion', 'promociones'));
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
            'cantidades.*' => 'integer|min:1',
            'promocion_id' => 'nullable|exists:promocion,id',
            'descripcion' => 'nullable|string|max:255',
        ]);

        DB::beginTransaction();
        try {
            $total = 0;
            $promocion = null;

            if ($request->filled('promocion_id')) {
                $promocion = Promocion::with('servicios')->findOrFail($request->promocion_id);
                $total += $promocion->total_a_pagar;
            }

            $recibo = Recibo::create([
                'cliente_id' => $request->cliente_id,
                'atencion_id' => $request->atencion_id,
                'mascota_id' => $request->mascota_id,
                'promocion_id' => $promocion->id ?? null,
                'descripcion' => $request->descripcion,
                'fecha' => now(),
                'total' => 0
            ]);


            // Servicios adicionales seleccionados
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

            // Productos usados
            if ($request->has('productos')) {
                foreach ($request->productos as $index => $productoId) {
                    $cantidad = intval($request->cantidades[$index] ?? 1);
                    $producto = Producto::findOrFail($productoId);
                    $subtotal = $producto->precio * $cantidad;
                    $total += $subtotal;

                    $recibo->productos()->attach($producto->id, [
                        'cantidad' => $cantidad,
                        'subtotal' => $subtotal,
                    ]);
                }
            }

            // Actualizar total final
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
        $recibo = Recibo::with([
            'mascota',
            'cliente.mascotas',
            'servicios',
            'productos',
            'promocion.servicios'
        ])->findOrFail($id);

        $mascotas = $recibo->cliente->mascotas ?? collect();
        $servicios = Servicio::all();
        $productos = Producto::all();
        $promociones = Promocion::with('servicios')->where('estado', 'activo')->get();

        return view('gestioncompraventa.solicitarservicio.edit', compact(
            'recibo',
            'mascotas',
            'servicios',
            'productos',
            'promociones'
        ));
    }






    public function update(Request $request, $id)
    {
        $request->validate([
            'mascota_id'             => 'required|exists:mascota,id',
            'promocion_id'           => 'nullable|exists:promocion,id',
            'descripcion'            => 'nullable|string|max:255',
            'servicios_adicionales'  => 'nullable|array',
            'servicios_adicionales.*' => 'exists:servicio,id',
            'productos'              => 'nullable|array',
            'productos.*'            => 'exists:producto,id',
            'cantidades'             => 'nullable|array',
            'cantidades.*'           => 'integer|min:1',
        ]);

        DB::beginTransaction();
        try {
            $recibo = Recibo::findOrFail($id);

            // 🔄 Actualizar datos básicos
            $recibo->update([
                'mascota_id'   => $request->mascota_id,
                'descripcion'  => $request->descripcion,
                'promocion_id' => $request->promocion_id,
            ]);

            // 🔄 Limpiar asociaciones antiguas
            $recibo->servicios()->detach();
            $recibo->productos()->detach();

            $totalServiciosAdicionales = 0;
            $totalProductos = 0;
            $totalPromocion = 0;

            // ✅ Registrar servicios adicionales
            if ($request->has('servicios_adicionales')) {
                foreach ($request->servicios_adicionales as $servicioId) {
                    $servicio = Servicio::findOrFail($servicioId);
                    $totalServiciosAdicionales += $servicio->precio;

                    $recibo->servicios()->attach($servicio->id);
                }
            }

            // ✅ Registrar productos utilizados
            $productosSync = [];
            if ($request->productos && $request->cantidades) {
                foreach ($request->productos as $i => $productoId) {
                    $cantidad = $request->cantidades[$i] ?? 0;
                    if ($cantidad > 0) {
                        $producto = Producto::findOrFail($productoId);
                        $subtotal = $producto->precio * $cantidad;
                        $totalProductos += $subtotal;

                        $productosSync[$productoId] = [
                            'cantidad'   => $cantidad,
                            'subtotal'   => $subtotal,
                            'created_at' => now(),
                            'updated_at' => now(),
                        ];
                    }
                }

                if (!empty($productosSync)) {
                    $recibo->productos()->sync($productosSync);
                }
            }

            // ✅ Total por promoción (si aplica)
            if ($request->filled('promocion_id')) {
                $promocion = Promocion::findOrFail($request->promocion_id);
                $totalPromocion = $promocion->total_a_pagar;
            }

            // ✅ Actualizar el total general del recibo
            $recibo->update([
                'total' => $totalServiciosAdicionales + $totalProductos + $totalPromocion,
            ]);

            DB::commit();
            return redirect()->route('solicitar-servicio.index')->with('success', 'Recibo actualizado correctamente.');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withInput()->with('error', 'Error al actualizar recibo: ' . $e->getMessage());
        }
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
