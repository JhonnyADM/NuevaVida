<?php

namespace App\Http\Controllers\GestionMascota;

use App\Http\Controllers\Controller;
use App\Models\GestionarMascota\Raza;
use Illuminate\Http\Request;

class RazaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $raza = Raza::paginate(10); // o el número de elementos por página que desees
        return view('GestionarMascota.Raza.index', compact('raza'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('GestionarMascota.Raza.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'descripcion' => 'required|string|max:255'
        ]);

        Raza::create($request->all());
        return redirect()->route('raza.index')->with('success', 'Raza creada con éxito.');
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
        $raza = Raza::findOrFail($id);
        return view('GestionarMascota.Raza.edit', compact('raza'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'descripcion' => 'required|string|max:255'
        ]);

        $raza = Raza::findOrFail($id);

        $raza->update($request->all());

        return redirect()->route('raza.index')->with('success', 'Raza actualizada correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $raza = Raza::findOrFail($id);
        $raza->delete();
        return redirect()->route('raza.index')->with('success', 'Raza eliminada.');
    }
}
