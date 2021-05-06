@extends('layouts.dashboard')

@section('titol', 'Formulari Activitat')

@push('css')
    <link rel="stylesheet" href="{{ asset('css/AdminEstils/activitatForm.css') }}">
    <link rel="stylesheet" href="{{ asset('css/AdminEstils/index.css') }}">
@endpush

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8 py-4 px-4 shadow">

        @if ($accio == 'nouExtra')
            <h1 class="display-4">Crear extra</h1><hr><br>
            <form id="formRegistrar" method="POST" action="#" onsubmit="return comprovarFormulariGeneral()">
        
        @elseif ($accio == 'editarExtra')
            <h1>Editar l'extra: {{ $extra->titol }}</h1><hr><br>
            <form id="formActualitzar" method="POST" action="#" onsubmit="return comprovarFormulariGeneral()">
                <input id="id" name="id" type="hidden" value="{{ $extra->id }}">
        @endif



        </div>  
    </div>
</div>

@endsection