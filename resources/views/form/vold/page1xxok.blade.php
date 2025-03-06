<head>

    @php
        use App\Models\TipoVolantino;
        use App\Models\TipoSocio;
        use App\Models\TipoIscrizione;
        use App\Models\TipoAttivita;

        $tipo_attivita = TipoAttivita::where('published', 1)->get();
        $tipovolantino = TipoVolantino::where('published', 1)->orderBy('order', 'ASC')->get();
        $tiposocio = TipoSocio::where('published', 1)->orderBy('order', 'ASC')->get();
        $tipoiscrizione = TipoIscrizione::where('published', 1)->orderBy('order', 'ASC')->get();

        $user = Auth::user();
        if ($user != null) {
            $rol = $user->role;
            $is_admin = $user->is_admin;
        }

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

                <form method="post" action="{{ url('/form/page1') }}">
                    @csrf

                    <div class="row justify-content-md-center ">

                        <!----------------- TIPO VOLANTINO -------------->
                        <div class="col col-lg-6">


                            <label class="labex">zz Scelta del metodo di creazione dell'attività e del tipo di iscrizione
                            </label>
                            <br><br>
                            <label class="lab">Tipo di volantino programma *</label>
                            <br>
                            <label>E' possibile selezionare tre tipi di volantino dove:<br><span
                                style="font-weight:700"> interno</span>
                            è un volantino creato con tutte le informazioni da caricare dal proprio pc<br>
                            <span style="font-weight:700">Autogenerato</span> viene creato dalla
                            applicazione
                            dai dati inseriti, è necessaria una descrizione<br>
                            <span style="font-weight:700">Esterno</span> come interno ma risiede su un
                            server
                            quindi incollare il link nel box 'Link al modulo esterno'</label>
                        </label><br><br>

                            @foreach ($tipovolantino as $spec)
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="tipo_volantino[]"
                                        value={{ $spec->tipo_volantino }} @required(true)>
                                    <label class="form-check-label">{{ $spec->nome }}
                                        {{ $spec->descrizione }}</label>
                                </div>
                            @endforeach
                            <br>

                            <label class="lab">Ammissione *</label>
                            @foreach ($tiposocio as $spec)
                                <div class="form-check">

                                    <input class="form-check-input" type="radio" name="tipo_socio[]"
                                        value={{ $spec->tipo_socio }} required>
                                    <label class="form-check-label">{{ $spec->nome }}
                                        {{ $spec->descrizione }}</label>

                                </div>
                            @endforeach
                            <br>

                            <label class='lab' for="tipologia">Tipo di attività *</label>
                            @foreach ($tipo_attivita as $attiv)
                                <div class="form-check">

                                    @if (in_array($attiv->tipo_attivita, [7, 8]))
                                        <!-- sospende alcuni tipi di attivita -->
                                        <input class="form-check-input" type="radio" name="tipo_attivita[]"
                                            value={{ $attiv->tipo_attivita }} id="ANC" disabled>
                                        <label class="form-check-label"
                                            for="ANC">{{ $attiv->descrizione . ' (in costruzione)' }}</label>
                                    @else
                                        <input class="form-check-input" type="radio" name="tipo_attivita[]"
                                            value={{ $attiv->tipo_attivita }} id="ANC" required>
                                        <label class="form-check-label"
                                            for="ANC">{{ $attiv->descrizione }}</label>
                                    @endif

                                </div>
                            @endforeach
                            <br>
                            <label class="lab"> Tipo di iscrizione all'attività</label><br>
                            @foreach ($tipoiscrizione as $spec)
                                <div class="form-check">

                                    @if (in_array($spec->tipo_iscrizione, [0, 2]))
                                        <input class="form-check-input" type="radio" name="tipo_iscrizione[]"
                                            value={{ $spec->tipo_iscrizione }} disabled>
                                        <label class="form-check-label">{{ $spec->nome }}
                                            {{ $spec->descrizione }}</label>
                                    @else
                                        <input class="form-check-input" type="radio" name="tipo_iscrizione[]"
                                            value={{ $spec->tipo_iscrizione }} @required(true)>
                                        <label class="form-check-label">{{ $spec->nome }}
                                            {{ $spec->descrizione }}</label>
                                    @endif
                                </div>
                            @endforeach
                            <br>
                            <div class="inpu">
                                <a href="javascript:history.back()" class="btn btn-primary" role="button"
                                    aria-pressed="true">Indietro</a> <button type="submit"
                                    class="btn btn-primary">Avanti</button>
                            </div>
                        </div>


                    </div>
                </form>
                <br><br>


            </div>
        </body>
    </div>
</x-layout_cai>
