<?php

namespace App\Http\Controllers\GestionMascota;

use App\Http\Controllers\Controller;
use App\Models\GestionarMascota\ControlInternacion;
use App\Models\GestionarMascota\Estado;
use App\Models\GestionarMascota\Internacion;
use App\Models\GestionarMascota\Mascota;
use App\Models\GestionarMascota\Tratamiento;
use Illuminate\Http\Request;

class ControlInternacionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Mascota $mascota, Internacion $tratamiento)
    {
        $controles = ControlInternacion::with('estado')
            ->where('internacion_id', $tratamiento->id)
            ->orderByDesc('fecha')
            ->get();

        return view('GestionarMascota.controlinternacion.index', compact( 'controles','mascota', 'tratamiento'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Mascota $mascota, Internacion $tratamiento)
    {
        $estados = Estado::all();


        return view('GestionarMascota.controlinternacion.create', compact( 'mascota', 'tratamiento', 'estados'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Mascota $mascota, Internacion $tratamiento)
    {
        $request->validate([
            'detalle' => 'required|string',
            'fecha' => 'required|date',
            'estado_id' => 'required|exists:estado,id',
        ]);

        ControlInternacion::create([
            'detalle' => $request->detalle,
            'fecha' => $request->fecha,
            'estado_id' => $request->estado_id,
            'internacion_id' => $tratamiento->id,
        ]);

        return redirect()->route('mascota.internacion.control.index', compact( 'mascota', 'tratamiento'))
            ->with('success', 'Control de internación registrado correctamente.');
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
    public function edit(Mascota $mascota, Internacion $tratamiento, $control)
    {
        $control = ControlInternacion::findOrFail($control);
        $estados = Estado::all();

        return view('GestionarMascota.controlinternacion.edit', compact('control', 'mascota', 'tratamiento', 'estados'));
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,Mascota $mascota, Internacion $tratamiento, $control)
    {
        $request->validate([
            'detalle' => 'required|string',
            'fecha' => 'required|date',
            'estado_id' => 'required|exists:estado,id',
        ]);

        $control = ControlInternacion::findOrFail($control);
        $control->update($request->only('detalle', 'fecha', 'estado_id'));

        return redirect()->route('mascota.internacion.control.index', compact( 'mascota', 'tratamiento'))
            ->with('success', 'Control de internación actualizado correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Mascota $mascota, Internacion $tratamiento, $control)
    {
        $control = ControlInternacion::findOrFail($control);
        $control->delete();

        return redirect()->route('mascota.internacion.control.index', compact( 'mascota', 'tratamiento'))
            ->with('success', 'Control eliminado correctamente.');
    }
}
