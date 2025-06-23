<?php

namespace App\Http\Controllers\GestionReportes;

use App\Http\Controllers\Controller;
use App\Models\GestionCompraVenta\Categoria;
use App\Models\GestionCompraVenta\Producto;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ReporteProductosVencidosController extends Controller
{


    public function general(Request $request)
    {
        $filtro = $request->input('filtro'); // puede ser '7', '30', o null

        $query = Producto::with('categoria');

        // Si hay filtro, traemos productos que vencerán dentro de X días
        if ($filtro === '7') {
            $query->whereBetween('vencimiento', [
                Carbon::now()->startOfDay(),
                Carbon::now()->addDays(7)->endOfDay()
            ]);
        } elseif ($filtro === '30') {
            $query->whereBetween('vencimiento', [
                Carbon::now()->startOfDay(),
                Carbon::now()->addDays(30)->endOfDay()
            ]);
        } else {
            // Si no hay filtro, traemos todos los productos que vencerán desde hoy en adelante
            $query->where('vencimiento', '>=', Carbon::now()->startOfDay());
        }

        $productos = $query->orderBy('vencimiento', 'asc')->get();

        return view('GestionReportes.reporteproductos.general', compact('productos', 'filtro'));
    }

    public function porCategoria(Request $request)
    {
        $filtro = $request->input('filtro');

        // Definimos el rango según el filtro
        $inicio = Carbon::now()->startOfDay();
        $fin = match ($filtro) {
            '7' => Carbon::now()->addDays(7)->endOfDay(),
            '30' => Carbon::now()->addDays(30)->endOfDay(),
            default => null,
        };

        $categorias = Categoria::with(['productos' => function ($query) use ($inicio, $fin) {
            $query->where('vencimiento', '>=', $inicio);
            if ($fin) {
                $query->where('vencimiento', '<=', $fin);
            }
            $query->orderBy('vencimiento');
        }])->get();

        return view('GestionReportes.reporteproductos.categoria', compact('categorias', 'filtro'));
    }
}
