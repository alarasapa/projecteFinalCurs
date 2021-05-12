@forelse ($activitats as $activitat)
    <div class="mt-3">
        <h2 class="display-3">{{ $activitat->titol }}</h2>
    
        <div class="row mt-3">
            <div class="col-md-6 offset-md-1">
                <div class="row mt-4">
                    <div class="col-md-12">
                        <p>{{ $activitat->descripcio }}</p>
                    </div>
                    <div class="col-md-12 offset-xs-5">
                        <button class="btn btn-lg btn-block btn-danger" type="button" data-toggle="modal" data-target="#modal-{{ $activitat->id }}">Inscribir-se</button>
                    </div>
                </div>
            </div>

            <div class="col-md-4 d-none d-sm-block">
                <img src="../imatges/slider/padelIndividual.jpg" style="width: 100%; height: 400px; object-fit: cover;"><br><br>
            </div>
        </div>
    </div>
    <hr>

    <div class="modal fade" id="modal-{{ $activitat->id }}" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title" id="exampleModalLongTitle">{{ $activitat->titol }} </h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" style="color:white">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                @forelse ($activitat->grupOpcio as $grup)
                    <h4>{{ $grup->nom }} @if($grup->sociOnly) (Només socis)  @endif</h4>
                    <div class="row">
                        <div class="col-md-4 offset-md-1">
                            <h6>Nom opció</th>
                        </div>
                        <div class="col-md-3">
                            <h6>Preu Soci</h6>
                        </div>
                        
                        <div class="col-md-3">
                            <h6>Preu</h6>
                        </div>
                    </div>
                    @foreach ($grup->opcions as $opcio)
                        <div class="row">
                            <input class="offset-md-1" type="radio" id="opcio-{{ $opcio->id }}" name="{{ $grup->nom }}" value="{{ $opcio->id }}">
                            
                            <div class="col-md-4">
                                <small>{{ $opcio->nom }}</small>
                            </div>
                            <div class="col-md-3">
                                <small>{{ $opcio->preuSoci }} 
                                    @if($opcio->tipus == 'mensual') /mes 
                                    @elseif($opcio->tipus == 'persona') /pers 
                                    @endif 
                                €</small>
                            </div>
                            <div class="col-md-3">
                                @if ($grup->sociOnly)
                                    <small>X</small>
                                @else 
                                    <small>{{ $opcio->preu }} 
                                        @if($opcio->tipus == 'mensual') /mes 
                                        @elseif($opcio->tipus == 'persona') /pers 
                                        @endif 
                                    €</small>
                                @endif
                            </div>
                        </div>

                    @endforeach
                    <hr>
                @empty
                    <h5 style='text-align: center'>Apuntat ya!</h5>    
                @endforelse
                <h4 style="text-align: center">Extres</h4>
                @foreach ($activitat->extres as $extra)
                    <div class="form-check">
                        <div class="row">
                            <div class="offset-md-1">
                                @if (Auth::user()->rol == 'soci')
                                    <input class="form-check-input" type="checkbox" value="{{ $extra->preuSoci }}" id="flexCheckDefault">
                                @else
                                    <input class="form-check-input" type="checkbox" value="{{ $extra->preuNoSoci }}" id="flexCheckDefault">
                                @endif
                            </div>
                            <div class="col-md-4">
                                <label class="form-check-label" for="flexCheckDefault">
                                    {{ $extra->nom }}
                                </label>
                            </div>
                            <div class="col-md-3">
                                <small>{{ ($extra->preuSoci == 0) ? 'GRATIS' : $extra->preuSoci . ' €'  }}</small>
                            </div>
                            <div class="col-md-3">
                                <small>{{ ($extra->preuNoSoci == 0) ? 'GRATIS' : $extra->preuNoSoci . ' €'  }}</small>
                            </div>
                        </div>
                    </div>
                    @endforeach
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tancar</button>
                <button type="button" style="color: white;" class="btn bg-danger">Enviar petició</button>
            </div>
            </div>
        </div>
    </div>
@empty
    <h2 class="display-3">Ho sentim, però no hi han activitats disponibles per a la escola<h2>
@endforelse