<?php

namespace App\Http\Controllers\GestionMascota;

use App\Http\Controllers\Controller;
use App\Models\GestionarMascota\Adopcion;
use App\Models\GestionarMascota\Mascota;
use App\Models\GestionPersonal\Cliente;
use Illuminate\Http\Request;

class AdopcionController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function index()
    {
        $adopciones = Adopcion::with('cliente', 'mascota')->get();
        return view('GestionarMascota.Adopcion.index', compact('adopciones'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $clientes = Cliente::all();
        $mascotas = Mascota::whereNull('cliente_id')->get(); // Solo las que no tienen dueño
        return view('GestionarMascota.Adopcion.create', compact('clientes', 'mascotas'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'cliente_id' => 'required|exists:cliente,id',
            'mascota_id' => 'required|exists:mascota,id',
            'fecha_adopcion' => 'required|date',
        ]);

        $mascota = Mascota::findOrFail($request->mascota_id);

        if ($mascota->cliente_id !== null) {
            return back()->withErrors(['mascota_id' => 'Esta mascota ya fue adoptada.']);
        }

        $adopcion = Adopcion::create([
            'cliente_id' => $request->cliente_id,
            'mascota_id' => $request->mascota_id,
            'fecha_adopcion' => $request->fecha_adopcion,
            'observaciones' => $request->observaciones,
        ]);

        $mascota->cliente_id = $request->cliente_id;
        $mascota->save();

        return redirect()->route('adopciones.index')->with('success', 'Adopción registrada exitosamente.');
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
    public function edit($id)
    {
        $adopcion = Adopcion::findOrFail($id);
        $clientes = Cliente::all();

        // Mascotas disponibles para cambiar + la actual
        $mascotas = Mascota::where(function ($query) use ($adopcion) {
            $query->whereNull('cliente_id')
                  ->orWhere('id', $adopcion->mascota_id);
        })->get();

        return view('GestionarMascota.Adopcion.edit', compact('adopcion', 'clientes', 'mascotas'));
    }
    /**
     * Update the specified resource in storage.
     */
   public function update(Request $request, $id)
    {
        $request->validate([
            'cliente_id' => 'required|exists:cliente,id',
            'mascota_id' => 'required|exists:mascota,id',
            'fecha_adopcion' => 'required|date',
        ]);

        $adopcion = Adopcion::findOrFail($id);
        $oldMascota = $adopcion->mascota;
        $newMascota = Mascota::findOrFail($request->mascota_id);

        // Si se cambia de mascota y la nueva ya tiene dueño, error
        if ($newMascota->id !== $oldMascota->id && $newMascota->cliente_id !== null) {
            return back()->withErrors(['mascota_id' => 'La nueva mascota ya fue adoptada.']);
        }

        // Reasignar mascota anterior
        if ($oldMascota->id !== $newMascota->id) {
            $oldMascota->cliente_id = null;
            $oldMascota->save();
        }

        $adopcion->update([
            'cliente_id' => $request->cliente_id,
            'mascota_id' => $request->mascota_id,
            'fecha_adopcion' => $request->fecha_adopcion,
            'observaciones' => $request->observaciones,
        ]);

        // Asignar cliente a la nueva mascota
        $newMascota->cliente_id = $request->cliente_id;
        $newMascota->save();

        return redirect()->route('adopciones.index')->with('success', 'Adopción actualizada exitosamente.');
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $adopcion = Adopcion::findOrFail($id);

        // Al eliminar, podemos quitar al cliente de la mascota
        $mascota = $adopcion->mascota;
        $mascota->cliente_id = null;
        $mascota->save();

        $adopcion->delete();

        return redirect()->route('adopciones.index')->with('success', 'Adopción eliminada correctamente');
    }
}
