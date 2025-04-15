<?php

namespace App\Http\Controllers\GestionPersonal;

use App\Http\Controllers\Controller;
use App\Models\GestionPersonal\Personal;
use Faker\Provider\ar_EG\Person;
use Illuminate\Http\Request;

class Personalcontroller extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $personal = Personal::paginate(10);
        return view('personal.index', compact('personal'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('personal.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate(
            [
              'nombre' => 'required|string|max:100',
              'apellido'=> 'required|string|max:100',
              'telefono'=> 'required|string|max:20',
            ]

        );
        Personal::create([
            'nombre' => $request->nombre,
            'apellido' => $request->apellido,
            'telefono' => $request->telefono,
        ]);
        return redirect()->route('personal.index')->with('success', 'Personal creado correctamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $personal = Personal::findOrFail($id);
        return view('personal.edit', compact('personal'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate(
            [
              'nombre' => 'required|string|max:100',
              'apellido'=> 'required|string|max:100',
              'telefono'=> 'required|string|max:20',
            ]
        );
        $personal = Personal::findOrFail($id);
        $personal->update([
            'nombre' => $request->nombre,
            'apellido' => $request->apellido,
            'telefono' => $request->telefono,
        ]);
        return redirect()->route('personal.index')->with('success', 'Personal actualizado correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $personal = Personal::findOrFail($id);
        $personal->delete();
        return redirect()->route('personal.index')->with('success', 'Personal eliminado correctamente.');
    }
}
