<?php

namespace App\Http\Controllers\GestionMascota;

use App\Http\Controllers\Controller;
use App\Models\GestionarMascota\Mascota;
use App\Models\GestionarMascota\TipoTratamiento;
use App\Models\GestionarMascota\Tratamiento;
use App\Models\GestionPersonal\Cliente;
use App\Models\GestionPersonal\Veterinario;
use Illuminate\Http\Request;

class TratamientoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Cliente $cliente, Mascota $mascota)
    {

        // Validar que la mascota pertenece al cliente (por seguridad)
        if ($mascota->cliente_id != $cliente->id) {
            abort(404);
        }


        // Cargar los tratamientos con la relación del tipo de tratamiento (si la tienes)
        $tratamientos = $mascota->tratamientos()->with('tipoTratamiento')->paginate(10);

        // IMPORTANTE: Pasar $mascota a la vista junto con $cliente y $tratamientos
        return view('GestionarMascota.Tratamiento.index', compact('cliente', 'mascota', 'tratamientos'));
    }


    /**
     * Show the form for creating a new resource.
     */
   public function create($clienteId, $mascotaId)
{
    $cliente = Cliente::findOrFail($clienteId);
    $mascota = Mascota::findOrFail($mascotaId);
    $tiposTratamiento = TipoTratamiento::all();
    $veterinarios = Veterinario::with('personal')->get();

    return view('GestionarMascota.tratamiento.create', compact('cliente', 'mascota', 'tiposTratamiento', 'veterinarios'));
}

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $data = $request->validate([
            'detalles' => 'required|string',
            'fecha' => 'required|date',
            'tipo_tratamiento_id' => 'required|exists:tipo_tratamiento,id',
            'veterinario_id' => 'required|exists:veterinario,id',
            'mascota_id' => 'required|exists:mascota,id',
        ]);

        $tratamiento = Tratamiento::create($data);

        // Obtener el cliente relacionado a la mascota
        $mascota = Mascota::findOrFail($data['mascota_id']);
        $clienteId = $mascota->cliente_id;

        return redirect()->route('cliente.mascota.index', $clienteId)
            ->with('success', 'Tratamiento agregado correctamente.');
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
    public function edit($clienteId, $mascotaId, Tratamiento $tratamiento)
    {
        // Obtener todos los tipos de tratamiento para el select
        $tiposTratamiento = TipoTratamiento::all();

        return view('GestionarMascota.tratamiento.edit', compact('tratamiento', 'tiposTratamiento', 'clienteId', 'mascotaId'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $clienteId, $mascotaId, Tratamiento $tratamiento)
    {
        $request->validate([
            'detalles' => 'required|string|max:255',
            'fecha' => 'required|date',
            'tipo_tratamiento_id' => 'required|exists:tipo_tratamiento,id',
        ]);

        $tratamiento->update($request->only('detalles', 'fecha', 'tipo_tratamiento_id'));

        return redirect()->route('cliente.mascota.index', $clienteId)
            ->with('success', 'Tratamiento actualizado correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($clienteId, $mascotaId, Tratamiento $tratamiento)
    {
        $tratamiento->delete();

        return redirect()->route('cliente.mascota.index', $clienteId)
            ->with('success', 'Tratamiento eliminado correctamente.');
    }
}
