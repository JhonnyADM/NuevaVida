<?php

namespace App\Http\Controllers\GestionMascota;

use App\Http\Controllers\Controller;
use App\Models\GestionarMascota\Mascota;
use App\Models\GestionarMascota\Raza;
use App\Models\GestionPersonal\Cliente;
use Illuminate\Http\Request;

class MascotaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Cliente $cliente)
    {
        $mascotas = Mascota::with('raza')
            ->where('cliente_id', $cliente->id)
            ->paginate(10);

        return view('GestionarMascota.Mascota.index', compact('mascotas', 'cliente'));
    }
    public function mostrar()
    {
        $mascotas = Mascota::whereNull('cliente_id')->paginate(10);


        return view('GestionarMascota.Mascota.mostrar', compact('mascotas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Cliente $cliente)
    {
        $razas = Raza::all();
        return view('GestionarMascota.Mascota.create', compact('razas', 'cliente'));
    }
    public function crear()
    {
        $razas = Raza::all();
        return view('GestionarMascota.Mascota.crear', compact('razas'));
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Cliente $cliente)
    {
        $request->validate([
            'nombre' => 'required',
            'color' => 'required',
            'descripcion' => 'required',
            'edad' => 'required|integer',
            'fecha_nacimiento' => 'required|date',
            'peso' => 'required|numeric',
            'raza_id' => 'required|exists:raza,id',
        ]);

        Mascota::create([
            'nombre' => $request->nombre,
            'color' => $request->color,
            'descripcion' => $request->descripcion,
            'edad' => $request->edad,
            'fecha_nacimiento' => $request->fecha_nacimiento,
            'peso' => $request->peso,
            'raza_id' => $request->raza_id,
            'cliente_id' => $cliente->id, // 👈 asignación directa
        ]);

        return redirect()->route('mascota.mostrar')->with('success', 'Mascota registrada correctamente.');
    }
    public function validar(Request $request)
    {
        $request->validate([
            'nombre' => 'required',
            'color' => 'required',
            'descripcion' => 'required',
            'edad' => 'required|integer',
            'fecha_nacimiento' => 'required|date',
            'peso' => 'required|numeric',
            'raza_id' => 'required|exists:raza,id',
        ]);

        Mascota::create([
            'nombre' => $request->nombre,
            'color' => $request->color,
            'descripcion' => $request->descripcion,
            'edad' => $request->edad,
            'fecha_nacimiento' => $request->fecha_nacimiento,
            'peso' => $request->peso,
            'raza_id' => $request->raza_id,
            'cliente_id' => null,
        ]);

        return redirect()->route('mascota.mostrar')->with('success', 'Mascota registrada correctamente.');
    }


    /**
     * Display the specified resource.
     */
    public function show(Cliente $cliente, Mascota $mascota)
    {

        return view('GestionarMascota.Mascota.show', compact('mascota', 'cliente'));
    }
    public function ver(Mascota $mascota)
    {

        return view('GestionarMascota.Mascota.ver', compact('mascota'));
    }



    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Cliente $cliente, Mascota $mascota)
    {
        $razas = Raza::all();
        return view('GestionarMascota.Mascota.edit', compact('mascota', 'razas', 'cliente'));
    }
    public function editar(Mascota $mascota)
    {
        $razas = Raza::all();
        return view('GestionarMascota.Mascota.editar', compact('mascota', 'razas'));
    }



    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Cliente $cliente, Mascota $mascota)
    {
        $request->validate([
            'nombre' => 'required',
            'color' => 'required',
            'descripcion' => 'required',
            'edad' => 'required|integer',
            'fecha_nacimiento' => 'required|date',
            'peso' => 'required|numeric',
            'raza_id' => 'required|exists:raza,id',
        ]);

        $mascota->update($request->all());

        return redirect()->route('cliente.mascota.index', $cliente->id)
            ->with('success', 'Mascota actualizada correctamente.');
    }
    public function actualizar(Request $request, Mascota $mascota)
    {
        $request->validate([
            'nombre' => 'required',
            'color' => 'required',
            'descripcion' => 'required',
            'edad' => 'required|integer',
            'fecha_nacimiento' => 'required|date',
            'peso' => 'required|numeric',
            'raza_id' => 'required|exists:raza,id',
        ]);

        $mascota->update($request->all());

        return redirect()->route('mascota.mostrar')
            ->with('success', 'Mascota actualizada correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Cliente $cliente, Mascota $mascota)
    {
        $mascota->delete();
        return redirect()->route('cliente.mascota.index', $cliente->id)
            ->with('success', 'Mascota eliminada.');
    }
     public function eliminar( Mascota $mascota)
    {
        $mascota->delete();
        return redirect()->route('mascota.mostrar')
            ->with('success', 'Mascota eliminada.');
    }
}
