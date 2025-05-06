<?php

namespace App\Http\Controllers\GestionPersonal;

use App\Http\Controllers\Controller;
use App\Models\GestionPersonal\Pasante;
use Illuminate\Http\Request;

class PasanteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pasante = Pasante::whereHas('personal', function ($query) {
            $query->where('tipo', 'pasante');
        })->with('personal')->paginate(10);

        return view('personalpasante.index', compact('pasante'));
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
        $pasante = Pasante::findOrFail($id);
        return view('personalpasante.edit', compact('pasante'));
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
            'inicio' => 'required|date',
            'fin' => 'required|date|after_or_equal:inicio',
            'estado' => 'required|in:0,1',
        ]);

        // Buscar al pasante y su personal relacionado
        $pasante = Pasante::findOrFail($id);
        $personal = $pasante->personal;

        // Actualizar datos del personal
        $personal->nombre = $request->nombre;
        $personal->apellido = $request->apellido;
        $personal->telefono = $request->celular;
        $personal->save();

        // Actualizar datos del pasante
        $pasante->inicio = $request->inicio;
        $pasante->fin = $request->fin;
        $pasante->estado = $request->estado; // corregido
        $pasante->save();

        return redirect()->route('pasante.index')->with('success', 'Datos actualizados correctamente.');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $pasante = Pasante::findOrFail($id);

        // Primero eliminamos la atención
        $pasante->delete();

        // Luego, eliminamos al personal asociado
        if ($pasante->personal) {
            $pasante->personal->delete();
        }

        return redirect()->route('pasante.index')->with('success', ' Pasante eliminado correctamente.');
    }
}
