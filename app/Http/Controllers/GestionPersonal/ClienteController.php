<?php

namespace App\Http\Controllers\GestionPersonal;

use App\Http\Controllers\Controller;
use App\Models\GestionPersonal\Cliente;
use Illuminate\Http\Request;

class ClienteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $cliente = Cliente::whereHas('personal', function ($query) {
            $query->where('tipo', 'cliente');
        })->with('personal')->paginate(10);

        return view('personalcliente.index', compact('cliente'));
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
        $cliente = Cliente::findOrFail($id);
        return view('personalcliente.edit', compact('cliente'));
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
            'numero_emergencia' =>'required|string|max:20',
            'direccion' => 'required|string|max:255',
        ]);

        // Buscar al pasante y su personal relacionado
        $cliente = Cliente::findOrFail($id);
        $personal = $cliente->personal;

       // dd($cliente,$request->all());
        // Actualizar datos del personal
        $personal->nombre = $request->nombre;
        $personal->apellido = $request->apellido;
        $personal->telefono = $request->celular;
        $personal->save();

        // Actualizar datos del pasante
        $cliente->direccion = $request->direccion;
        $cliente->celular = $request->numero_emergencia;
        $cliente->save();

        return redirect()->route('cliente.index')->with('success', 'Datos actualizados correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $cliente = Cliente::findOrFail($id);

        // Primero eliminamos la atención
        $cliente->delete();

        // Luego, eliminamos al personal asociado
        if ($cliente->personal) {
            $cliente->personal->delete();
        }

        return redirect()->route('cliente.index')->with('success', ' cliente eliminado correctamente.');
    }
}
