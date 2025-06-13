<?php

namespace App\Http\Controllers\GestionMascota;

use App\Http\Controllers\Controller;
use App\Models\GestionarMascota\TipoTratamiento;
use Illuminate\Http\Request;

class TipoTratamientoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tipo = TipoTratamiento::paginate(10); // o el número de elementos por página que desees
        return view('GestionarMascota.tipotratamiento.index', compact('tipo'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('GestionarMascota.tipotratamiento.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'descripcion' => 'required|string|max:255'
        ]);

        TipoTratamiento::create($request->all());
        return redirect()->route('tipotratamiento.index')->with('success', 'Tipo tratemiento  creada con éxito.');
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
        $tipo = TipoTratamiento::findOrFail($id);
        return view('GestionarMascota.tipotratamiento.edit', compact('tipo'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'descripcion' => 'required|string|max:255'
        ]);

        $tipo = TipoTratamiento::findOrFail($id);

        $tipo->update($request->all());

        return redirect()->route('tipotratamiento.index')->with('success', 'Tipo tratamiento actualizada correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $tipo = TipoTratamiento::findOrFail($id);
        $tipo->delete();
        return redirect()->route('tipotratamiento.index')->with('success', 'Tipo Tratamiento eliminada.');
    }
}
