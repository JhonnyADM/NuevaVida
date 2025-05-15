<?php

namespace App\Http\Controllers\GestionMascota;

use App\Http\Controllers\Controller;
use App\Models\GestionarMascota\Estado;
use Illuminate\Http\Request;

class EstadoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $estados = Estado::paginate(10);
        return view('gestionarMascota.estado.index' , compact('estados'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
      return view('gestionarMascota.estado.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'descripcion' => 'required|string|max:255'
        ]);

        Estado::create($request->all());
        return redirect()->route('estado.index')->with('success', 'Estado creada con éxito.');
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
       $estados = Estado::findOrFail($id);
        return view('gestionarmascota.estado.edit', compact('estados'));
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'descripcion' => 'required|string|max:255'
        ]);

        $estado = Estado::findOrFail($id);

        $estado->update($request->all());

        return redirect()->route('estado.index')->with('success', 'Estado actualizado correctamente.');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $estado = Estado::findOrFail($id);
        $estado->delete();
        return redirect()->route('estado.index')->with('success', 'Estado eliminado.');
    }
}
