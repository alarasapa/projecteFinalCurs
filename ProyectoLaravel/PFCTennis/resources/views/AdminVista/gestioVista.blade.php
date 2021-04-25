@extends('layouts.dashboard')

@section('titol', 'Gestionar ' . $tipus)
@section('content')

@push('css')
    <link rel="stylesheet" href="{{ asset('css/AdminEstils/index.css') }}">
@endpush

<div class="container">
    <div class="table-responsive">
        <h2 style="font-family: 'Nunito', sans-serif;">Llistat {{ $tipus }}</h2>
        
        <a type="button" href="{{ route('formulariVista', ['accio' => 'nouVista','tipus' => $tipus]) }}">Afegir {{ $tipus }}</a>
        <table style="text-align: center;" class="table table-sm table-bordered table-dark">
            <thead>
                <tr>
                    <th scope="col">Imatge</th>
                    <th scope="col">Titol</th>
                    <th scope="col">Descripció</th>
                    <th scope="col">Accions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($llista as $elem)
                    <tr>
                        <td><img src="{{ asset('imatges/'. $tipus .'/' . $elem->imatge .' ') }}" width="80"/></td>
                        <td>{{ $elem->titol }}</td>
                        <td>{{ $elem->descripcio }}</td>
                        <td>
                            <a href="{{ route('formulariVista', ['accio' => 'editarVista', 'tipus' => $tipus, 'id' => $elem->id]) }}">
                                <button><i class="fas fa-edit"></i></button>
                            </a>
                            
                            <form id="eliminar-{{ $elem->id }}" action="#" method="POST">
                                @csrf
                                <button type="submit" href="#" onclick="return confirm('Estàs segur que vols eliminar aquest/a {{ $tipus }}?')"><i class="far fa-trash-alt"></i></button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

@endsection