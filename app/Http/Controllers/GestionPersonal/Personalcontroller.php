<?php

namespace App\Http\Controllers\GestionPersonal;

use App\Http\Controllers\Controller;
use App\Models\GestionPersonal\Personal;
use Illuminate\Http\Request;
use App\Models\GestionPersonal\Cliente;
use App\Models\GestionPersonal\Pasante;
use App\Models\GestionPersonal\Atencion;
use App\Models\GestionPersonal\Voluntario;
use App\Models\GestionPersonal\Veterinario;
use App\Models\GestionUSuario\Usuario;
use Illuminate\Support\Facades\Hash;

class Personalcontroller extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $personal = Personal::paginate(10);
        return view('Personal.index', compact('personal'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('Personal.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nombre'   => 'required|string|max:100',
            'apellido' => 'required|string|max:100',
            'telefono' => 'required|string|max:20',
            'tipo'     => 'required|string|in:cliente,pasante,atencion,voluntario,veterinario',
        ]);

        // Guardar datos generales en 'personal'
        $personal = Personal::create([
            'nombre'   => $request->nombre,
            'apellido' => $request->apellido,
            'telefono' => $request->telefono,
              'telefono' => $request->telefono,
            'tipo'     => $request->tipo,
        ]);

        // Según el tipo, guardar datos específicos
        switch ($request->tipo) {
            case 'cliente':
                $request->validate([
                    'celular' => 'required|string|unique:cliente,celular',
                    'direccion_cliente' => 'required|string',
                ]);
                Cliente::create([
                    'personal_id' => $personal->id,
                    'celular' => $request->celular,
                    'direccion' => $request->direccion_cliente
                ]);
                break;

            case 'pasante':
                $request->validate([
                    'inicio' => 'required|date',
                    'fin' => 'required|date|after_or_equal:inicio',
                ]);
                Pasante::create([
                    'personal_id' => $personal->id,
                    'inicio' => $request->inicio,
                    'fin' => $request->fin,
                    'estado' => true,
                ]);
                break;

            case 'atencion':
                $request->validate([
                    'cargo' => 'required|string',
                    'email_atencion' => 'required|email|unique:atencion,email',
                ]);
                Atencion::create([
                    'personal_id' => $personal->id,
                    'cargo' => $request->cargo,
                    'email' => $request->email_atencion,
                ]);
                break;

            case 'voluntario':
                $request->validate([
                    'direccion_voluntario' => 'required|string',
                    'edad' => 'required|integer|min:12|max:99',
                ]);
                Voluntario::create([
                    'personal_id' => $personal->id,
                    'direccion' => $request->direccion_voluntario,
                    'edad' => $request->edad,
                    'estado' => true,
                ]);
                break;

            case 'veterinario':
                $request->validate([
                    'profesion' => 'required|string',
                    'email_veterinario' => 'required|email|unique:veterinario,email',
                ]);
                Veterinario::create([
                    'personal_id' => $personal->id,
                    'profesion' => $request->profesion,
                    'email' => $request->email_veterinario,
                ]);
                break;
        }

        $codigo = $this->generarCodigoUnico();
        $password = '12345678'; // o '12345678' si lo prefieres
        $usuario = Usuario::create([
            'codigo' => $codigo,
            'password' => Hash::make($password),
            'estado' => true,
            'personal_id' => $personal->id,
        ]);

        // Asignar rol basado en tipo
        $rolAsignar = $request->tipo;
        $usuario->assignRole($rolAsignar);

        return view('Personal.verUsuario', compact('codigo', 'password'));
    }
    public function generarCodigoUnico()
    {
        do {
            $codigo = rand(10000, 99999); // 5 dígitos
        } while (Usuario::where('codigo', $codigo)->exists());
        return (string) $codigo;
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $personal = Personal::findOrFail($id);

        // Según el tipo, buscamos la relación correspondiente
        $detalle = null;


        switch ($personal->tipo) {
            case 'cliente':
                $detalle = $personal->cliente;
                break;
            case 'pasante':
                $detalle = $personal->pasante;
                break;
            case 'atencion':
                $detalle = $personal->atencion;
                break;
            case 'voluntario':
                $detalle = $personal->voluntario;
                break;
            case 'veterinario':
                $detalle = $personal->veterinario;
                break;
        }
        /*  dd([
            'personal' => $personal->toArray(),
            'detalle' => $detalle ? $detalle->toArray() : null
        ]);*/
        return view('Personal.show', compact('personal', 'detalle'));
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id) {}

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id) {}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id) {}
}
