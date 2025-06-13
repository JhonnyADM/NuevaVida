<?php

namespace App\Http\Controllers\GestionMascota;

use App\Http\Controllers\Controller;
use App\Models\GestionarMascota\Control;
use App\Models\GestionarMascota\Estado;
use App\Models\GestionarMascota\Mascota;
use App\Models\GestionarMascota\Tratamiento;
use App\Models\GestionPersonal\Cliente;
use Illuminate\Http\Request;

class ControlController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Cliente $cliente, Mascota $mascota, Tratamiento $tratamiento)
    {
        $controles = $tratamiento->controles()->paginate(10);
        // IMPORTANTE: Pasar $mascota a la vista junto con $cliente y $tratamientos
        return view('GestionarMascota.control.index', compact('cliente', 'mascota', 'tratamiento', 'controles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($clienteId, $mascotaId, $tratamientoId)
    {
        $cliente = Cliente::findOrFail($clienteId);
        $mascota = Mascota::findOrFail($mascotaId);
        $tratamiento = Tratamiento::findOrFail($tratamientoId);
        $estados = Estado::all();
        //$controles = Control::with('personal')->get();

        return view('GestionarMascota.control.create', compact('cliente', 'mascota', 'tratamiento', 'estados'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, $mascotaId)
    {
        // dd($request);
        $data = $request->validate([
            'observacion' => 'required|string',
            'fecha' => 'required|date',
            'tratamiento_id' => 'required|exists:tratamiento,id',
            'estado_id' => 'required|exists:estado,id'
        ]);

        $control = Control::create($data);

        // Obtener el cliente relacionado a la mascota
        $mascota = Mascota::findOrFail($mascotaId);
        $clienteId = $mascota->cliente;
        return redirect()->route('cliente.mascota.index', $clienteId->id)
            ->with('success', 'Control de Tratamiento agregado correctamente.');
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
    public function edit($clienteId, $mascotaId, $tratamientoId, $controlId)
    {
        $cliente = Cliente::findOrFail($clienteId);
        $mascota = Mascota::findOrFail($mascotaId);
        $tratamiento = Tratamiento::findOrFail($tratamientoId);
        $control = Control::findOrFail($controlId);
        $estados = Estado::all();

        return view('GestionarMascota.control.edit', compact('cliente', 'mascota', 'tratamiento', 'control', 'estados'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $clienteId, $mascotaId, $tratamientoId, $controlId)
    {
        $data = $request->validate([
            'observacion' => 'required|string',
            'fecha' => 'required|date',
            'estado_id' => 'required|exists:estado,id'
        ]);

        $control = Control::findOrFail($controlId);
        $control->update($data);

        return redirect()->route('cliente.mascota.tratamiento.control.index', [
            'cliente' => $clienteId,
            'mascota' => $mascotaId,
            'tratamiento' => $tratamientoId
        ])->with('success', 'Control de Tratamiento actualizado correctamente.');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($cliente, $mascota, $tratamiento, $control)
    {

        $control = Control::findOrFail($control);
        $control->delete();

        return redirect()->route('cliente.mascota.tratamiento.control.index', [
            'cliente' => $cliente,
            'mascota' => $mascota,
            'tratamiento' => $tratamiento
        ])->with('success', 'Control de Tratamiento eliminado correctamente.');
    }
}
