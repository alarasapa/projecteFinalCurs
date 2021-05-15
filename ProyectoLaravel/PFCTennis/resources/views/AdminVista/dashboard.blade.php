@extends('layouts.dashboard')

@section('titol', 'Inici')
@section('content')

@push('css')
    <link rel="stylesheet" href="{{ asset('css/AdminEstils/index.css') }}">
@endpush

<script>
    function marcarPagat(id, $this){
        let pagat = $this.checked;
        let json = JSON.stringify({ id: id, pagat: pagat });

        $.ajax({
            type: 'POST',
            url: '/peticio/pagat',
            data: json,
            dataType: 'JSON',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                'content-type': 'application/json'
            },
            success: function(res) {
                if (res) {
                    $("#missatge").html("<div class=\"alert alert-success alert-dismissible fade show\">" + 
                        "S\'ha cambiat l'estat amb èxit!" + 
                        "<button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\">" +
                        "<span aria-hidden=\"true\">&times</span></button></div>");
                } else {
                    $("#missatge").html("<div class=\"alert alert-danger alert-dismissible fade show\">" + 
                        "Hi ha hagut un error al cambiar l'estat" + 
                        "<button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\">" +
                        "<span aria-hidden=\"true\">&times</span></button></div>");
                }
            }
        });
    }
</script>

<div class="container">

    <div id="missatge"></div>

    <div class="table-responsive">
        <h2 style="font-family: 'Nunito', sans-serif;">Peticions dels usuaris</h2>
        <table style="text-align: center;" class="table table-sm table-bordered table-dark">
            <thead>
                <tr>
                    <th scope="col">Data petició</th>
                    <th scope="col">Títol activitat</th>
                    <th scope="col">Nom Complert</th>
                    <th scope="col">Dades Petició</th>
                    <th scope="col">Pagat</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($peticions as $peticio)
                    <div class="modal fade" id="modal-{{ $peticio->id }}" tabindex="-1" role="dialog" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h3 class="modal-title">{{ $peticio->activitat->titol }} </h3>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true" style="color:white">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    @foreach ($peticio->dadesPeticio as $key=>$value)
                                        @if ($key != '_token')
                                            @if ($key == 'extres')
                                                <strong>Extres:</strong>
                                                <ul>
                                                    @foreach ($value as $extra)
                                                        <li>{{ $extra }}€</li>
                                                    @endforeach
                                                </ul>
                                            @else
                                                <p><strong>{{ $key }}</strong>: {{ $value }}</p>
                                            @endif
                                        @endif
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>

                    <tr>
                        <th scope="row">{{ $peticio->dataPeticio }}</th>
                        <td>{{ $peticio->activitat->titol }}</td>
                        <td>{{ $peticio->usuari->nom }} {{ $peticio->usuari->cognoms }}</td>
                        <td>
                            <button class="btn btn-danger" type="button" data-toggle="modal" data-target="#modal-{{ $peticio->id }}">
                                Mostrar
                            </button>
                        </td>
                        <td>
                            <div class="custom-control custom-switch">
                                <input type="checkbox" name="pagat" 
                                    id="switchFormulari-{{ $peticio->id }}" 
                                    class="custom-control-input" 
                                    onclick="marcarPagat({{ $peticio->id }}, this);"
                                    {{ ($peticio->pagat) ? 'checked' : '' }}>
                                <label class="custom-control-label" for="switchFormulari-{{ $peticio->id }}"></label>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

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

    {{ $logsUsuaris->links('pagination::bootstrap-4') }}
    
</div>
@endsection