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
        $atencion = Atencion::with('personal')->paginate(10);
       // dd($atencion->all());
        return view('personalatencion.index', compact('atencion'));
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
       $personal = Personal::all();
       return view('PersonalAtencion.create', compact('personal'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'personal_id' => 'required|exists:personal,id',
            'email' => 'required|email|unique:atencion,email',
            'cargo' => 'required|string',
        ]);

        Atencion::create([
            'personal_id' => $request->personal_id,
            'email' => $request->email,
            'cargo' => $request->cargo,
        ]);

        return redirect()->route('atencion.index')->with('success', 'Atención registrada correctamente.');
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
        $atencion = Atencion::findOrFail($id);
        $personales = Personal::all(); // o Personal::whereNotIn(...) si querés evitar duplicados
        return view('personalatencion.edit', compact('atencion', 'personales'));
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {

        $request->validate([
            'personal_id' => 'required|exists:personal,id',
            'email' => [
                'required',
                'email',
                Rule::unique('atencion', 'email')->ignore($id),
            ],
            'cargo' => 'required|string',
        ]);

        $atencion = Atencion::findOrFail($id);
        $atencion->update([
            'personal_id' => $request->personal_id,
            'email' => $request->email,
            'cargo' => $request->cargo,
        ]);

        return redirect()->route('atencion.index')->with('success', 'Personal actualizado correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $atencion = Atencion::findOrFail($id);
        $atencion->delete();
        return redirect()->route('atencion.index')->with('success', 'Personal de Atencion eliminado correctamente.');
    }
}
