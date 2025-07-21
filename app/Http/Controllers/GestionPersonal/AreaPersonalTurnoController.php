<?php

namespace App\Http\Controllers\GestionPersonal;

use App\Http\Controllers\Controller;
use App\Models\GestionPersonal\Area;
use App\Models\GestionPersonal\AreaPersonalTurno;
use App\Models\GestionPersonal\Atencion;
use App\Models\GestionPersonal\Personal;
use App\Models\GestionPersonal\Turno;
use Illuminate\Http\Request;

class AreaPersonalTurnoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $asignaciones = AreaPersonalTurno::with(['personal.veterinario', 'personal.atencion', 'area', 'turno'])->get();
        return view('Personal.asignaciones.index', compact('asignaciones'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $personales = Personal::with(['veterinario', 'atencion'])
            ->whereHas('veterinario')
            ->orWhereHas('atencion')
            ->get();

        $areas = Area::all();
        $turnos = Turno::all();
        return view('Personal.asignaciones.create', compact('personales', 'areas', 'turnos'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'personal_id' => 'required|exists:personal,id',
            'area_id' => 'required|exists:area,id',
            'turno_id' => 'required|exists:turnos,id',
        ]);

        AreaPersonalTurno::create($request->all());

        return redirect()->route('asignacionesturnos.index')->with('success', 'Asignación creada correctamente.');
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
    public function edit(AreaPersonalTurno $asignacione)
    {
        $personales = Personal::with(['veterinario', 'atencion'])
            ->whereHas('veterinario')
            ->orWhereHas('atencion')
            ->get();

        $areas = Area::all();
        $turnos = Turno::all();
        return view('Personal.asignaciones.edit', compact('asignacione', 'personales', 'areas', 'turnos'));
    }

    public function update(Request $request, AreaPersonalTurno $asignacione)
    {
        $request->validate([
            'personal_id' => 'required|exists:personal,id',
            'area_id' => 'required|exists:area,id',
            'turno_id' => 'required|exists:turnos,id',
        ]);

        $asignacione->update($request->all());

        return redirect()->route('asignacionesturnos.index')->with('success', 'Asignación actualizada correctamente.');
    }

    public function destroy(AreaPersonalTurno $asignacione)
    {
        $asignacione->delete();
        return redirect()->route('asignacionesturnos.index')->with('success', 'Asignación eliminada correctamente.');
    }
}
