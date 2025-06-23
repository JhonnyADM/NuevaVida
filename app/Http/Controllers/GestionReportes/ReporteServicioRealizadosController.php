<?php

namespace App\Http\Controllers\GestionReportes;

use App\Http\Controllers\Controller;
use App\Models\GestionCompraVenta\Servicio;
use Illuminate\Http\Request;

class ReporteServicioRealizadosController extends Controller
{
    public function index()
    {
        // Consultamos servicios y contamos cuántas veces han sido solicitados
        $servicios = Servicio::select('servicio.id', 'servicio.nombre')
            ->join('solicitar_servicio', 'servicio.id', '=', 'solicitar_servicio.servicio_id')
            ->selectRaw('COUNT(solicitar_servicio.id) as total_realizados')
            ->groupBy('servicio.id', 'servicio.nombre')
            ->orderByDesc('total_realizados')
            ->get();

        return view('GestionReportes.reporteservicios.index', compact('servicios'));
    }
}
