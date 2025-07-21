<?php

namespace App\Http\Controllers\GestionTareacalficacion;

use App\Http\Controllers\Controller;
use App\Models\GestionPersonal\Cliente;
use App\Models\GestionPersonal\Personal;
use App\Models\GestionTareacalificacion\CalificacionPersonal;
use Illuminate\Http\Request;

class CalificacionPersonalController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $calificaciones = CalificacionPersonal::with('cliente', 'personal')->get();
        return view('GestionarTareasCalificaciones.calificacionpersonal.index', compact('calificaciones'));
    }

    public function create() {}

    public function store(Request $request)
    {
        $request->validate([
            'cliente_id' => 'required|exists:cliente,id',
            'personal_id' => 'required|exists:personal,id',
            'valor' => 'required|integer|min:1|max:5',
            'comentario' => 'nullable|string'
        ]);

        CalificacionPersonal::create($request->all());

        return redirect()->route('panel')->with('success', 'Calificación registrada correctamente.');
    }

    public function edit(CalificacionPersonal $calificacione) {}

    public function update(Request $request, CalificacionPersonal $calificacione) {}

    public function destroy($id)
    {
        $calificacion = CalificacionPersonal::findOrFail($id);
        $calificacion->delete();

        return redirect()->route('calificaciones.index')->with('success', 'Calificación eliminada correctamente.');
    }
}
