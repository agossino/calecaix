<div>
    <!-- Knowing is not enough; we must apply. Being willing is not enough; we must do. - Leonardo da Vinci -->
</div>
<style>
    li {
        float: left;
        margin-left: 20px;
        list-style-type: none;
    }

    .menu-bar {
        margin-top: 5px;
        margin-bottom: 6px;
        padding: 3px;
        border: solid 1px #ccc;
        border-radius: 3px;

    }

    .dada {
        font-weight: 700;
        color: green;

    }


</style>

@php
    use Carbon\Carbon;
    $user = auth()->user();
    $dataOggius = Carbon::now()->toDateString(); // Ottiene la data di oggi nel formato 'YYYY-MM-DD'
    $dataOggi = Carbon::createFromFormat("Y-m-d", $dataOggius)->format("d-m-Y");
@endphp


<div class="menu-bar">
    <div class="row rbtn">
        <nav>
            <ul>
                @if (app()->environment("local"))
                    <li class="l"><a class="btn btn-primary btn-sm homeattivita"
                            href="{{ url("http://127.0.0.1:8000/") }}">Home Attività</a></li>
                @else
                    <li class="l"><a class="btn btn-primary btn-sm homeattivita"
                            href="{{ url("https://caibo.it/calecai/public") }}">Home Attività</a></li>
                @endif

                @if (isset($user) &&
                        ($user->role == "editor" || $user->role == "amministratore" || $user->role == "editor_accompagnatore"))
                    <li><a class="btn btn-success btn-sm" href="{{ url("/form/page1") }}">Aggiungi Attività</a></li>
                    <li>
                        <a type="button" class="btn btn-primary btn-sm" href="{{ url("/attivita/list") }}">Lista
                            Attività
                        </a>
                    </li>
                @endif



                <li>
                    <div style="padding: 5px;">
                        <a id="attivitaLink" class="btn btn-success btn-sm"
                            href="{{ url("/attivita/index/" . $dataOggi . "/99") }}">Vedi tutte le Attivita </a>
                        <div class="dv" style="margin-top: 10px;">
                            <label class="lab dada">Da Data inizio</label>
                            <input type="text" class="date form-control" id="dataOggi_index" name="dataOggi_menu"
                                value="{{ $dataOggi }}">
                        </div>
                    </div>
                </li>

                <script>
                    // Passa l'APP_URL dal server al JavaScript
                    var baseUrl = "{{ url("/") }}"; // Usa url() per ottenere l'URL base

                    document.getElementById('dataOggi_index').addEventListener('input', function() {
                        var dataOggi = this.value;
                        var link = document.getElementById('attivitaLink');
                        link.href = baseUrl + '/attivita/index/' + dataOggi + '/99'; // Costruisci il link dinamicamente
                    });
                </script>

                {{ $slot }}
            </ul>
        </nav>
    </div>
</div>
{{-- Aggiungi questo per il debug --}}
<script>
    console.log('Environment:', '{{ app()->environment() }}');
</script>