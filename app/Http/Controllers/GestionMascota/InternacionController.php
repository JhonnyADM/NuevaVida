<?php

namespace App\Http\Controllers\GestionMascota;

use App\Http\Controllers\Controller;
use App\Models\GestionarMascota\Internacion;
use App\Models\GestionarMascota\Mascota;
use App\Models\GestionPersonal\Cliente;
use App\Models\GestionPersonal\Veterinario;
use Illuminate\Http\Request;

class InternacionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(  Mascota $mascota)
    {
        $internaciones = Internacion::paginate(10);

        return view('GestionarMascota.internacion.index', compact('internaciones','mascota'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Mascota $mascota)
    {
        $veterinarios = Veterinario::with('personal')->get();
        return view('GestionarMascota.internacion.create', compact('mascota', 'veterinarios'));
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Mascota $mascota)
    {
        $validated = $request->validate([
            'detalles' => 'required|string',
            'fecha_ingreso' => 'required|date',
            'fecha_salida' => 'nullable|date|after_or_equal:fecha_ingreso',
            'veterinario_id' => 'required|exists:veterinario,id',
        ]);

        $validated['mascota_id'] = $mascota->id;

        Internacion::create($validated);
        $cliente = $mascota->cliente();
        return redirect()->route('cliente.mascota.internacion.index', compact('mascota','cliente'))->with('success', 'Internación registrada correctamente.');
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
    public function edit(Internacion $internacion)
    {
        $veterinarios = Veterinario::with('personal')->get();
        return view('GestionarMascota.internacion.edit', compact('internacion', 'veterinarios'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Internacion $internacion)
    {


        $validated = $request->validate([
            'detalles' => 'required|string',
            'fecha_ingreso' => 'required|date',
            'fecha_salida' => 'nullable|date|after_or_equal:fecha_ingreso',
            'veterinario_id' => 'required|exists:veterinario,id',
        ]);

        $internacion->update($validated);
        $mascota = $internacion->mascota;
        $cliente = $mascota->cliente();
        return redirect()->route('cliente.mascota.internacion.index', compact('mascota','cliente'))->with('success', 'Internación Actualizada correctamente.');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Internacion $internacion)
    {
        $internacion->delete();
        return back()->with('success', 'Internación eliminada correctamente.');
    }
}
