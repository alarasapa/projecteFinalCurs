@extends('layouts.base')

@section('content')
@section('titol', 'Contacte')
@push('css')
    <link rel="stylesheet" href="{{ url('css/ClientEstils/base.css') }}" >
    <link rel="stylesheet" href="{{ url('css/ClientEstils/contacte.css') }}" >
@endpush

<h1 class="principalTitol">CONSULTA AMB NOSALTRES</h1>
<div class="container">
    <form class="formCentrat" id="contactenos">
        @csrf
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
                <textarea class="form-control" type="textarea" id="missatge" name="missatge" placeholder="Entra el teu missatge..." required></textarea>
            </div>
        </div>
        <input class="btn btn-dark btn-lg btn-block" type="submit" id="submit" name="submit" value="Enviar" onclick="enviar()">
    </form>
    <!-- TODO FALTA ARREGLAR MAPS, SERA AMPLIO COMO EL SLIDER -->
    <iframe class="iframe" src="https://maps.google.com/?ll=23.135249,-82.359685&z=14&t=m&output=embed" height="600" frameborder="0" style="border:0" allowfullscreen></iframe>
</div>
<script>
    $("#contactenos").on('submit', function(event){
        event.preventDefault();
        
        $.ajax({
            url: "{{ route('send.email') }}",
            method: "POST",
            data: $(this).serialize(),
            success:function(data){
                alert("Formulario enviado")
            }

        })
    })
</script>

@endsection