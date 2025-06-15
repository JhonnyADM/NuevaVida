<?php

namespace App\Http\Controllers\GestionCompraVenta;

use App\Http\Controllers\Controller;
use App\Models\GestionCompraVenta\Servicio;
use Illuminate\Http\Request;

class ServicioController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $servicios = Servicio::paginate(10);
        return view('gestioncompraventa.servicio.index', compact('servicios'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('gestioncompraventa.servicio.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'descripcion' => 'required|string|max:255',
            'precio' => 'required|numeric|min:0',
        ]);
        Servicio::create($request->all());
        return redirect()->route('servicio.index')->with('success', 'Servicio Registrado Exitosamente');
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
        $servicio = Servicio::findOrFail($id);
        return view('gestioncompraventa.servicio.edit', compact('servicio'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'descripcion' => 'required|string|max:255',
            'precio' => 'required|numeric|min:0',
        ]);
        $servicio = Servicio::findOrFail($id);
        $servicio->update($request->all());
        return redirect()->route('servicio.index')->with('success', 'Servicio Actualizado Exitosamente');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $servicio = Servicio::findOrFail($id);
        $servicio->delete();
        return redirect()->route('servicio.index')->with('success', 'Servicio Eliminado Exitosamente');
    }
}
