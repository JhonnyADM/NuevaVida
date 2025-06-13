<?php

namespace App\Http\Controllers\GestionTareaCalficacion;

use App\Http\Controllers\Controller;
use App\Models\GestionarMascota\Estado;
use App\Models\GestionTareaCalificacion\Tarea;
use Illuminate\Http\Request;

class TareaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tarea = Tarea::paginate(10);
        return view('GestionarTareasCalificaciones.Tareas.index', compact('tarea'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $estado = Estado::all();
        return view('GestionarTareasCalificaciones.Tareas.create' , compact('estado'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'descripcion' => 'required|string|max:255',
            'fecha' => 'required|date'
        ]);

        Tarea::create($request->all());
        return redirect()->route('tarea.index')->with('success', 'Tarea creada con éxito.');
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
        $tarea = Tarea::findOrFail($id);
        $estados = Estado::all();
        return view('GestionarTareasCalificaciones.Tareas.edit', compact('tarea','estados'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'descripcion' => 'required|string|max:255',
            'fecha' => 'required|date'
        ]);

        $tarea = Tarea::findOrFail($id);

        $tarea->update($request->all());

        return redirect()->route('tarea.index')->with('success', 'Tarea actualizado correctamente.');
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $tarea = tarea::findOrFail($id);
        $tarea->delete();
        return redirect()->route('tarea.index')->with('success', 'Tarea eliminado.');
    }
}
