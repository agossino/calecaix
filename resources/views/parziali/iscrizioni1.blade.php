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

<!-- Modulo esterno -->
<div>
    <a href="{{ url('/iscrizione/tipo' . '/' . $attiv->tipo_iscrizione . '/' . $attiv->id) }}">
        {{ 'Iscrizione' }}
        @if ($attiv->socio == 1)
            <label class="socio">(Solo soci CAI)</label><br>
        @endif
    </a>
    
</div>
