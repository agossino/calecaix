@php
    use Carbon\Carbon;
    use App\Models\CaiSezioni;
    use App\Models\TipoAttivita;
    use App\Models\Attivita;
    use App\Models\TipoIscrizione;
    use App\Models\Iscrizione;
    use App\Models\Iscritti;
    use App\Models\StatoIscrizione;
@endphp

@php
    $attivita = $viewData['attivita'];
    $iscritti = $viewData['iscritti'];
    //$tipo_attivita = TipoAttivita::where('published', 1)->get();
    $tipo_iscrizione = TipoIscrizione::where('published', 1)->get();
    $cai_sezioni = CaiSezioni::where('published', 1)->get();
    $stato_iscrizione = StatoIscrizione::where('published', 1)->get();

    $user = auth()->user();
    $role = $user->role;

@endphp


<head>

    <style>
        .alert {
            width: 400px;
            margin-left: 40%;
        }

        .tito {
            text-align: center;
            font-weight: 700;
            color: darkgreen
        }

        .modulo {

            color: rgb(80, 17, 51);
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

        body {
            font-size: 16px;
        }
    </style>
</head>

<!-- Iscrizione tipo1 modulo caibo -->
<x-layout_cai>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="container mt-5">

        <div class="row justify-content-md-center ">
            <div class="col col-lg-10">
                <x-cai_bar_semplice />

                <x-menu-bar-home>
                    <li> <a class="btn btn-primary btn-sm" href="{{ url()->previous() }}">
                            <i class="fa fa-arrow-circle-o-left"></i>
                            <span>Chiudi</span>
                        </a> </li>
                </x-menu-bar-home>

                <label class="modulo">Lista iscritti </label>
                <div class="tito">{{ $attivita->titolo }}</div>

                <form action="{{ route('iscritti.edit') }}" method="POST">
                    @csrf

                    <div class="table-responsive">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <!-- <th scope="col">Sel</th>-->
                                    <th scope="col">Nome</th>
                                    <th scope="col">Cognome</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Telefono</th>
                                    <th scope="col">Socio CAI</th>
                                    <th scope="col">Sezione CAI</th>
                                    <th scope="col">Tipo Iscrizione</th>
                                    <th scope="col">Stato</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($iscritti as $iscritto)
                                    @if ($user->role == 'amministratore' || $user->role == 'accompagnatore_editor')
                                        <tr>
                                            <td>{{ $iscritto->nome }}</td>
                                            <td>{{ $iscritto->cognome }}</td>
                                            <td>{{ $iscritto->email }}</td>
                                            <td>{{ $iscritto->telefono }}</td>
                                            <td>{{ $iscritto->socio_cai }}</td>
                                            @if ($iscritto->sezione != null && $iscritto->sezione != 'Selezione')
                                                <td>{{ $cai_sezioni[$iscritto->sezione - 1]->nome }}</td>
                                            @else
                                                <td></td>
                                            @endif
                                            <td>
                                                {{$tipo_iscrizione->firstWhere('id', $iscritto->iscrizione_tipo)->nome ?? '' }}
                                            
                                            </td>

                                            <td>
                                                <select id="stato_iscrizione" name="stato_iscrizione"
                                                    class="form-select">
                                                    <option value="{{ $iscritto->stato_iscrizione }}">
                                                        {{ $stato_iscrizione[$iscritto->stato_iscrizione]->nome }}
                                                        @foreach ($stato_iscrizione as $attiv)
                                                    <option value="{{ $attiv->id }}"> {{ $attiv->nome }}
                                                    </option>
                                    @endforeach
                                    </option>
                                    </select>
                                    </td>
                                    <td><a href="{{ route('iscritti.delete', $iscritto->id) }}"
                                            class="btn btn-danger">Cancella</a></td>
                                    </tr>
                                @elseif($user->role == 'accompagnatore')
                                    <tr>
                                        <td>{{ $iscritto->nome }}</td>
                                        <td>{{ $iscritto->cognome }}</td>
                                        <td>{{ $iscritto->email }}</td>
                                        <td>{{ $iscritto->telefono }}</td>
                                        <td>{{ $iscritto->socio_cai }}</td>
                                        @if ($iscritto->sezione != null && $iscritto->sezione != 'Selezione')
                                            <td>{{ $cai_sezioni[$iscritto->sezione - 1]->nome }}</td>
                                        @else
                                            <td></td>
                                        @endif
                                        <td>{{$tipo_iscrizione->firstWhere('id', $iscritto->iscrizione_tipo)->nome ?? '' }}</td>
                                        <td>{{ $stato_iscrizione[$iscritto->stato_iscrizione]->nome }}</td>
                                        <td><a href="{{ route('iscritti.delete', $iscritto->id) }}"
                                                class="btn btn-danger">Cancella</a></td>
                                    </tr>
                                @endif
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <input type="hidden" name="attivita_id" value="{{ $attivita->id }}">
                    <input type="hidden" name="tipo_iscrizione" value="1">

                    <a href="javascript:history.back()" class="btn btn-primary" role="button"
                        aria-pressed="true">Indietro</a>

                    <button type="submit" class="btn btn-secondary">Aggiorna</button>
                </form>

            </div>


            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

            <script>
                document.getElementById('socio_cai').addEventListener('change', function() {
                    var sezioneContainer = document.getElementById('sezione_container');
                    if (this.value === 'Si') {
                        sezioneContainer.style.display = 'block';
                    } else {
                        sezioneContainer.style.display = 'none';
                    }
                });
            </script>
        </div>
    </div>

</x-layout_cai>
