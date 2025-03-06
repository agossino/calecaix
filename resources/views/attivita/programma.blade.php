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
        $attivita = $viewData['attivita'];

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

                <button style="margin-left:10px;" onclick="window.history.back();" class="btn btn-primary btn-sm"">Chiudi</button>
  
                </li>
                </x-menu-bar-home>


                    <div class="row justify-content-md-center ">

                        <!----------------- TIPO VOLANTINO -------------->
                        <div class="col col-lg-8">

                            <?php
                            $stringa = $attivita->descrizione;
                   
                            ?>

                            <div style="text-align: center;">
                                <label class="labex">{{ $attivita->titolo }}</label><br>
                            </div>

                            <div>
                                <div style="text-align: center;margin-top:20px;margin-bottom:15px;">
                                    @if (isset($attivita->image_file) && $attivita->image_file != null)
                                        <a href="{{ url('/attivita/singolo' . '/' . $attivita->id) }}">
                                            <img class="img_box"
                                                src="{{ asset('storage/imgtrek/' . $attivita->image_file) }}"
                                                alt="attivita cai bologna">
                                        </a>
                                    @else
                                        {{ 'IMMAGINE MANCANTE' }}
                                    @endif
                                </div>
                            </div>

                            <div>
                                <label class="lab">Descrizione:</label>
                                <div >{!! $stringa !!}</div>
                            </div>

                            @php

                                $fields = [
                                    'Data inizio' => $attivita->data_inizio,
                                    'Data fine' => $attivita->data_fine,
                                    'Luogo ritrovo' => $attivita->luogoritrovo,
                                    'Ora Ritrovo' => $attivita->ora_ritrovo,
                                    'N. minimo' => $attivita->numero_minimo,
                                    'N. Massimo' => $attivita->numero_massimo,
                                    'Lunghezza' => $attivita->lunghezza,
                                    'Durata' => $attivita->durata,
                                    'Difficoltà' => $attivita->difficolta,
                                    'Dislivello' => $attivita->dislivello,
                                    'Quota minima' => $attivita->quota_minima,
                                    'Quota massima' => $attivita->quota_massima,
                                    'Nome' => $attivita->nome,
                                    'Cognome' => $attivita->cognome,
                                    'Telefono' => $attivita->telefono,
                                    'Email' => $attivita->email,
                                    'Qualifica' => $attivita->qualifica,
                                    'Specializzazione' => $attivita->specializzazione,
                                    'Contatti guida' => $attivita->contatti_guida,
                                    'Iscrizione' => $attivita->iscrizione,
                                    'Condizioni' => $attivita->condizioni,
                                    'Costo' => $attivita->costo,
                                    'Note' => $attivita->note,
                                ];
                            @endphp

                            <div class="row">
                                <div class="col-md-6">
                                    @foreach ($fields as $label => $value)
                                        @if ($loop->index % 2 == 0)
                                            <div style="border:solid 1px #ccc;margin:15px;padding:3px;">
                                                <span style="color: blue;">{{ $label }}:</span>
                                                <span style="color: red;">{{ $value }}</span>
                                            </div>
                                        @endif
                                    @endforeach
                                </div>
                                <div class="col-md-6">
                                    @foreach ($fields as $label => $value)
                                        @if ($loop->index % 2 != 0)
                                            <div style="border:solid 1px #ccc;margin:15px;padding:3px;">
                                                <span style="color: blue;">{{ $label }}:</span>
                                                <span style="color: red;">{{ $value }}</span>
                                            </div>
                                        @endif
                                    @endforeach
                                </div>
                                <a target="_blank" href="{{ url("/pagina_pdf/{$attivita->id}") }}">Crea Pdf</a><br>
                                <a target="_blank" href="{{ url("/generate-image/{$attivita->id}") }}">Crea jpg</a><br>
                            </div>
                            <br>
                        </div>

                    </div>
                <br><br>

            </div>
        </body>
    </div>
</x-layout_cai>
