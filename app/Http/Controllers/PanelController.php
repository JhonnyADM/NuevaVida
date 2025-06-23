<?php

namespace App\Http\Controllers;

use App\Models\GestionCompraVenta\Servicio;
use Illuminate\Http\Request;

class PanelController extends Controller
{
    public function index()
    {
        $servicios = Servicio::all();
        return view('panel', compact('servicios'));
    }
}
