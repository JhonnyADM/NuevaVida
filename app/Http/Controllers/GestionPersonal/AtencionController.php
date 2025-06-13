<?php

namespace App\Http\Controllers\GestionPersonal;

use App\Http\Controllers\Controller;
use App\Models\GestionPersonal\Atencion;
use App\Models\GestionPersonal\Personal;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class AtencionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $atencion = Atencion::whereHas('personal', function ($query) {
            $query->where('tipo', 'atencion');
        })->with('personal')->paginate(10);

        return view('PersonalAtencion.index', compact('atencion'));
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create() {}

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request) {}
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
        $atencion = Atencion::findOrFail($id);

        return view('PersonalAtencion.edit', compact('atencion'));
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
            'cargo' => 'required|string|max:255',
        ]);

        // Buscar la atención y su personal relacionado
        $atencion = Atencion::findOrFail($id);
        $personal = $atencion->personal;

        // Actualizar datos de personal
        $personal->nombre = $request->nombre;
        $personal->apellido = $request->apellido;
        $personal->telefono = $request->celular;
        $personal->save();

        // Actualizar datos de atención
        $atencion->email = $request->email;
        $atencion->cargo = $request->cargo;
        $atencion->save();

        return redirect()->route('atencion.index')->with('success', 'Datos actualizados correctamente.');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $atencion = Atencion::findOrFail($id);

        // Primero eliminamos la atención
        $atencion->delete();

        // Luego, eliminamos al personal asociado
        if ($atencion->personal) {
            $atencion->personal->delete();
        }

        return redirect()->route('atencion.index')->with('success', 'Personal y atención eliminados correctamente.');
    }


}
