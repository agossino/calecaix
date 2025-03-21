<head>
    @php
        use App\Models\TipoQualifica;
        use App\Models\TipoScelteInterne;
        use App\Models\TipoAttivita;
        use App\Models\TipoIscrizione;
        use App\Models\TipoVolantino;
        use App\Models\Attivita;
        use Carbon\Carbon;

        $user = auth()->user();

        $dataOggi = $viewData['dataoggi']; // Recupera la data dall'input o usa la data di oggi come default
$dataOggius = Carbon::createFromFormat('d-m-Y', $dataOggi)->format('Y-m-d');

$tipoattivita = TipoAttivita::where('published', 1)->get();
//dd($tipoattivita);
//$tipoattivita = TipoAttivita::where('published', 1) ->whereNotIn('id', [0,1]) ->pluck('nome') ->toArray();
$scelteinterne = TipoScelteInterne::where('published', 1)->get();

$tipoiscrizione = TipoIscrizione::where('published', 1)->get();
$tipovolantino = TipoVolantino::where('published', 1)->get();
//$attivita = Attivita::all();
$attivita = $viewData['attivita'];

    @endphp

</head>


<style>
    .grid-container_attivita {
        display: grid;
        grid-template-rows: repeat(4, 1fr);
        grid-template-columns: repeat(4, 1fr);
        gap: 10px;

    }

    .card {
        /* box-shadow: 1px 1px #140881; */

    }

    .card.carta {
        /*  background: rgb(215 231 175);*/
        padding: 5px;
        /* width: 18rem;*/
        margin: 10px;
        /* border-radius: 1px;*/
        padding-bottom: 20px;
    }

    .img_box {
        display: block;
        margin-left: auto;
        margin-right: auto;
        margin-bottom: 10px;
        width: 100%;
        height: 250px;
        padding-right: 5px;
    }

    .card-text {
        margin-bottom: 0;
        height: 80px;
        overflow: auto
    }

    .card-title {
        height: 40px;
        overflow: auto;
        font-size: 14px;
        font-weight: 600;
        height: auto;
    }

    .gruppo-titolo {
        min-height: 100px;
        padding-left: 10px;
    }

    .categoria {
        text-align: center;
        color: rgb(88 12 12);
        font-weight: 700;
    }

    .list-date {
        margin-left: -40px;
    }

    .dv {
        display: flex;
        align-items: center;
    }

    .lab {
        white-space: nowrap;
        /* Impedisce al testo di andare a capo */
        margin-right: 10px;
        /* Aggiungi uno spazio tra l'etichetta e l'input */
        font-weight: 600;
    }

    .caltext {
        text-align: center;
        text-wrap: wrap;
        color: blue;
    }



    .btprog {
        margin-left: 10px;
        margin-right: 10px;
    }

    .rif {
        font-size: 7px;
        margin-left: 50%;

    }

    .fondo {
        height: 10px;

    }

    .mod {
        margin-top: -10px;
        font-size: 11px;

    }

    .contatti {
        min-height: 20px;
        margin-left: 10px;
    }

    .lb_cerca {
        margin-left: 3px;
        margin-right: 3px;
        color: blue;
    }

    .cerca {
        border: solid 1px #cccccc;
        border-radius: 5px;
        height: 37px;
        margin-left: 20px;
    }

    .socio {
        color: blue;
    }

    .libera {
        color: blue;
    }

    a {
        text-decoration: none !important
    }

    .item_2 {
        margin-left: 16px;
        color: green;
    }

    /* Responsive Styles */
    @media (max-width: 1200px) {
        .grid-container_attivita {
            grid-template-columns: repeat(3, 1fr);
        }
    }

    @media (max-width: 900px) {
        .grid-container_attivita {
            grid-template-columns: repeat(2, 1fr);
        }
    }

    @media (max-width: 600px) {
        .grid-container_attivita {
            grid-template-columns: 1fr;
        }
    }
</style>

<x-logocai_anim />


<x-layout_cai>
    <x-menu-bar />
    <form action="{{ url('attivita/cerca' . '/index') }}" method="GET">

        <input type="text" class="cerca" name="cerca" placeholder="Inserisci una parola del titolo">
        <button type="submit" class="btn btn-primary btn-sm bt_cerca">Cerca titolo</button>
    </form>
    <div id="main">

        @if (session('message'))
            <div class="alert alert-success">
                {{ session('message') }}
            </div>
        @endif
        <div class="container-xl">
            <div class="grid-container_attivita">

                @foreach ($attivita as $attiv)
                    <div class="card carta">

                        <!-- visualizza tipo di attivita nel box in alto -->
                        <div class="categoria">
                            @if ($attiv->tipo_attivita != '')
                                @if ($attiv->calendario == '0')
                                    {{ $tipoattivita->find($attiv->tipo_attivita)->nome }}
                                @else
                                    {{ 'Calendario ' }}{{ $tipoattivita->find($attiv->tipo_attivita)->nome }}
                                @endif
                            @else
                                {{ 'ERRORE NEI DATI INSERITI' }}
                            @endif
                        </div>

                        @if (isset($attiv->image_file) && $attiv->image_file != null)
                            <a href="{{ url('/attivita/singolo' . '/' . $attiv->id) }}">
                                <img class="img_box" src="{{ asset('storage/imgtrek/' . $attiv->image_file) }}"
                                    alt="attivita cai bologna"></a>
                        @else
                            {{ 'IMMAGINE MANCANTE' }}
                        @endif

                        <div class="gruppo-titolo">
                            <div>
                                @if (isset($attiv->titolo) && $attiv->titolo != '')
                                    <a href="{{ url('/attivita/singolo' . '/' . $attiv->id) }}">
                                        <p class="card-title">{{ $attiv->titolo }}</p>
                                    </a>
                                @else
                                    {{ 'MANCA IL TITOLO' }}
                                @endif
                            </div>
                            <div class="note">
                                <!-- Note sottotitolo-->
                                @if (isset($attiv->note) && $attiv->note != '')
                                    <p class="card-text">{{ strip_tags($attiv->note) }}</p>
                                @endif
                            </div>
                        </div>

                        @php
                            $inizio = Carbon::createFromFormat('Y-m-d', $attiv->data_inizio)->format('d-m-Y');
                            $fine = Carbon::createFromFormat('Y-m-d', $attiv->data_fine)->format('d-m-Y');
                        @endphp

                        <ul class="list-date">
                            <li>
                                <label class="lab">Inizio</label><span class="dato">{{ $inizio }}</span>
                            </li>

                            @if ($attiv->calendario == 1)
                                <div class="item_2">
                                    <label class="prog">Vedi date intermedie<br>
                                        da Programma</label>
                                </div>
                                {{-- <a target="_blank" href="{{ url('/show-pdf' . '/' . $attiv->pdf_file) }}">Vedi date
                            intermedie<br>
                            da Programma</a> --}}
                            @endif
                            <li><label class="lab">Fine</label>
                                <span class="dato">{{ $fine }}</span>
                            </li>
                            <li>
                                <!------------------------- PROGRAMMA ----------------------------->
                                <div class="item">

                                    <div class="prog">
                                        <!-- visualizza volantino -->
                                        @if ($attiv->tipo_volantino == 0)
                                            <!-- visualizza file pdf aggiornato del tipo_volantino interno--->
                                            <a target="_blank"
                                                href="{{ url('/show-pdf' . '/' . $attiv->pdf_file . '/' . $attiv->id) . '?t=' . time() }}">Programma</a>
                                        @elseif($attiv->tipo_volantino == 2)
                                            <!-- visualizza file pdf aggiornato del tipo_volantino autogenerato--->
                                            <a targhet="_blank"
                                                href="{{ url('/attivita/get_programma' . '/' . $attiv->id) }}">Programma</a>
                                        @elseif($attiv->tipo_volantino == 1)
                                            <!-- visualizza file pdf del tipo_volantino link su server esterno-->
                                            {{ 'Programma non disponibile' }}
                                        @endif
                                        <br>

                                        <!-- Lista iscritti se accompagnatore e tipo iscrizione 1 = modulo caibo-->
                                        @if (isset($attiv->tipo_iscrizione) && $attiv->tipo_iscrizione != 4)
                                            @if (isset($attiv->inizio_iscrizioni) && isset($attiv->fine_iscrizioni))
                                                @if ($dataOggius >= $attiv->inizio_iscrizioni && $dataOggius < $attiv->fine_iscrizioni)
                                                    <!-- ISCRIZIONE ---->
                                                    @if ($attiv->tipo_iscrizione == 3)
                                                        <div>
                                                            @if (strpos($attiv->link_modulo_esterno, 'https://') !== false ||
                                                                    strpos($attiv->link_modulo_esterno, 'http://') !== false)
                                                                <a href="{{ $attiv->link_modulo_esterno }}">
                                                                    <span
                                                                        style="color:rgba(var(--bs-link-color-rgb)">{{ 'Iscrizione' }}<br>
                                                                        @if ($attiv->socio == 1)
                                                                            <label class="socio">Solo soci</label><br>
                                                                        @endif
                                                                        @if ($attiv->socio == 0)
                                                                            <label class="socio"><span class="libera">
                                                                                    Soci</span></label><br>
                                                                        @endif
                                                                    </span>
                                                                </a>
                                                            @else
                                                                <span
                                                                    style="color:green">{{ 'Iscrizione' }}</span><br>
                                                            @endif
                                                        </div>
                                                    @else
                                                        <a
                                                            href="{{ url('/iscrizione/tipo' . '/' . $attiv->tipo_iscrizione . '/' . $attiv->id) }}">
                                                            {{ 'Iscrizione' }}
                                                            @if ($attiv->socio == 1)
                                                                <label class="socio">(Soci CAI)</label><br>
                                                            @endif
                                                        </a>
                                                    @endif
                                                @else
                                                    {{ 'Iscrizioni chiuse' }}<br>
                                                @endif

                                                @if ($attiv->inizio_iscrizioni)
                                                    @php
                                                        $inizio_iscr = Carbon::createFromFormat(
                                                            'Y-m-d',
                                                            $attiv->inizio_iscrizioni,
                                                        )->format('d-m-Y');
                                                    @endphp
                                                    <br>
                                                    {{ 'Inizio ' . $inizio_iscr }}
                                                @endif

                                                @if ($attiv->fine_iscrizioni)
                                                    @php
                                                        $fine_iscr = Carbon::createFromFormat(
                                                            'Y-m-d',
                                                            $attiv->fine_iscrizioni,
                                                        )->format('d-m-Y');
                                                    @endphp
                                                    <br>
                                                    {{ 'Fine ' . $fine_iscr }}
                                                @endif
                                            @endif
                                        @else
                                            {{ 'Nessuna Iscrizione' }}
                                        @endif

                                    </div>

                                    <!-- Lista iscritti se accompagnatore e tipo iscrizione 1 = modulo caibo-->

                                    @if (isset($user) && ($user->role == 'accompagnatore' || $user->role == 'amministratore'))
                                        @if ($attiv->tipo_iscrizione == 3)
                                        @endif

                                        @if ($attiv->tipo_iscrizione == 1)
                                            <a
                                                href="{{ url('/iscritti/show' . '/' . $attiv->tipo_iscrizione . '/' . $attiv->id) }}">Lista
                                                Iscritti
                                            </a>
                                        @endif
                                    @endif


                                </div>
                            </li>
                        </ul>

                        {{-- sospeso  
                        <div class="contatti">
                            <label class="lab">Contatti</label><br>
                            <p class="contatti">{{ $attiv->contatti }}</p>
                        </div> --}}

                        <div class="mod">
                            @if (isset($user) && ($user->role == 'editor' || $user->role == 'amministratore'))
                                <br>
                                <span>{{ "id-{$attiv->id} iscr-{$attiv->tipo_iscrizione} clic {$attiv->clic} tipo {$attiv->tipo_volantino}" }}<br>
                                    {{ $attiv->nome . ' ' . $attiv->cognome . ' - ' . $attiv->email . ' ' }}
                                    @if (isset($attiv->telefono))
                                        {{ $attiv->telefono }}
                                    @endif
                                </span>
                            @endif
                        </div>

                    </div>
                @endforeach

            </div>

        </div>
    </div>
</x-layout_cai>


<script>
    function aggiungiData() {
        var dataOggi = document.getElementById('dataOggi_index').value;
    }
</script>



<script type="text/javascript">
    $('.date').datepicker({
        format: 'dd-mm-yyyy'
    });
</script>

<script>
    $(document).ready(function() {
        // Animazione di un elemento con ID "myElement"
        $("#myImage").animate({
            top: "10px", // Sposta l'elemento a sinistra di 100px
        }, 2000); // Durata dell'animazione in millisecondi
    });
</script>
