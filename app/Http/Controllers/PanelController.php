<?php

namespace App\Http\Controllers;

use App\Models\GestionCompraVenta\Servicio;
use App\Models\GestionPersonal\Personal;
use Illuminate\Http\Request;

class PanelController extends Controller
{
    public function index()
    {
        $servicios = Servicio::all();
        $personales = Personal::with(['veterinario', 'atencion'])->get();
        return view('panel', compact('servicios','personales'));
    }
}
