<?php

namespace App\Http\Controllers\GestionPersonal;

use App\Http\Controllers\Controller;
use App\Models\GestionPersonal\Especialidad;
use Illuminate\Http\Request;

class EspecialidadController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $especialidad = Especialidad::paginate(10); // o el número de elementos por página que desees
        return view('personalmedico.especialidad.index', compact('especialidad'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('personalmedico.especialidad.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'descripcion' => 'required|string|max:255'
        ]);

        Especialidad::create($request->all());
        return redirect()->route('especialidad.index')->with('success', 'Especialidad creada con éxito.');
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
        $especialidad = Especialidad::findOrFail($id);
        return view('personalmedico.especialidad.edit', compact('especialidad'));
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'descripcion' => 'required|string|max:255'
        ]);

        $especialidad = Especialidad::findOrFail($id);

        $especialidad->update($request->all());

        return redirect()->route('especialidad.index')->with('success', 'Especialidad actualizada correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $especialidad = Especialidad::findOrFail($id);
        $especialidad->delete();
        return redirect()->route('especialidad.index')->with('success', 'Especialidad eliminada.');
    }
}
