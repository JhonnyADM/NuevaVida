<?php

namespace App\Http\Controllers\GestionCompraVenta;

use App\Http\Controllers\Controller;
use App\Models\GestionCompraVenta\Promocion;
use App\Models\GestionCompraVenta\Servicio;
use Illuminate\Http\Request;

class PromocionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
     public function index()
    {
        $promociones = Promocion::with('servicios')->orderByDesc('created_at')->get();
        return view('gestioncompraventa.promocion.index', compact('promociones'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $servicios = Servicio::all();
        return view('gestioncompraventa.promocion.create', compact('servicios'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'detalle' => 'nullable|string',
            'fecha_inicio' => 'required|date',
            'fecha_fin' => 'required|date|after_or_equal:fecha_inicio',
            'estado' => 'required|in:activo,inactivo',
            'descuento' => 'required|numeric|min:0|max:100',
            'servicios' => 'required|array|min:1',
            'servicios.*' => 'exists:servicio,id',
        ]);

        $servicios = Servicio::whereIn('id', $request->servicios)->get();
        $totalPrecio = $servicios->sum('precio');
        $descuento = $request->descuento;
        $totalAPagar = $totalPrecio - ($totalPrecio * ($descuento / 100));

        $promocion = Promocion::create([
            'nombre' => $request->nombre,
            'detalle' => $request->detalle,
            'fecha_inicio' => $request->fecha_inicio,
            'fecha_fin' => $request->fecha_fin,
            'estado' => $request->estado,
            'descuento' => $descuento,
            'total_precio' => $totalPrecio,
            'total_a_pagar' => $totalAPagar,
        ]);

        $promocion->servicios()->sync($request->servicios);

        return redirect()->route('promociones.index')->with('success', 'Promoción registrada correctamente.');
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
    public function edit($id)
    {
        $promocion = Promocion::with('servicios')->findOrFail($id);
        $servicios = Servicio::all(['id', 'nombre', 'precio']);

        return view('gestioncompraventa.promocion.edit', compact('promocion', 'servicios'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'detalle' => 'nullable|string',
            'fecha_inicio' => 'required|date',
            'fecha_fin' => 'required|date|after_or_equal:fecha_inicio',
            'estado' => 'required|in:activo,inactivo',
            'descuento' => 'required|numeric|min:0|max:100',
            'servicios' => 'required|array|min:1',
            'servicios.*' => 'exists:servicio,id',
        ]);

        $promocion = Promocion::findOrFail($id);
        $servicios = Servicio::whereIn('id', $request->servicios)->get();
        $totalPrecio = $servicios->sum('precio');
        $descuento = $request->descuento;
        $totalAPagar = $totalPrecio - ($totalPrecio * ($descuento / 100));

        $promocion->update([
            'nombre' => $request->nombre,
            'detalle' => $request->detalle,
            'fecha_inicio' => $request->fecha_inicio,
            'fecha_fin' => $request->fecha_fin,
            'estado' => $request->estado,
            'descuento' => $descuento,
            'total_precio' => $totalPrecio,
            'total_a_pagar' => $totalAPagar,
        ]);

        $promocion->servicios()->sync($request->servicios);

        return redirect()->route('promociones.index')->with('success', 'Promoción actualizada correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
   public function destroy($id)
    {
        $promocion = Promocion::findOrFail($id);
        $promocion->servicios()->detach();
        $promocion->delete();

        return redirect()->route('promociones.index')->with('success', 'Promoción eliminada correctamente.');
    }
}
