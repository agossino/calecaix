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

   

    .card.carta {
        
        padding: 5px;
        /* width: 18rem;*/
        margin: 10px;
        border-radius: 1px;
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

    <div id="main">

        <div class="container-fluid">

            <x-menu-bar>

                <form action="{{ url('attivita/cerca' . '/index') }}" method="GET">
                    <label class="lb_cerca"> </label>
                    <input type="text" class="cerca" name="cerca" placeholder="Inserisci una parola del titolo">
                    <button type="submit" style="margin-top:-3px;" class="btn btn-primary btn-sm">Cerca</button>
                </form>

            </x-menu-bar>

            @if (session('message'))
                <div class="alert alert-success">
                    {{ session('message') }}
                </div>
            @endif
            <div class="container-xl">
                <div class="grid-container_attivita">
                    <!-- visualizza tipo di attivita nel box in alto -->
                    @foreach ($attivita as $attiv)
                        <div class="card carta">
                            @if ($attiv->tipo_attivita == 0)
                                @include('parziali.calendario', ['attivita' => $attiv])
                            @elseif ($attiv->tipo_attivita == 1)
                                @include('parziali.trekking', ['attivita' => $attiv])
                            @endif
                        </div>
                    @endforeach

                </div>

            </div>



        </div>



</x-layout_cai>
