@extends('layouts.dashboard')

@section('titol', 'Gestionar Activitats')
@section('content')

@push('css')
    <link rel="stylesheet" href="{{ asset('css/AdminEstils/index.css') }}">
@endpush

<div class="container">
    <div class="table-responsive">
        <h2 style="font-family: 'Nunito', sans-serif;">Llistat d'activitats</h2>
        
        <a class="btn btn-lg btn-danger" type="button" href="{{ route('activitats.activitat.formulari', ['accio' => 'novaActivitat']) }}">Afegir Activitat</a>
        <table style="text-align: center;" class="table table-md table-bordered table-dark">
            <thead>
                <tr>
                    <th scope="col">Titol</th>
                    <th scope="col">Descripcio</th>
                    <th scope="col">Formulari</th>
                    <th scope="col">Accions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($activitats as $act)
                    <tr>
                        <td>{{ $act->titol }}</td>
                        <td>{{ $act->descripcio }}</td>
                        <td>
                            @if ($act->formulari)
                                <button type="button">Gestionar formulari</button>
                            @else
                               No hi té formulari
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('activitats.activitat.formulari', ['accio' => 'editarActivitat', 'id' => $act->id]) }}">
                                <button><i class="fas fa-edit"></i></button>
                            </a>
                            
                            <form id="eliminar-{{ $act->id }}" action="{{ route('activitats.activitat.eliminar', ['id' => $act->id]) }}" method="POST">
                                @csrf
                                <button type="submit" href="{{ route('activitats.activitat.eliminar', ['id' => $act->id]) }}" onclick="return confirm('Estàs segur que vols eliminar aquesta activitat?')"><i class="far fa-trash-alt"></i></button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

@endsection