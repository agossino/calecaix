@php
    use Carbon\Carbon;
    use App\Models\CaiSezioni;
    use App\Models\TipoAttivita;
   
    use App\Models\TipoIscrizione;
    use App\Models\Iscrizione;
@endphp

@php
    
    $tipo_attivita = TipoAttivita::where("published", 1)->get();
    $iscrizione = $viewData["tipo_iscrizione"]; //tipo, escursione,categoria
    $tipo_iscrizione = TipoIscrizione::where("published", 1)->get();
    $iscrizioni = Iscrizione::where("published", 1)->get();
    $caisezioni = CaiSezioni::all();

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
        }
    </style>
</head>


<x-layout_cai>

  
    
   
    @if (session("success"))
        <div class="alert alert-success">
            {{ session("success") }}
        </div>
    @endif

    <div class="container mt-5">

        <x-cai_bar_semplice />

        <x-menu-bar-home>
            <li> <a class="btn btn-primary btn-sm" href="{{ url()->previous() }}">
                    <i class="fa fa-arrow-circle-o-left"></i>
                    <span>Indietro</span>
                </a> </li>
        </x-menu-bar-home>

        <div class="tito">{{ $evento->titolo }}</div>

        <form action="{{ route("iscrizione.store") }}" method="POST">
            @csrf

            <input type="hidden" class="form-control" name="iscrizione_tipo" value={{ $iscrizione["tipo_iscrizione"] }}>
            <input type="hidden" class="form-control" name="evento" value={{ $iscrizione["evento"] }}>
            <input type="hidden" class="form-control" name="categoria" value={{ $iscrizione["categoria"] }}>


            <div class="mb-3">
                <label for="nome" class="form-label">Nome:</label>
                <input type="text" class="form-control" id="nome" name="nome" required>
            </div>

            <div class="mb-3">
                <label for="cognome" class="form-label">Cognome:</label>
                <input type="text" class="form-control" id="cognome" name="cognome" required>
            </div>

            <div class="mb-3">
                <label for="indirizzo" class="form-label">Indirizzo:</label>
                <input type="text" class="form-control" id="indirizzo" name="indirizzo" required>
            </div>

            <div class="mb-3">
                <label for="socio_cai" class="form-label">Socio CAI:</label>
                <select class="form-select" id="socio_cai" name="socio_cai" required>
                    <option value="">Seleziona</option>
                    <option value="Si">Sì</option>
                    <option value="No">No</option>
                </select>
            </div>

            <!--<div class="mb-3" id="sezione_container" style="display: none;">
                <label for="sezione" class="form-label">Sezione:</label>
                <input type="text" class="form-control" id="sezione" name="sezione">
            </div>-->

            <div class="mb-3" id="sezione_container" style="display: none;">
                <label for="sezione" class="form-label">Sezione CAI:</label>
                <select class="form-select" name="sezione" aria-label="tipo_iscrizione">
                    <option selected>Selezione</option>
                    @foreach ($caisezioni as $caisezione)
                        <option value="{{ $caisezione->id }}">
                            {{ $caisezione->nome }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label for="email" class="form-label">Email:</label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>

            <div class="mb-3">
                <label for="cellulare" class="form-label">Cellulare:</label>
                <input type="text" class="form-control" id="cellulare" name="cellulare" required>
            </div>

            <div class="mb-3 form-check">
                <input type="checkbox" class="form-check-input" id="accettazione_termini" name="accettazione_termini"
                    required>
                <label class="form-check-label" for="accettazione_termini">
                    Accetto i <a href="{{ route("termini") }}" target="_blank">Termini</a>
                </label>
            </div>

            <div class="mb-3 form-check">
                <input type="checkbox" class="form-check-input" id="accettazione_privacy" name="accettazione_privacy"
                    required>
               {{--<label class="form-check-label" for="accettazione_privacy">
                    Accetto la <a href="{{ route("privacy") }}" target="_blank">Privacy</a>
                </label>--}}
                <label class="form-check-label" for="accettazione_privacy">
                    Accetto la <a href="https://caibo.it/privacy.html" target="_blank">Privacy</a>
                </label>
            </div>

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

</x-layout_cai>
