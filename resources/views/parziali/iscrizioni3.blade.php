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
    @if (strpos($attiv->link_modulo_esterno, 'https://') !== false)
        <a href="{{ $attiv->link_modulo_esterno }}" style="display: flex; align-items: center;">
            <span style="color: rgba(var(--bs-link-color-rgb));">
                {{ 'Iscrizione' }}
            </span>
            <span>
                @if ($attiv->socio == 1)
                    <label class="socio" style="margin-left: 10px;">Solo soci</label>
                {{--@else
                    <label class="socio" style="margin-left: 10px;">
                        <span class="libera">Libera</span>
                    </label>--}}
                @endif
            </span>
        </a>
    @else
        <span style="color: green;">{{ 'Errore (manca il link al modulo)' }}</span>
    @endif
</div>
