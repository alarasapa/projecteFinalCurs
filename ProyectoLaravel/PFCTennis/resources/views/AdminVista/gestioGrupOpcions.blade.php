@extends('layouts.dashboard')

@section('titol', 'Gestionar grup opcions ' . $tipus)
@section('content')

@push('css')
    <link rel="stylesheet" href="{{ asset('css/AdminEstils/index.css') }}">
@endpush

<div class="container">
    <div class="table-responsive">
        <h2 style="font-family: 'Nunito', sans-serif;">Llistat de grup d'opcions {{ $tipus }}</h2>
        @if ($tipus == 'generals')
            <a class="btn btn-lg btn-danger" type="button" href="{{ route('activitats.grupopcions.formulari', ['tipus' => 'general', 'accio' => 'nouGrupOpcio']) }}">Afegir Grup opcions general</a>
        @else 
            <a class="btn btn-lg btn-danger" type="button" href="{{ route('activitats.grupopcions.formulari', ['tipus' => 'extra', 'accio' => 'nouGrupOpcio']) }}">Afegir Grup opcions extra</a>
        @endif
        <table style="text-align: center;" class="table table-md table-bordered table-dark">
            <thead>
                <tr>
                    <th scope="col">Activitat</th>
                    <th scope="col">Nom</th>
                    <th scope="col">Descripció</th>
                    @if ($tipus == 'generals')
                    <th scope="col">Tipus</th>
                    @endif
                    <th scope="col">Accions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($grupOpcions as $grup)
                    <tr>
                        <td>{{ $grup->activitat->titol }}</td>
                        <td>{{ $grup->nom }}</td>
                        <td>{{ $grup->descripcio }}</td>
                        @if ($tipus == 'generals')
                            <td>{{ $grup->tipus }} </td>
                        @endif
                        <td>
                            @if ($tipus == 'generals')
                            <a href="{{ route('activitats.grupopcions.formulari', ['tipus' => 'general', 'accio' => 'editarGrupOpcio', 'id' => $grup->id]) }}">
                            @else
                            <a href="{{ route('activitats.grupopcions.formulari', ['tipus' => 'extra', 'accio' => 'editarGrupOpcio', 'id' => $grup->id]) }}">
                            @endif
                                <button><i class="fas fa-edit"></i></button>
                            </a>
                            
                            <form id="eliminar-{{ $grup->id }}" action="{{ route('activitats.grupopcions.eliminar', ['tipus' => $tipus, 'id' => $grup->id]) }}" method="POST">
                                @csrf
                                <button type="submit" href="#" onclick="return confirm('Estàs segur que vols eliminar aquest extra?')"><i class="far fa-trash-alt"></i></button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

@endsection