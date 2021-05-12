@extends('layouts.dashboard')

@section('titol', 'Gestionar categories')
@section('content')

@push('css')
    <link rel="stylesheet" href="{{ asset('css/AdminEstils/index.css') }}">
@endpush

<div class="container">
    <div class="table-responsive">
        <h2 style="font-family: 'Nunito', sans-serif;">Llistat de categories</h2>
        
        <a class="btn btn-lg btn-danger" type="button" href="{{ route('activitats.tipusActivitats.formulari', ['accio' => 'nouTipusActivitat']) }}">Afegir categoria</a>
        <table style="text-align: center;" class="table table-md table-bordered table-dark">
            <thead>
                <tr>
                    <th scope="col">Nom</th>
                    <th scope="col">Accions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($tipusActivitats as $tipusAct)
                    <tr>
                        <td>{{ $tipusAct->nom }}</td>
                        <td>
                        <a href="{{ route('activitats.tipusActivitats.formulari', ['accio' => 'editarTipusActivitat', 'id' => $tipusAct->id]) }}">
                                <button><i class="fas fa-edit"></i></button>
                            </a>
                            
                            <form id="eliminar-{{ $tipusAct->id }}" action="#" method="POST">
                                @csrf
                                <button type="submit" href="#" onclick="return confirm('Estàs segur que vols eliminar aquesta categoria?')"><i class="far fa-trash-alt"></i></button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <h2 class="mt-4" style="font-weight: 800">No hi han categories: Si us plau, afegiu una</h2>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

@endsection