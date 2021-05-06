@extends('layouts.dashboard')

@section('titol', 'Gestionar extres')
@section('content')

@push('css')
    <link rel="stylesheet" href="{{ asset('css/AdminEstils/index.css') }}">
@endpush

<div class="container">
    <div class="table-responsive">
        <h2 style="font-family: 'Nunito', sans-serif;">Llistat d'extres</h2>
        
        <a class="btn btn-lg btn-danger" type="button" href="{{ route('activitats.extres.formulari', ['accio' => 'nouExtra']) }}">Afegir extra</a>
        <table style="text-align: center;" class="table table-md table-bordered table-dark">
            <thead>
                <tr>
                    <th scope="col">Nom</th>
                    <th scope="col">Preu Soci</th>
                    <th scope="col">Preu NO Soci</th>
                    <th scope="col">Accions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($extres as $extra)
                    <tr>
                        <td>{{ $extra->nom }}</td>
                        <td>
                            @if ($extra->preuSoci == 0)
                                GRATIS
                            @else
                               {{ $extra->preuSoci }} €
                            @endif
                        </td>
                        <td>
                            @if ($extra->preuNoSoci == 0)
                                GRATIS
                            @else
                               {{ $extra->preuNoSoci }} €
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('activitats.extres.formulari', ['accio' => 'editarExtra', 'id' => $extra->id]) }}">
                                <button><i class="fas fa-edit"></i></button>
                            </a>
                            
                            <form id="eliminar-{{ $extra->id }}" action="{{ route('activitats.extres.eliminar', ['id' => $extra->id]) }}" method="POST">
                                @csrf
                                <button type="submit" href="{{ route('activitats.extres.eliminar', ['id' => $extra->id]) }}" onclick="return confirm('Estàs segur que vols eliminar aquest extra?')"><i class="far fa-trash-alt"></i></button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

@endsection