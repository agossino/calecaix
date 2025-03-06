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
                                <label class="lab">Titolo dell'attività *</label>
                                <input type="text" class="form-control" name="titolo" value="{{ old('titolo') }}"
                                    required>
                                <br>

                               @if (in_array($idt[0], [0, 1]))
                                <!-- Sottotitolo nel campo note sole se -->
                                    <label class="lab">Sottotitolo (opzionale)</label><br><label>Puo essere usato per una breve comunicazione aggiuntiva<br>data presentazione ecc..</label>
                                    <br>
                                    <textarea id="note" name="note" rows="3" cols="60"></textarea>
                                    <br>
                                 @endif
                                <br>

                                <label class="lab">Numero massimo (opzionale)</label>
                                <input type="text" class="form-control" name="numeromassimo">
                                <br>
                                <label class="lab">Numero minimo (opzionale)</label>
                                <input type="text" class="form-control" name="numerominimo">
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
