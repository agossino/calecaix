@php
    use Carbon\Carbon;
    use App\Models\CaiSezioni;
    use App\Models\TipoAttivita;
    use App\Models\Attivita;
    use App\Models\TipoIscrizione;
    use App\Models\Iscrizione;
@endphp

@php
    // $attivita = Attivita::where("published", 1)->get();
    $attivita = $viewData['attivita'];
    $tipo_attivita = TipoAttivita::where('published', 1)->get();
    $iscrizione_tipo = TipoIscrizione::where('published', 1)->get();
    $cai_sezioni = CaiSezioni::where('published', 1)->get();
 
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
            <div class="col col-lg-6">
                <x-cai_bar_semplice />

                <x-menu-bar-home>
                    <li> <a class="btn btn-primary btn-sm" href="{{ url()->previous() }}">
                            <i class="fa fa-arrow-circle-o-left"></i>
                            <span>Indietro</span>
                        </a> </li>
                </x-menu-bar-home>

                <label class="modulo">Modulo iscrizione caibo </label>
                <div class="tito">{{ $attivita->titolo }}</div>

                <form action="{{ route('iscrizione.store') }}" method="POST">
                    @csrf

                    <input type="hidden" class="form-control" id="iscrizione_tipo" name="iscrizione_tipo"
                        value="1">
                    <input type="hidden" class="form-control" id="attivita_id" name="attivita_id"
                        value="{{ $attivita->id }}">


                    <div class="mb-3">
                        <label for="nome" class="form-label">Nome*</label>
                        <input type="text" class="form-control" id="nome" name="nome" required>
                    </div>

                    <div class="mb-3">
                        <label for="cognome" class="form-label">Cognome*</label>
                        <input type="text" class="form-control" id="cognome" name="cognome" required>
                    </div>

                    <div class="mb-3">
                        <label for="indirizzo" class="form-label">Indirizo (opzionale)</label>
                        <input type="text" class="form-control" id="indirizzo" name="indirizzo" required>
                    </div>

                    <div class="mb-3">
                        <label for="telefono" class="form-label">Telefono (opzionale)</label>
                        <input type="text" class="form-control" id="telefono" name="telefono" required>
                    </div>


                    <div class="mb-3">
                        <label for="socio_cai" class="form-label">Socio CAI*</label>
                        <select class="form-select" id="socio_cai" name="socio_cai" required>
                            <option value="">Seleziona</option>
                            <option value="Si">Sì</option>
                            <option value="No">No</option>
                        </select>
                    </div>



                    <div class="mb-3" id="sezione_container" style="display: none;">
                        <label for="sezione" class="form-label">Sezione CAI*</label>
                        <select class="form-select" name="sezione" aria-label="Sezione">
                            <option selected>Selezione</option>
                            @foreach ($cai_sezioni as $sezione)
                                <option value="{{ $sezione->id }}">{{ $sezione->nome }}</option>
                            @endforeach
                        </select>
                    </div>


                    <div class="mb-3">
                        <label for="email" class="form-label">Tua Email* (verra mandata email di conferma)</label>
                        <input type="email" class="form-control" id="email" name="email" required>
                    </div>

                   
                    @if ($attivita->tipo_attivita == 6)
                        <div class="mb-3">
                            <label for="data_nascita" class="form-label">Data di nascita*</label>
                            <input type="date" class="form-control" id="data_nascita" name="data_nascita" required>
                            <label for="luogo_nascita" class="form-label">Luogo di nascita*</label>
                            <input type="text" class="form-control" id="luogo_nascita" name="luogo_nascita" required>
                        </div>
                    @endif


                    <div class="mb-3 form-check">
                        <input type="checkbox" class="form-check-input" id="accettazione_termini"
                            name="accettazione_termini" required>
                        <label class="form-check-label" for="accettazione_termini">
                            Accetto i <a href="{{ route('termini') }}" target="_blank">Termini</a>
                        </label>
                    </div>

                    <div class="mb-3 form-check">
                        <input type="checkbox" class="form-check-input" id="accettazione_privacy"
                            name="accettazione_privacy" required>
                        <label class="form-check-label" for="accettazione_privacy">
                            Accetto la <a href="{{ route('privacy') }}" target="_blank">Privacy</a>
                        </label>
                    </div>

                    <input type="hidden" id="iscrizione_tipo" name="iscrizione_tipo" value="{{ 1 }}"
                        required>

                    <button type="submit" class="btn btn-primary">Registrati</button>
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
