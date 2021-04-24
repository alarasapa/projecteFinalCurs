@extends('layouts.dashboard')

@section('titol', 'Inici')
@section('content')

@push('css')
    <link rel="stylesheet" href="{{ asset('css/AdminEstils/index.css') }}">
@endpush

<div class="container">
    <!-- AQUÍ VAN LAS PETICIONES DE LOS USUARIOS -->

    <div class="table-responsive">
        <h2 style="font-family: 'Nunito', sans-serif;">Accions dels administradors</h2>
        <table style="text-align: center;" class="table table-sm table-bordered table-dark">
            <thead>
                <tr>
                    <th scope="col">Data</th>
                    <th scope="col">Nom Complert</th>
                    <th scope="col">Descripció</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($logsUsuaris as $log)
                    <tr>
                        <th scope="row">{{ $log->data }}</th>
                        <td>{{ $log->usuari->nom }} {{ $log->usuari->cognoms }}</td>
                        <td>{{ $log->descripcio }}</td>
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