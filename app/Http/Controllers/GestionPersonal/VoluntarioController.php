<?php

namespace App\Http\Controllers\GestionPersonal;

use App\Http\Controllers\Controller;
use App\Models\GestionPersonal\Voluntario;
use Illuminate\Http\Request;

class VoluntarioController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $voluntario = Voluntario::whereHas('personal', function ($query) {
            $query->where('tipo', 'voluntario');
        })->with('personal')->paginate(10);

        return view('personalVoluntario.index', compact('voluntario'));
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
        $voluntario = Voluntario::findOrFail($id);
        return view('personalVoluntario.edit', compact('voluntario'));
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Validar los datos del formulario
        $request->validate([
            'nombre' => 'required|string|max:255',
            'apellido' => 'required|string|max:255',
            'celular' => 'required|string|max:20',
            'edad' => 'required|numeric|min:0|max:120',
            'direccion' => 'required|string|max:255',
            'estado' => 'required|in:0,1',
        ]);

        // Buscar al pasante y su personal relacionado
        $voluntario = Voluntario::findOrFail($id);
        $personal = $voluntario->personal;


        // Actualizar datos del personal
        $personal->nombre = $request->nombre;
        $personal->apellido = $request->apellido;
        $personal->telefono = $request->celular;
        $personal->save();

        // Actualizar datos del pasante
        $voluntario->direccion = $request->direccion;
        $voluntario->edad = $request->edad;
        $voluntario->estado = $request->estado; // corregido
        $voluntario->save();

        return redirect()->route('voluntario.index')->with('success', 'Datos actualizados correctamente.');
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $voluntario = Voluntario::findOrFail($id);

        // Primero eliminamos la atención
        $voluntario->delete();

        // Luego, eliminamos al personal asociado
        if ($voluntario->personal) {
            $voluntario->personal->delete();
        }

        return redirect()->route('voluntario.index')->with('success', ' voluntario eliminado correctamente.');
    }
}
