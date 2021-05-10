@extends('layouts.dashboard')

@section('titol', 'Gestionar opcions')
@section('content')

@push('css')
    <link rel="stylesheet" href="{{ asset('css/AdminEstils/index.css') }}">
@endpush

<div class="container">
    <div class="table-responsive">
        <h2 style="font-family: 'Nunito', sans-serif;">Llistat d'opcions de {{ $grup->nom }}</h2>
        
        <a class="btn btn-lg btn-danger" type="button" href="{{ route('activitats.opcions.formulari', ['idGrupOpcio' => $grup->id, 'tipus' => $tipus, 'accio' => 'novaOpcio']) }}">Afegir opcio</a>
        <table style="text-align: center;" class="table table-md table-bordered table-dark">
            <thead>
                <tr>
                    <th scope="col">Nom</th>
                    @if ($tipus == 'generals')
                    <th scope="col">Preu Soci</th>
                    <th scope="col">Preu NO Soci</th>
                    @endif
                    <th scope="col">Accions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($opcions as $opcio)
                    <tr>
                        <td>{{ $opcio->nom }}</td>
                        @if ($tipus == 'generals')
                        <td>
                            @if ($opcio->preuSoci == 0)
                                GRATIS
                            @else
                               {{ $opcio->preuSoci }} €
                            @endif
                        </td>
                        <td>
                            @if ($opcio->preu == 0)
                                GRATIS
                            @else
                               {{ $opcio->preu }} €
                            @endif
                        </td>
                        @endif
                        <td>
                            <a href="#">
                                <button><i class="fas fa-edit"></i></button>
                            </a>
                            
                            <form id="eliminar-{{ $opcio->id }}" action="#" method="POST">
                                @csrf
                                <button type="submit" href="#" onclick="return confirm('Estàs segur que vols eliminar aquesta opció?')"><i class="far fa-trash-alt"></i></button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

@endsection