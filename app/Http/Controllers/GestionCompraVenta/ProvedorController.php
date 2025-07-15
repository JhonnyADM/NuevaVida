<?php

namespace App\Http\Controllers\GestionCompraVenta;

use App\Http\Controllers\Controller;
use App\Models\GestionCompraVenta\Provedor;
use Illuminate\Http\Request;

class ProvedorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $provedores = Provedor::paginate(10);
        return view('gestioncompraventa.provedor.index', compact('provedores'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('gestioncompraventa.provedor.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)// valida y guarda en la bd
    {
        $data= $request->validate(
            [
                'descripcion' => 'required|string|max:255',
                'email' => 'required|email|max:255',
                'telefono' => 'required|string|max:20',
            ]
        );
        Provedor::create($data);
        return redirect()->route('provedor.index')->with('success', 'Provedor Creado Exitosamente');
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
    public function edit(string $id)// manda a la vista editar
    {
        $provedor = Provedor::findOrFail($id);
        return view('gestioncompraventa.provedor.edit', compact('provedor'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)// valida y actualiza la inf del prov
    {
        $request->validate(
            [
                'descripcion' => 'required|string|max:255',
                'email' => 'required|email|max:255',
                'telefono' => 'required|string|max:20',
            ]
        );
        $provedor = Provedor::findOrFail($id);
        $provedor->update($request->all());
        return redirect()->route('provedor.index')->with('success', 'Provedor Actualizado Exitosamente');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)// elimina
    {
        $provedor = Provedor::findOrFail($id);
        $provedor->delete();
        return redirect()->route('provedor.index')->with('success', 'Provedor Eliminado Exitosamente');
    }
}
