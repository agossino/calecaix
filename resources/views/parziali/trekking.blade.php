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
    .par {
        background-color:rgb(196, 204, 121);
    }

</style>

<div id="main">

    <div class="container-lg">


        @if (session('message'))
            <div class="alert alert-success">
                {{ session('message') }}
            </div>
        @endif

         

                <div class="par">
                    {{ $tipoattivita->find($attiv->tipo_attivita)->nome }}<br>
                    {{ $attiv->titolo }}<br>
                </div>
                <div>
                    @if (isset($attiv->image_file) && $attiv->image_file != null)
                        <a href="{{ url('/attivita/singolo' . '/' . $attiv->id) }}">
                            <img class="img_box" src="{{ asset('storage/imgtrek/' . $attiv->image_file) }}"
                                alt="attivita cai bologna"></a>
                    @else
                        {{ 'IMMAGINE MANCANTE' }}
                    @endif
                </div>

 

    </div>
</div>
