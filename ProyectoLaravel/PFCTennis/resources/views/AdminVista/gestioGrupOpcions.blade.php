@extends('layouts.dashboard')

@section('titol', 'Gestionar grup opcions ' . $tipus)
@section('content')

@push('css')
    <link rel="stylesheet" href="{{ asset('css/AdminEstils/index.css') }}">
@endpush

<div class="container">
    <div class="table-responsive">
        @if ($tipus == 'activitat')
        <h2 style="font-family: 'Nunito', sans-serif;" class="mb-3">Llistat de grup d'opcions de l'activitat: <strong>{{ $activitat->titol }}</strong></h2>
        @else
        <h2 style="font-family: 'Nunito', sans-serif;" class="mb-3">Llistat de grup d'opcions: {{ $tipus }}</h2>
        @endif

        <a class="btn btn-lg btn-danger {{ ($tipus == 'extres') ? 'd-none' : '' }}" type="button" href="{{ route('activitats.grupopcions.formulari', ['tipus' => 'general', 'accio' => 'nouGrupOpcio']) }}">Afegir Grup opcions general</a>
        <a class="btn btn-lg btn-danger {{ ($tipus == 'generals') ? 'd-none' : '' }}" type="button" href="{{ route('activitats.grupopcions.formulari', ['tipus' => 'extra', 'accio' => 'nouGrupOpcio']) }}">Afegir Grup opcions extra</a>
        
        <table style="text-align: center;" class="table table-md table-bordered table-dark mt-3">
            <thead>
                <tr>
                    <th scope="col">Activitat</th>
                    @if ($tipus == 'activitat')
                    <th scope="col">Tipus Grup</th>
                    @endif
                    <th scope="col">Nom</th>
                    <th scope="col">DescripciĆ³</th>
                    @if ($tipus == 'generals' || $tipus == 'activitat')
                    <th scope="col">Tipus</th>
                    @endif
                    <th scope="col">Opcions</th>
                    <th scope="col">Accions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($grupOpcions as $grup)
                    <tr>
                        <td>{{ $grup->activitat->titol }}</td>
                        @if ($tipus == 'activitat')
                            @if ($grup->tipus != null)
                            <td>General</td>
                            @else
                            <td>Extra</td>
                            @endif
                        @endif
                        <td>{{ $grup->nom }}</td>
                        <td>{{ $grup->descripcio }}</td>

                        @if ($tipus == 'activitat')
                            @if ($grup->tipus == null)
                            <td>X</td>
                            @else 
                            <td>{{ $grup->tipus }}</td>
                            @endif
                        @endif
                        
                        @if ($tipus == 'generals')
                            <td>{{ $grup->tipus }} </td>
                        @endif
                        <td>
                            <!-- Afegim aquest codi en PHP en cas que s'estigui llistant els grups d'opcions desde una activitat
                                ja que utilitzem la variable de tipus per a dir que ve d'una activitat -->
                            <?php $tipusGrup = (($grup->tipus == null) ? 'extres' : 'generals') ?>

                            <a class="btn btn-danger btn-block" type="button" href="{{ route('activitats.opcions', ['idGrupOpcio' => $grup->id, 'tipus' => $tipusGrup]) }}">Gestionar opcions</button>
                        </td>
                        <td>
                            @if ($tipus == 'generals' || ($tipus == 'activitat' && $grup->tipus != null))
                            <a href="{{ route('activitats.grupopcions.formulari', ['tipus' => 'general', 'accio' => 'editarGrupOpcio', 'id' => $grup->id]) }}">
                            @else
                            <a href="{{ route('activitats.grupopcions.formulari', ['tipus' => 'extra', 'accio' => 'editarGrupOpcio', 'id' => $grup->id]) }}">
                            @endif
                                <button><i class="fas fa-edit"></i></button>
                            </a>
                            
                            <form id="eliminar-{{ $grup->id }}" action="{{ route('activitats.grupopcions.eliminar', ['tipus' => $tipusGrup, 'id' => $grup->id]) }}" method="POST">
                                @csrf
                                <button type="submit" href="#" onclick="return confirm('EstĆ s segur que vols eliminar aquest grup d\'opcions?')"><i class="far fa-trash-alt"></i></button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <h2 class="mt-4" style="font-weight: 800">No hi han grups d'opcions en aquesta activitat</h2>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

@endsection