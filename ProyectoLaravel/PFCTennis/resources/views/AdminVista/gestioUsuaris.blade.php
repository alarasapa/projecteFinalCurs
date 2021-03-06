@extends('layouts.dashboard')

@section('titol', 'Gestió Usuaris')
@section('content')

@push('css')
    <link rel="stylesheet" href="{{ asset('css/AdminEstils/index.css') }}">
@endpush

<div class="container">
    <div class="table-responsive">
        <h2 style="font-family: 'Nunito', sans-serif;">Llistat d'usuaris</h2>
        <div class="d-flex">
            <select id="filtreUsuari">
                <option value="usuari">Usuari</option>
                <option value="soci">Soci</option>
                <option value="administrador">Administrador</option>
            </select>
            <a class="btn btn-danger" type="button" href="{{ route('usuaris.formulariUsuari', ['accio' => 'nouUsuari']) }}">CREAR USUARI</a>
        </div>
        <table style="text-align: center;" class="table-sm table-bordered table-dark">
            <thead>
                <tr>
                    <th scope="col">DNI/NIF</th>
                    <th scope="col">Nom Complert</th>
                    <th scope="col">Email</th>
                    <th scope="col">Telefon</th>
                    <th scope="col">Data Naixement</th>
                    <th scope="col">Rol</th>
                    <th scope="col">Data Creació</th>
                    <th scope="col">Accions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($usuaris as $usuari)
                    <tr>
                        <th scope="row">{{ $usuari->nif }}</th>
                        <td>{{ $usuari->nom }} {{ $usuari->cognoms }}</td>
                        <td>{{ $usuari->email }}</td>
                        <td>{{ $usuari->telefon }}</td>
                        <td>{{ $usuari->dataNaixement }}</td>
                            
                            @if (($usuari->rol) == 'U') <td>Usuari</td>
                            @elseif (($usuari->rol) == 'S') <td>Soci</td>
                            @elseif (($usuari->rol) == 'A') <td>Administrador</td>
                            @endif

                        <td>{{ $usuari->dataCreacio }}</td>
                        <td>
                            <div class="row">
                                <div class="col-12">
                                    <a href="{{ route('usuaris.formulariUsuari', ['accio' => 'editarUsuari', 'id' => $usuari->id]) }}">
                                        <button><i class="fas fa-edit"></i></button>
                                    </a>
                                    <form id="eliminar-{{ $usuari->id }}" action="{{ route('eliminarUsuari', ['id' => $usuari->id]) }}" method="POST">
                                        @csrf
                                        <button type="submit" href="{{ route('eliminarUsuari', ['id' => $usuari->id]) }}" onclick="return confirm('Estàs segur que vols eliminar aquest usuari?')"><i class="far fa-trash-alt"></i></button>
                                    </form>
                                </div>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        {{ $usuaris->links('pagination::bootstrap-4') }}
    </div>
</div>

<script>
    // $("#filtreUsuari").on("change", function(){
    //     let filtre = $("#filtreUsuari").val();
        
    //     if (filtre == 'soci'){
    //         <?php // $usuaris->filter(function($usuari){
    //             return $usuari->rol == 'soci';
    //         }); ?>
    //     }
        // $.ajax({
        //     type: 'GET',
        //     data: JSON.stringify({ tipus: 'usuari', valor: $("#filtreUsuari").val() }),
        //     dataType: 'JSON',
        //     success: function(res){
        //         console.log(res);
        //     }
        // });
    });
</script>

@endsection