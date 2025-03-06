<head>
</head>

@php

    use App\Models\TipoQualifica;
    use App\Models\TipoSpecializzazione;
   
    use App\Models\TipoCalendario;

    $qualifica = TipoQualifica::where('published', 1)->get();
    $tipocalendario = TipoCalendario::where('published', 1)->get();
    $specializzazione = TipoSpecializzazione::where('published', 1)->get();
   
    $volantino = session()->get('tipo_volantino');
  

@endphp

<style>
    .lab {
        color: blue;
        font-weight: 700;
    }

    .labex {
        color: green;
        font-weight: 700;
        display: block;
        text-align: center;
    }

    .col {
        border: solid 1px #cccccc;
        padding: 15px;
        border-radius: 5px;
        box-shadow: 0px 0px 3px 3px rgb(203, 203, 206);
    }

    body {
        font-size: 16px;
    }
</style>

<x-layout_cai>
    <div id="main">

        <body>
            <div class="container-sm">
                <x-menu-bar-home>

                </x-menu-bar-home>

                <form method="post" action="{{ url('/form/page1c') }}">
                    @csrf
                    <div class="row justify-content-md-center ">
                        <div class="col col-lg-6">

                            <div class="form-group">
                                <div class="form-group">
                                    <label class='labex' for="corsi">Dati dell'attività</label>

                                </div>
                                <br>

                                <label class="lab">Calendario o attività singola?<br>il calendario appare fino a 'Data fine attivita'</label>

                                <select class="form-select" name="calendario" required>
                                    @foreach ($tipocalendario as $calendario)
                                        <option value="{{ $calendario->id }}">{{ $calendario->nome. ' ('.$calendario->descrizione.')'}}</option>
                                    @endforeach
                                </select>
                                <br>

                                <label class="lab">Data inizio attivita *</label>
                                <input type="date" class="date form-control" name="data_inizio" required>
                                <br>
                                <label class="lab">Data fine attivita *</label>
                                <input type="date" class="date form-control" name="data_fine" required>
                                <br>
                                
                                <label class="lab">Data inizio iscrizioni (default = Data oggi) </label>
                                <input type="date" class="date form-control" name="inizio_iscrizioni">
                                <br>
                                <label class="lab">Data massima iscrizioni (default = Data inizio)</label>
                                <input type="date" class="date form-control" name="fine_iscrizioni">

                               
                                <br>
                                <div class="inpu">
                                    <a href="javascript:history.back()" class="btn btn-primary" role="button"
                                        aria-pressed="true">Indietro</a> <button type="submit"
                                        class="btn btn-primary">Avanti</button>
                                </div>
                            </div>


                        </div>

                    </div>

                </form>
            </div>
        </body>
    </div>
</x-layout_cai>
