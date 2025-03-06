

@php
    use Carbon\Carbon;
    use App\Models\CaiSezioni;
    use App\Models\TipoAttivita;
   
    use App\Models\TipoIscrizione;
    use App\Models\StatoIscrizione;
    use App\Models\Iscrizione;
@endphp
@php
    $tipo_attivita = TipoAttivita::where("published", 1)->get();
    $tipo_iscrizione = TipoIscrizione::where("published", 1)->get();
    $stato_iscrizione = StatoIscrizione::where("published", 1)->get();
    $caisezioni = CaiSezioni::all();

    $eventi = $viewData["eventi_titoli"]; 
    $iscrizioni = $viewData["iscrizione"];
@endphp
<x-layout_cai>
    <x-cai_bar_semplice />
    <h1 style="text-align:center">Lista iscrizioni</h1>
    <x-menu-bar-home>
        <li> <a class="btn btn-primary btn-sm" href="{{ url()->previous() }}">
                <i class="fa fa-arrow-circle-o-left"></i>
                <span>Indietro</span>
            </a> </li>
    </x-menu-bar-home>

    <div class="table-responsive-xxl">
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th scope="col" style="width: 20px;">Annulla iscriz.</th>
                    <th scope="col" style="width: 20px;">Abilita iscriz.</th>
                    <th scope="col" style="width: 20px;">Cancella iscriz.</th>
                    <th scope="col" style="width: 200px;">Titolo</th>
                    <th scope="col" style="width: 200px;">nome</th>
                    <th scope="col" style="width: 200px;"> cognome</th>
                    <th scope="col" style="width: 200px;"> socio CAI</th>
                    <th scope="col" style="width: 200px;"> indirizzo</th>
                    <th scope="col"style="width: 200px;"> sezione</th>
                    <th scope="col" style="width: 200px;"> email</th>
                    <th scope="col" style="width: 200px;"> Cellulare</th>
                    <th scope="col" style="width: 100px;"> Categoria</th>
                    <th scope="col">Tipo iscrizione</th>
                    <th scope="col">Iscritto</th>
                    <th scope="col">Pubblicato</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($iscrizioni as $iscri)
                    <tr>
                        <td><a href="{{ url("/iscrizione.annulla_iscriz"."/".$iscri->id) }}">Annulla</a></td>
                        <td><a style="color:green;"href="{{ url("/iscrizione.abilita_iscriz"."/".$iscri->id) }}">Abilita</a></td>
                        <td><a style="color:red;" href="{{ url("/iscrizione.cancella_iscriz"."/".$iscri->id) }}"onclick="return confirm('Sei sicuro? Attenzione.. ')">Cancella</a></td>
                        <td>{{ $eventi[$iscri->evento] }}</td>
                        <td>{{ $iscri->nome }}</td>
                        <td>{{ $iscri->cognome }}</td>
                        <td>{{ $iscri->socio_cai }}</td>
                        <td>{{ $iscri->indirizzo }}</td>
                        <td>{{ $iscri->sezione }}</td>
                        <td>{{ $iscri->email }}</td>
                        <td>{{ $iscri->cellulare }}</td>
                        <td>{{ 'xx' }}{{ $tipo_attivita[$iscri->categoria]->nome }}{{$tipo_attivita->firstWhere('id', $iscri->categoria)->nome ?? '' }}</td>
                        
                        <td>{{ $tipo_iscrizione[$iscri->iscrizione_tipo]->nome }}</td>
                        <td>{{ $stato_iscrizione[$iscri->iscrizione]->nome }}</td>
                        @if ($iscri->published == 1)
                            <td>{{ "Si" }}</td>
                        @else
                            <td>{{ "No" }}</td>
                        @endif
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</x-layout_cai>