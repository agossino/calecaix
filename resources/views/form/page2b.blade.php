<head>
</head>

@php
    use Carbon\Carbon;
 
    use App\Models\TipoAttivita;
    use App\Models\TipoSpecializzazione;

    $tipo_attivita = TipoAttivita::where('published', 1)->get();
    $specializzazione = TipoSpecializzazione::where('published', 1)->get();


    $idt = session()->get('tipo_volantino');

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
    <body>
        <div id="main">
            <div class="container-sm">
                <x-menu-bar-home>

                </x-menu-bar-home>

                <form method="post" action="{{ url('/form/page2') }}">
                    @csrf
                    <div class="row justify-content-md-center ">
                        <div class="col col-lg-6">

                            <label class="labex" >Dati dell'Attività</label>
<br>
                            <!---------------- QUALIFICA ------------------->
                            <div class="form-group">
                                <div class="form-group">

                                <!-- Titolo attivita in tutti --->
                                <label class="lab">Titolo dell calendario *</label>
                                <input type="text" class="form-control" name="titolo" value="{{ old('titolo') }}"
                                    required>
                                <br>

                               
                                <!-- Sottotitolo nel campo note sole se -->
                                    <label class="lab">Sezione o gruppo *</label><br><label>Aggiungere Nome della sezione o gruppo</label>
                                    <br>
                                    <input type="text" class="form-control" name="note" value="{{ old('note') }}" required>
                                    <br>
                                  
                                <br>

                                <label class="lab">Data inizio calendario *</label>
                                <input type="date" class="date form-control" name="data_inizio" required>
                                <br>
                                <label class="lab">Data fine calendario *</label>
                                <input type="date" class="date form-control" name="data_fine" required>
                                <br>

                                <div class="inpu">
                                    <a href="javascript:history.back()" class="btn btn-primary" role="button"
                                        aria-pressed="true">Indietro</a>
                                    <button type="submit" class="btn btn-primary">Avanti</button>
                                </div>

                            </div>
                        </div>
                    </div>
                </form>

            </div>
        </body>
        </div>
    </body>
</x-layout_cai>
