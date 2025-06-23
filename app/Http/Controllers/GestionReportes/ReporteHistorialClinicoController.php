<?php

namespace App\Http\Controllers\GestionReportes;

use App\Http\Controllers\Controller;
use App\Models\GestionarMascota\Mascota;
use App\Models\GestionPersonal\Cliente;
use Illuminate\Http\Request;

class ReporteHistorialClinicoController extends Controller
{
    public function seleccionarCliente()
    {
        $clientes = Cliente::all();
        return view('GestionReportes.reporteHistorialClinico.selecionarCliente', compact('clientes'));
    }
    public function create(Request $request)
    {

        $cliente_id = $request->query('cliente_id');
        $cliente = Cliente::with('mascotas')->findOrFail($cliente_id);

        $mascotas = $cliente->mascotas;
       // dd($mascotas);
        return view('GestionReportes.reporteHistorialClinico.show', compact('mascotas'));
    }
    public function show($mascota_id)
    {
        $mascota = Mascota::with([
            'raza',
            'cliente',
            'tratamientos.veterinario',
            'tratamientos.tipoTratamiento',
            'tratamientos.controles',
            'internacion.veterinario',
            'internacion.control_internacion.estado'
        ])->findOrFail($mascota_id);

        return view('GestionReportes.reporteHistorialClinico.show', compact('mascota'));
    }
    public function ajax($mascota_id)
    {
        $mascota = Mascota::with([
            'raza',
            'cliente',
            'tratamientos.veterinario',
            'tratamientos.tipoTratamiento',
            'tratamientos.controles',
            'internacion.veterinario',
            'internacion.control_internacion.estado'
        ])->findOrFail($mascota_id);

        return view('GestionReportes.reporteHistorialClinico.historial', compact('mascota'));
    }
}
