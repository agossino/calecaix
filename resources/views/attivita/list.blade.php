<!DOCTYPE html>
<html lang="it">

<head>
    @php
        use Carbon\Carbon;
        $message = 'message layout-to-container';
        $dataOggius = Carbon::now()->toDateString(); // Ottiene la data di oggi nel formato 'YYYY-MM-DD'
        $dataOggi = Carbon::createFromFormat('Y-m-d', $dataOggius)->format('d-m-Y');
    @endphp


    @php

        use App\Models\TipoVolantino;
        use App\Models\TipoAttivita;
        use App\Models\TipoIscrizione;
        $eventi = $viewData['attivita'];
        $tipoiscrizione = TipoIscrizione::where('published', 1)->get();
        $tipovolantino = TipoVolantino::where('published', 1)->get();
        $tipoattivita = TipoAttivita::where('published', 1)->get();

    @endphp

    <style>
        .img_box {
            width: 80px;
        }

        td {
            padding: 5px;
        }

        .contatti {
            width: 200px;
            overflow: auto;
        }

        .cerca {
            border: solid 1px #cccccc;
            border-radius: 5px;
            height: 37px;
        }

        .descrizione {
            height: 100px;
            overflow: auto;
        }

        .canc {
            color: red;
            margin-top: 5px
        }
    </style>


    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.0/css/bootstrap.min.css" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.5.0/css/bootstrap-datepicker.css"
        rel="stylesheet">
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.5.0/js/bootstrap-datepicker.js"></script>


    <!-- utilizzare queste versioni per il corretto funzionamento del popup -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</head>







<body>

    <div id="main">
        <div class="container-fluid">

            <!-- Barra con logo semplice-->
            <x-cai_bar_semplice />

            @if (session('message'))
                <div class="alert alert-success">
                    {{ session('message') }}
                </div>
            @endif

            <br>

            <x-menu-bar>

                <form action="{{ url('attivita/cerca' . '/list') }}" method="GET">
                    <input type="text" claas="cerca" name="cerca" placeholder="Inserisci una parola del titolo">
                    <button type="submit" class="btn btn-primary btn-sm">Cerca</button>
                </form>

            </x-menu-bar>
            <hr>

            <div class="table-responsive-xxl">
                <label>Per escludere un evento è possibile cancellarlo o sospenderlo dalla colonna 'Stato'</label>
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <!-- <th scope="col">Sel</th>-->
                            <th scope="col">ID</th>
                            <th scope="col">Stato</th>
                            <th scope="col" style="width: 20px;">Tipo volantino</th>
                            <th scope="col" style="width: 20px;">Autore</th>
                            <th scope="col" style="width: 200px;">titolo</th>
                            <th scope="col" style="width: 200px;"> inizio</th>
                            <th scope="col" style="width: 200px;"> fine</th>
                            <th scope="col" style="width: 200px;"> categoria</th>
                            <th scope="col"> image_file</th>
                            <th scope="col"style="width: 200px;"> volantino</th>
                            
                            <th scope="col" style="width: 200px;"> tipo_volantino</th>
                            <th scope="col" style="width: 100px;"> n. Massimo</th>
                            <th scope="col">Tipo iscrizione</th>

                        </tr>
                    </thead>
                    <tbody>

                        @foreach ($eventi as $attivita)
                            <tr>
                                <td>{{ $attivita->id }}</td>
                                <td>
                                    @if ($attivita->published == 0)
                                        <a class="btn btn-danger btn-sm"
                                            href="{{ url('/attivita/published') . '/' . $attivita->id }}">{{ 'Sospeso/Attiva' }}</a>
                                    @else
                                        <a class="btn btn-success btn-sm"
                                            href="{{ url('/attivita/published') . '/' . $attivita->id }}">{{ 'Attivo/Sospeso' }}</a>
                                    @endif
                                    <a type="button" class="btn btn-danger btn-sm canc"
                                        href="{{ url('/attivita/destroy') . '/' . $attivita->id }}"
                                        onclick="return confirm('Sei sicuro? Attenzione.. ')">Cancella</a>

                                </td>
                                <td scope="row">
                                    <!-- TODO  fare pagina impostazioni interne per la gestione dei tipi di volantino -->
                                      <!-- visualizza tutti i tipi di volantino in rosso il tipo utilizzato -->
                                      <!-- per escludere un volantino è possibile  ponendo a 0 'published' sulla tabella mysql tipo_volantino -->
                                    @foreach ($tipovolantino as $tipo)
                                        @if ($tipo->published == 1)
                                            <a class="link" href="{{ url('/attivita/edit') . '/' . $attivita->id . '/' . $tipo->id }}">
                                                @if ($tipo->tipo_volantino == $attivita->tipo_volantino)
                                                    <span style="color: red;">{{ $tipo->nome }}</span>
                                                @else
                                                    {{ $tipo->nome }}
                                                @endif
                                            </a><br>
                                        @endif
                                    @endforeach

                                </td>
                                <td scope="row">

                                    {{ $attivita->nome . ' ' . $attivita->cognome }}

                                </td>
                                <td>{{ $attivita->titolo }}</td>
                                @php
                                    $fine = Carbon::parse($attivita->data_fine)->format('d-m-Y');
                                    $inizio = Carbon::parse($attivita->data_inizio)->format('d-m-Y');
                                @endphp
                                <td>{{ $inizio }}</td>
                                <td>{{ $fine }}</td>

                                <td>
                                    @if (isset($attivita->tipo_attivita) && $attivita->tipo_attivita != '')
                                        {{ $tipoattivita->firstWhere('id', $attivita->tipo_attivita)->nome ?? '' }}
                                </td>
                        @endif
                        <td> <img class="img_box" src="{{ asset('storage/imgtrek/' . $attivita->image_file) }}"
                                alt="eventi cai bologna">

                        <td> <button type="button" class="btn btn-primary btn-sm btprog">
                                
                                @if ($attivita->tipo_volantino == 0 || $attivita->tipo_volantino == 1)
                                    <a class="dropdown-item" target="_blank"
                                        href="{{ url("/show-pdf/{$attivita->pdf_file}/{$attivita->id}") }}">Programma</a>
                                @endif

                                @if ($attivita->tipo_volantino == 2)
                                    <!-- visualizza pagina programma -->
                                    <a class="dropdown-item" target="_blank"
                                        href="{{ url('/attivita/get_programma' . '/' . $attivita->id) }}">Programma</a>
                                @endif
                            </button></td>


                     

                        <td>
                            @if (isset($attivita->tipo_volantino) && $attivita->tipo_volantino != '')
                                {{ $tipovolantino->firstWhere('id', $attivita->tipo_volantino)->nome ?? '' }}
                            @endif

                        </td>

                        <td>{{ $attivita->numeromassimo }}</td>

                        <td>
                            @if (isset($attivita->tipo_iscrizione) && $attivita->tipo_iscrizione != '')
                                {{ $tipoiscrizione->firstWhere('id', $attivita->tipo_iscrizione)->nome ?? '' }}
                            @endif
                        </td>



                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <br>

        </div>

        {{-- @include('popup_a') --}}

</body>

</html>
