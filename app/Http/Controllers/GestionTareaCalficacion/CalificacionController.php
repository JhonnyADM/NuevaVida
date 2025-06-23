<?php

namespace App\Http\Controllers\GestionTareaCalficacion;

use App\Http\Controllers\Controller;
use App\Models\GestionCompraVenta\Servicio;
use App\Models\GestionPersonal\Cliente;
use App\Models\GestionPersonal\Personal;
use App\Models\GestionTareaCalificacion\Calificacion;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CalificacionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($servicio, $cliente) {}


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validar solo los campos que vienen del frontend
        $validated = $request->validate([
            'servicio_id'  => 'required|exists:servicio,id',
            'valor'        => 'required|integer|min:1|max:5',
            'comentario'   => 'nullable|string|max:500',
        ]);
        $usuario = Auth::user();
        $personal = $usuario->personal;

       if (!$personal || $personal->tipo !== 'cliente') {
            abort(403, 'Este usuario no está autorizado para calificar');
        }
        $cliente = $personal->cliente;

        if (!$cliente) {
            abort(403, 'No se encontró un registro de cliente para este usuario');
        }


        Calificacion::create([
            'cliente_id'   => $cliente->id,
            'servicio_id'  => $validated['servicio_id'],
            'valor'        => $validated['valor'],
            'comentario'   => $validated['comentario'],
        ]);

        return back()->with('success', '¡Gracias por tu calificación!');
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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
