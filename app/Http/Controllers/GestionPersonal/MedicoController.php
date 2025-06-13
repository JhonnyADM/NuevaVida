<?php

namespace App\Http\Controllers\GestionPersonal;

use App\Http\Controllers\Controller;
use App\Models\GestionPersonal\Veterinario;
use Illuminate\Http\Request;

class MedicoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $medico = Veterinario::whereHas('personal', function ($query) {
            $query->where('tipo', 'veterinario');
        })->with('personal')->paginate(10);

        return view('PersonalMedico.index', compact('medico'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
        $medico = Veterinario::findOrFail($id);
        return view('PersonalMedico.edit', compact('medico'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // Validar los datos del formulario
        $request->validate([
            'nombre' => 'required|string|max:255',
            'apellido' => 'required|string|max:255',
            'celular' => 'required|string|max:20',
            'email' => 'required|email|max:255',
            'profesion' => 'required|string|max:255',
        ]);

        // Buscar la atención y su personal relacionado
        $medico = Veterinario::findOrFail($id);
        $personal = $medico->personal;

        // Actualizar datos de personal
        $personal->nombre = $request->nombre;
        $personal->apellido = $request->apellido;
        $personal->telefono = $request->celular;
        $personal->save();

        // Actualizar datos de atención
        $medico->email = $request->email;
        $medico->profesion = $request->profesion;
        $medico->save();

        return redirect()->route('medico.index')->with('success', 'Datos actualizados correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $medico = Veterinario::findOrFail($id);

        // Primero eliminamos la atención
        $medico->delete();

        // Luego, eliminamos al personal asociado
        if ($medico->personal) {
            $medico->personal->delete();
        }

        return redirect()->route('medico.index')->with('success', 'Personal Medico eliminado correctamente.');
    }
}
