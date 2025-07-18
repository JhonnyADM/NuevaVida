@extends('adminlte::page')

@section('title', 'Editar Mascota')

@section('content_header')
    <h1>Editar Mascota</h1>
@endsection

@section('content')
<form action="{{ route('mascota.actualizar', [$mascota->id]) }}" method="POST">
        @csrf @method('PUT')
        <div class="card">
            <div class="card-body">

                @include('GestionarMascota.Mascota.form', ['mascota' => $mascota])

                <div class="mt-3">
                    <button class="btn btn-success"><i class="fas fa-save"></i> Actualizar</button>
                    <a href="{{ route('mascota.mostrar') }}" class="btn btn-secondary">Cancelar</a>

                </div>

            </div>
        </div>
    </form>
@endsection
