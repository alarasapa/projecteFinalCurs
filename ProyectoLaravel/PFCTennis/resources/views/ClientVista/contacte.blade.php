@extends('layouts.base')

@section('content')
@section('titol', 'Contacte')
@push('css')
    <link rel="stylesheet" href="{{ url('css/ClientEstils/base.css') }}" >
    <link rel="stylesheet" href="{{ url('css/ClientEstils/contacte.css') }}" >
@endpush

<h1 class="principalTitol">CONSULTA AMB NOSALTRES</h1>
<div class="container">
    <form class="formCentrat">
        <div class="form-row">
            <div class="form-group col-md-6">
                <input class="form-control" type="text" id="nom" name="nom" placeholder="Nom" required>
            </div>
            <div class="form-group col-md-6">
                <input class="form-control" type="text" id="email" name="email" placeholder="Email" required>
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-12">
                <input class="form-control" type="text" id="asumpte" name="asumpte" placeholder="Assumpte" required>
            </div>
            <div class="form-group col-md-12">
                <textarea class="form-control" type="textarea" id="missatge" name="missatge" placeholder="Entra el teu missatge..." required></textarea>
            </div>
        </div>
        <input class="btn btn-dark btn-lg btn-block" type="submit" id="submit" name="submit" value="Enviar" onclick="enviar()">
    </form>
</div>

@endsection