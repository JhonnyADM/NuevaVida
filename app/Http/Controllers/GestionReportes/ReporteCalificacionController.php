<?php

namespace App\Http\Controllers\GestionReportes;

use App\Http\Controllers\Controller;
use App\Models\GestionCompraVenta\Servicio;
use Illuminate\Http\Request;

class ReporteCalificacionController extends Controller
{
    public function index()
    {
        // Cargar servicios con sus calificaciones y clientes relacionados
        $servicios = Servicio::with(['calificaciones.cliente.personal'])->get();

        return view('GestionReportes.reportecalificacion.index', compact('servicios'));
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
