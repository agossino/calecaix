<head>

    @php
       
        use App\Models\TipoAttivita;
        use App\Models\TipoDifficolta;

        $tipoattivita = TipoAttivita::where('published', 1)->orderBy('order', 'ASC')->get();
         $tipo_difficolta = TipoDifficolta::where('published', 1)->orderBy('order', 'ASC')->get();
       
        $attivita = session()->get('tipo_attivita');
        $iscrizione = session()->get('tipo_iscrizione');
        $volantino = session()->get('tipo_volantino');
       
    @endphp

</head>

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
                    <li><a class="btn btn-success btn-sm" href="{{ url('/form/page1') }}">Ritorno all'inizio</a></li>
                </x-menu-bar-home>

                <form method="post" action="{{ url('/form/page5') }}">
                    @csrf

                    <div class="row justify-content-md-center ">
                        <div class="col col-lg-6">
                            <label class="labex">Caratteristiche del percorso</label>
                            <br>

                            <p>Per le tipologie e difficoltà, si veda il documento della classificazione: <a
                                    href="https://archivio.cai.it/organo_tecnico/commissione-centrale-escursionismo/documenti/difficolta-escursionsistiche/"
                                    target="_blank">documento della classificazione</a></p>

                            @if (in_array($attivita, ['1', '3','5']))
                                <div class="form-group">
                                    <label class='lab' for="tipologia">Tipo di difficolta *</label>
                                    @foreach ($tipo_difficolta as $attiv)
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="tipo_difficolta[]"
                                                value={{ $attiv->tipo_difficolta }} id="ANC" required>
                                            <label class="form-check-label"
                                                for="ANC">{{ $attiv->descrizione }}</label>

                                        </div>
                                    @endforeach
                                </div>
                                <br>
                            @endif

                            @if ($volantino == 2)
                                <label class="lab">Lunghezza km *</label>
                                <input type="text" class="form-control" name="lunghezza" required>
                                <br>
                                <label class="lab">Durata ore *</label>
                                <input type="text" class="form-control" name="durata" required>
                                <br>

                                <label class="lab">Dislivello *</label>
                                <input type="text" class="form-control" name="dislivello" required>
                                <br>
                                <label class="lab">Quota minima (opzionale)</label>
                                <input type="text" class="form-control" name="quotaminima">
                                <br>
                                <label class="lab">Quota massima (opzionale)</label>
                                <input type="text" class="form-control" name="quotamassima">
                                <br>
                            @else
                                <label class="lab">Lunghezza </label>
                                <input type="text" class="form-control" name="lunghezza">
                                <br>
                                <label class="lab">Dutata</label>
                                <input type="text" class="form-control" name="durata">
                                <br>

                                <label class="lab">Dislivello </label>
                                <input type="text" class="form-control" name="dislivello">
                                <br>
                                <label class="lab">Quota minima (opzionale)</label>
                                <input type="text" class="form-control" name="quotaminima">
                                <br>
                                <label class="lab">Quota massima (opzionale)</label>
                                <input type="text" class="form-control" name="quotamassima">
                                <br>
                            @endif


                            @if ($attivita == '5')
                                <!--(cicloescursionismo) -->
                                <label class="lab">Tratti a spinta </label>
                                <input type="text" class="form-control" name="a_spinta" required>

                                <label class="lab">Portage </label>
                                <input type="text" class="form-control" name="portage" required>
                            @endif
                            <br>



                            <div class="inpu">
                                <a href="javascript:history.back()" class="btn btn-primary" role="button"
                                    aria-pressed="true">Indietro</a> <button type="submit"
                                    class="btn btn-primary">Avanti</button>
                            </div>
                        </div>



                    </div>

                </form>

            </div>
        </body>
    </div>
</x-layout_cai>
