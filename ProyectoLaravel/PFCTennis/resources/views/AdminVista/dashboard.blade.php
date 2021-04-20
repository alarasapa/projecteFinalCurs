@extends('layouts.dashboard')

@section('titol', 'Inici')
@section('content')

<div class="container">
    <!-- AQUI VAN LAS PETICIONES DE LOS USUARIOS -->


    <div class="table-responsive">
    <h2 style="font-family: 'Nunito', sans-serif;">Accions dels usuaris</h2>
    <table style="text-align: center;" class="table table-sm table-bordered table-dark">
        <thead>
            <tr>
                <th scope="col">Nom</th>
                <th scope="col">Cognoms</th>
                <th scope="col">Email</th>
                <th scope="col">Descripció</th>
                <th scope="col">Data</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($logsUsuaris as $log)
                <tr>
                    <th scope="row">{{ $log->usuari->nom }}</th>
                    <td>{{ $log->usuari->cognoms }}</td>
                    <td>{{ $log->usuari->email }}</td>
                    <td>{{ $log->descripcio }}</td>
                    <td>{{ $log->data }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
    </div>
    <!-- <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-title">
                </div>
                <div class="card-body">
                    S
                </div>
            </div>
        </div>
    </div> -->
</div>
@endsection