@extends('layouts.dashboard')

@section('titol', 'Gestió Usuaris')
@section('content')

@push('css')
    <link rel="stylesheet" href="../../css/AdminEstils/index.css">
@endpush

<div class="container">
    <div class="table-responsive">
        <h2 style="font-family: 'Nunito', sans-serif;">Llistat d'usuaris</h2>
        
        <a type="button" href="/dashboard/gestio/usuaris/nouUsuari">CREAR USUARI</a>
        <table style="text-align: center;" class="table table-sm table-bordered table-dark">
            <thead>
                <tr>
                    <th scope="col">Nom Complert</th>
                    <th scope="col">Email</th>
                    <th scope="col">Telefon</th>
                    <th scope="col">Data Naixement</th>
                    <th scope="col">Rol</th>
                    <th scope="col">Estat</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($usuaris as $usuari)
                    <tr>
                        <th scope="row">{{ $usuari->nom }} {{ $usuari->cognoms }}</th>
                        <td>{{ $usuari->email }}</td>
                        <td>{{ $usuari->telefon }}</td>
                        <td>{{ $usuari->dataNaixement }}</td>
                            
                            @if (($usuari->rol) == 'U') <td>Usuari</td>
                            @elseif (($usuari->rol) == 'S') <td>Soci</td>
                            @elseif (($usuari->rol) == 'A') <td>Administrador</td>
                            @endif

                        <td>{{ $usuari->dataCreacio }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

@endsection