<!DOCTYPE html>
<html lang="it">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<head>
    @php
        use App\Models\TipoQualifica;
        use App\Models\TipoSpecializzazione;
        use App\Models\TipoAttivita;
        use App\Models\TipoIscrizione;
        use App\Models\TipoVolantino;
        use App\Models\Attivita;
        use Carbon\Carbon;

        $tipo_attivita = TipoAttivita::where('published', 1)->orderBy('order', 'ASC')->get();
        //$tipo_iscrizione = TipoIscrizione::where("published", 1)->orderBy("order", "ASC")->get();
        $tipoiscrizione = TipoIscrizione::where('published', 1)->get();
        $tipovolantino = TipoVolantino::where('published', 1)->orderBy('order', 'ASC')->get();

        $attivita = $viewData['attivita'];

        $dataOggius = Carbon::now()->toDateString(); // Ottiene la data di oggi nel formato 'YYYY-MM-DD'
        $dataOggi = Carbon::createFromFormat('Y-m-d', $dataOggius)->format('d-m-Y');

    @endphp
    <!-- Includi jQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

    <!-- utilizzare queste versioni per il corretto funzionamento del popup -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</head>

<style>
    .card-text {
        overflow: auto;
        height: 100px;
    }

    .img_box {
        display: block;
        margin-left: auto;
        margin-right: auto;
        width: 80%;
    }

    .lab {
        font-weight: 700;
        margin-right: 2px;
    }

    .cardx {
        margin: 100px;
        border: solid 1px #cccccc;
        border-radius: 5px;
        padding: 10px;
        box-shadow: 2px 2px rgb(8, 7, 14);
    }
</style>

<style>
    .lab {
        color: blue;
        font-weight: 700;
    }

    .labe {
        color: green;
        font-weight: 700;
    }

    .col {
        border: solid 1px #cccccc;
        padding: 15px;
        border-radius: 5px;
        box-shadow: 0px 0px 3px 3px rgb(203, 203, 206);
    }

    img#preview {
        width: 250px;
    }

    .frame {
        display: block;
    }

    /* Responsive Styles */
    @media (max-width: 1200px) {
        .pre {
            font-size: 20px;
            color: rgb(226, 88, 23);
        }


    }

    @media (max-width: 900px) {
        .pre {
            font-size: 20px;
            color: blue;
        }

        .frame {
            display: none;
        }

    }

    @media (max-width: 600px) {
        .pre {
            font-size: 20px;
            color: green;
        }

        .frame {
            display: none;
        }


    }
</style>

<div id="main">

    <body>
        <div class="container-sm">
            <x-menu-bar-home>
                {{--  <li><a class="btn btn-success btn-sm" href="{{ url('/') }}">Dashboard</a></li>--}}

                <li><a class="btn btn-primary btn-sm" href="{{ url('/attivita/index/' . $dataOggi . '/99') }}">Chiudi</a>
                </li>

            </x-menu-bar-home>


            <div class="row justify-content-md-center ">
                <div class="col col-lg-6">

                    @if (isset($attivita->image_file) && $attivita->image_file != null)
                        <img class="img_box" src="{{ asset('storage/imgtrek/' . $attivita->image_file) }}"
                            alt="attivita cai bologna">
                    @else
                        {{ 'IMMAGINE MANCANTE' }}
                    @endif

                    <div class="pre">
                        <div class="card-body">
                            <a href="{{ url('/attivita/singolo' . '/' . $attivita->id) }}">
                                <h5 class="card-title">{{ $attivita->titolo }}</h5>
                        </div>
                        <hr>
                        <div class="card-text" style="height: auto;">
                            <p>{{ $attivita->note }}</p>
                        </div>
                        <!----------------------- INIZIO ------------------->
                        @php
                            $fine = Carbon::createFromFormat('Y-m-d', $attivita->data_fine)->format('d-m-Y');
                            $inizio = Carbon::createFromFormat('Y-m-d', $attivita->data_inizio)->format('d-m-Y');
                        @endphp
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item"><label class="lab"> Inizio</label><span
                                    class="dato">{{ $inizio }}</span></li>
                            <li class="list-group-item"><label class="lab">Fine</label>
                                <span class="dato">{{ $fine }}</span>
                            </li>
                            <li class="list-group-item">
                                <!------------------------- ISCRIZIONI ----------------------------->

                                <div class="item">
                                    <label class="lab">Iscrizione</label><br>
                                    @if (isset($attivita->tipo_iscrizione) && $attivita->tipo_iscrizione != 4)
                                        <a class="btn btn-primary btn-sm" class="dropdown-item"
                                            href="{{ url('/iscrizione/tipo' . '/' . $attivita->tipo_iscrizione . '/' . $attivita->id) }}">
                                            {{ 'Iscrizione' }}
                                            {{-- // TODO <span class="rif">{{ $tipoiscrizione[$attivita->tipo_iscrizione]->tipo_iscrizione }}</span> --}}
                                            {{-- <span class="rif">{{ $tipoiscrizione->firstWhere('id', $attivita->tipo_iscrizione)->tipo_iscrizione ?? '' }}</span> --}}
                                        </a>
                                    @else
                                        {{ 'MANCA TIPO DI ISCRIZIONE' }}
                                    @endif
                                    <br>
                                </div>
                            </li>
                        </ul>
                        <div class="card-body">
                            <label class="lab">Contatti</label><br>
                            {{ $attivita->contatti }}
                            <br>
                            @if (isset($attivita->presentazione))
                                <hr>
                                <label class="lab">Presentazione programma</label><br>
                                {{ $attivita->presentazione }}
                                <br>
                            @endif
                        </div>
                        <!-- pdf interno -->
                        @if ($attivita->tipo_volantino == 0)
                            <div class="frame">
                                <iframe src="{{ url('/show-pdf' . '/' . $attivita->pdf_file . '/' . $attivita->id) }}"
                                    width="100%" height="600px">
                                    Il tuo browser non supporta gli iframe.
                                </iframe>
                            </div>
                        @endif
                        <!-- link pdf autogenerato -->
                        @if ($attivita->tipo_volantino == 2)
                            <iframe src="{{ url("/pagina_pdf/{$attivita->id}") }}" width="100%" height="600px">
                                Il tuo browser non supporta gli iframe.
                            </iframe>
                        @endif
<!-- pdf su server esterno -->
                        @if ($attivita->tipo_volantino == 1)
                            link esterno
                        @endif
                        0
                        {{-- <button type="button" class="btn btn-primary btn-sm">
                            <a class="dropdown-item" target="_blank"
                                href="{{ url("/show-pdf" . "/" . $attivita->pdf_file.'/'.$attivita->id) }}">Volantino</a>
                        </button> --}}

                        <button type="button" class="btn btn-secondary btn-sm">
                            <a class="btn btn-primary btn-sm"
                                href="{{ url('/attivita/index/' . $dataOggi . '/99') }}">Chiudi</a>
                        </button>

                    </div>
                </div>
            </div>
        </div>

    </body>
</div>




<script>
    $(document).ready(function() {
        var nomeFilePdf =
            '../storage/app/public/pdftrek/'.$escur - > volantino; // Sostituisci con il nome del tuo file PDF

        $.ajax({
            url: '/visualizza-pdf',
            type: 'GET',
            data: {
                filename: nomeFilePdf
            }, // Passa il nome del file come parametro
            success: function(response) {
                $('#pdf-container').html(response);
            },
            error: function(xhr, status, error) {
                console.error('Errore durante il caricamento del PDF:', error);
            }
        });
    });
</script>
