<?php

namespace App\Http\Controllers\GestionTareaCalficacion;

use App\Http\Controllers\Controller;
use App\Models\GestionPersonal\Pasante;
use App\Models\GestionPersonal\Voluntario;
use App\Models\GestionTareaCalificacion\Tarea;
use Illuminate\Http\Request;

class AsignacionTareaController extends Controller
{
    public function create()
    {
        $tareas = Tarea::all();
        $pasantes = Pasante::with('personal')->get();
        $voluntarios = Voluntario::with('personal')->get();

        return view('GestionarTareasCalificaciones.asignacion.create', compact('tareas', 'pasantes', 'voluntarios'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'tarea_id' => 'required|exists:tarea,id',
            'pasantes' => 'nullable|array',
            'voluntarios' => 'nullable|array',
        ]);

        $tarea = Tarea::findOrFail($request->tarea_id);
        $tarea->pasantes()->sync($request->pasantes);
        $tarea->voluntarios()->sync($request->voluntarios);

        return redirect()->route('asignaciones.create')->with('success', 'Asignación realizada correctamente.');
    }
    public function tareasPorPasante()
    {
        $pasantes = Pasante::with(['tareas' => function ($q) {
            $q->withPivot('asignado_en');
        }, 'personal'])->get();

        return view('GestionReportes.tareasasiganadas.tareas_asignadas_por_pasante', compact('pasantes'));
    }

    public function tareasPorVoluntario()
    {
        $voluntarios = Voluntario::with(['tareas' => function ($q) {
            $q->withPivot('asignado_en');
        }, 'personal'])->get();

        return view('GestionReportes.tareasasiganadas.tareas_asignadas_por_voluntario', compact('voluntarios'));
    }
}
