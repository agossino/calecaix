<head>
    @php
        use App\Models\TipoQualifica;
        use App\Models\TipoScelteInterne;
        use App\Models\TipoAttivita;
        use App\Models\TipoIscrizione;
        use App\Models\TipoVolantino;
        use Carbon\Carbon;

        $user = auth()->user();

        $dataOggi = $viewData['dataoggi']; // Recupera la data dall'input o usa la data di oggi come default
$dataOggius = Carbon::createFromFormat('d-m-Y', $dataOggi)->format('Y-m-d');
$tipoattivita = TipoAttivita::where('published', 1)->get();
$scelteinterne = TipoScelteInterne::where('published', 1)->get();
$tipoiscrizione = TipoIscrizione::where('published', 1)->get();
$tipovolantino = TipoVolantino::where('published', 1)->get();

    @endphp

</head>
<style>
    .par2{
        color: darkred;
    }
</style>

<div id="main">

    <div class="container-lg">

        @if (session('message'))
            <div class="alert alert-success">
                {{ session('message') }}
            </div>
        @endif



        <div class="par2" style="text-align: center;">
            {{ $tipoattivita->find($attiv->tipo_attivita)->nome }}<br>
        </div>
        <div>
            @if (isset($attiv->image_file) && $attiv->image_file != null)
                <a href="{{ url('/attivita/singolo' . '/' . $attiv->id) }}">
                    <img class="img_box" src="{{ asset('storage/imgtrek/' . $attiv->image_file) }}"
                        alt="attivita cai bologna" style="height: 270px;"></a>
            @else
                {{ 'IMMAGINE MANCANTE' }}
            @endif
        </div>

        <div style="min-height: 3em;">
            <a href="{{ url('/attivita/singolo' . '/' . $attiv->id) }}"><strong style="color: darkgreen; font-size: 14px; font-weight: 770;"> {{ $attiv->titolo }}</strong></a><br>
        
        <a href="{{ url('/attivita/singolo' . '/' . $attiv->id) }}"> <img class="ima" src="/img/lente.png" alt="Lente" ></a>
    </div>
        <div class="note" style="min-height: 3em;">
            <!-- Note sottotitolo-->
            @if (isset($attiv->note) && $attiv->note != '')
            <p class="card-text">{{ strip_tags($attiv->note) }}</p>
            @endif
        </div>
        <div>
            <strong>Data Inizio:</strong>
            {{ Carbon::createFromFormat('Y-m-d', $attiv->data_inizio)->format('d-m-Y') }}<br>
            <strong>Data Fine:</strong> {{ Carbon::createFromFormat('Y-m-d', $attiv->data_fine)->format('d-m-Y') }}<br>
        </div>
       
        <div class="prog">
            <!-- visualizza volantino -->
            @if ($attiv->tipo_volantino == 0)
                <!-- visualizza file pdf aggiornato del tipo_volantino interno--->
                <a target="_blank"
                    href="{{ url('/show-pdf' . '/' . $attiv->pdf_file . '/' . $attiv->id) . '?t=' . time() }}">Programma</a>
            @elseif($attiv->tipo_volantino == 2)
                <!-- visualizza file pdf aggiornato del tipo_volantino autogenerato--->
                <a targhet="_blank" href="{{ url('/attivita/get_programma' . '/' . $attiv->id) }}">Programma</a>
            @elseif($attiv->tipo_volantino == 1)
                <!-- visualizza file pdf del tipo_volantino link su server esterno-->
                {{ 'Programma non disponibile' }}
            @endif
            <br>
        </div>

        <div>
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
                                        <span style="color:rgba(var(--bs-link-color-rgb)">{{ 'Iscrizione' }}<br>
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
                                    <span style="color:green">{{ 'Iscrizione' }}</span><br>
                                @endif
                            </div>
                        @else
                            <a href="{{ url('/iscrizione/tipo' . '/' . $attiv->tipo_iscrizione . '/' . $attiv->id) }}">
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
                            $inizio_iscr = Carbon::createFromFormat('Y-m-d', $attiv->inizio_iscrizioni)->format(
                                'd-m-Y',
                            );
                        @endphp
                        <br>
                        {{ 'Inizio ' . $inizio_iscr }}
                    @endif

                    @if ($attiv->fine_iscrizioni)
                        @php
                            $fine_iscr = Carbon::createFromFormat('Y-m-d', $attiv->fine_iscrizioni)->format('d-m-Y');
                        @endphp
                        <br>
                        {{ 'Fine ' . $fine_iscr }}
                    @endif
                @endif
            @else
                {{ 'Nessuna Iscrizione' }}
            @endif

        </div>
    </div>

    <!-- Lista iscritti se accompagnatore e tipo iscrizione 1 = modulo caibo-->

    @if (isset($user) && ($user->role == 'accompagnatore' || $user->role == 'amministratore'))
        @if ($attiv->tipo_iscrizione == 1)
            <a style="margin-left:10px;color:darkred;" href="{{ url('/iscritti/show' . '/' . $attiv->tipo_iscrizione . '/' . $attiv->id) }}">Lista
                Iscritti
            </a>
        @endif
        <hr>

        <div class="mod">
            @if (isset($user) && ($user->role == 'editor' || $user->role == 'amministratore'))
                <span>{{ "id-{$attiv->id} iscr-{$attiv->tipo_iscrizione} clic {$attiv->clic} tipo {$attiv->tipo_volantino}" }}<br>
                    {{ $attiv->nome . ' ' . $attiv->cognome . ' - ' . $attiv->email . ' ' }}@if (isset($attiv->telefono))
                        {{ $attiv->telefono }}
                    @endif
                </span>
            @endif
        </div>
    @endif

</div>
