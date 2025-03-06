@php
    use Carbon\Carbon;
@endphp


@php

    use App\Models\TipoVolantino;
    use App\Models\TipoAttivita;
    use App\Models\TipoIscrizione;
    use App\Models\CaiSezioni;
    use App\Models\TipoSpecializzazione;

    use App\Models\TipoCalendario;
    use App\Models\TipoDifficolta;
    use App\Models\TipoQualifica;

    $tipospecializzazione = TipoSpecializzazione::where('published', 1)->get();

    $tipoqualifica = TipoQualifica::where('published', 1)->get();
    $tipodifficolta = TipoDifficolta::where('published', 1)->get();
    $tipocalendario = TipoCalendario::where('published', 1)->get();

    $tipoiscrizione = TipoIscrizione::where('published', 1)->orderBy('order', 'ASC')->get();
    $tipovolantino = TipoVolantino::where('published', 1)->orderBy('order', 'ASC')->get();
    $tipoattivita = TipoAttivita::where('published', 1)->orderBy('order', 'ASC')->get(); // come tabe
    $tipo_iscrizione = TipoIscrizione::where('published', 1)->get();
    $cai_sezioni = CaiSezioni::where('published', 1)->get();
    // $tipoattivita = $viewData['tipoattivita']; //ordinato come order
    $attivita = $viewData['attivita'];

    if (isset($attivita->data_fine)) {
        $fine = Carbon::parse($attivita->data_fine)->format('d-m-Y');
    }
    if (isset($attivita->data_inizio)) {
        $inizio = Carbon::parse($attivita->data_inizio)->format('d-m-Y');
    }
    $user = auth()->user();
@endphp

<style>
    img#preview {
        width: 100%;
        height: 100%;
    }

    .titolo {
        color: green;
        font-weight: 600;
        font-size: 18px;
    }

    img#prevold {
        width: 100%;
    }

    div#imageold {
        WIDTH: 200PX;
        height: 200px;
    }

    .preprev {
        border: solid 1px #ccc;
        width: 300px;
        height: 300px;
        margin: 10px;
        padding: 2px;
    }

    .form-control {
        font-size: 16px;
    }

    .lab {
        font-weight: 800;
        color: blue;
        margin-top: 7px;
        margin-bottom: -3px;
    }

    .labz {
        font-weight: 800;
        color: blue;
        margin-top: 10px;
        margin-bottom: 3px;
    }

    .co {
        margin-left: 2%;
    }

    .img_box {
        width: 300px;
    }
</style>


<x-layout_cai>
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif


    <div class="container-xxl">
        <div class="row justify-content-center">

            <!-- Barra con logo semplice-->
            <x-cai_bar_semplice />

            <x-menu-bar-home>
                <li><a class="btn btn-success btn-sm" href="{{ url('/form/page1') }}">Aggiungi</a></li>
                <li>
                    <a type="button" class="btn btn-primary btn-sm" href="{{ url('/attivita/list') }}">Lista
                        Attività
                    </a>
                </li>
               
            </x-menu-bar-home>

            @if (session('message'))
                <div class="alert alert-success">
                    {{ session('message') }}
                </div>
            @endif


            <div class="container">
                <div class="row">
                    <div class="col-md-6 co">
                        <form method="POST" action="{{ url("/attivita/save_edit/{$attivita->id}") }}"
                            enctype="multipart/form-data">
                            @csrf

                            <button type="submit" class="btn btn-primary">Salva</button>
                            
                            <input type="hidden" name="tipo_volantino" value="{{ 2 }}">
                            <div class="col-sm">
                                <br>
                                <!-- tipo volantino -->
                                <div style="border:solid 1px #ccc; padding:10px; margin:10px;">
                                    <label>
                                        <span style="font-weight:700">Autogenerato</span> viene creato dalla
                                        applicazione dai dati inseriti, è necessaria una descrizione<br>
                                    </label>
                                    </label>
                                    <br>

                                    <!-- aggiorna descrizione se autogenerato -->
                                    <div id="volantino_container">
                                        <label class="labz">Modifica testo volantino autogenerato</label>
                                        <br>

                                        <a type="button" class="btn btn-primary btn-sm" target="_blank"
                                            href="{{ url('/attivita/show_descrizione') . '/' . $attivita->id }}">Aggiorna
                                            Volantino</a><br>
                                    </div>
                                </div>

                                <div>
                                    <label class="lab">Calendario o attività singola?</label>
                                    <br>
                                    <label>Se calendario 'Parziale' o 'Annuale' l'attività appare nell'elenco
                                        fino a 'Data fine attivita'</label>
                                    <br>
                                    <label class="lab">Tipo calendario</label>
                                    <select id="tipo_calendario" name="calendario" class="form-select"
                                        aria-label="calendario" placeholder="calendario">
                                        <option value="{{ $attivita->calendario }}">
                                            {{ $tipocalendario->firstWhere('id', $attivita->calendario)->nome ?? '' }}
                                        </option>
                                        @foreach ($tipocalendario as $iscriz)
                                            <option value="{{ $iscriz->id }}"> {{ $iscriz->nome }}</option>
                                        @endforeach
                                    </select>
                                </div>


                                <div>
                                    <label class="lab">Tipo Iscrizione</label>
                                    <select id="tipo_iscrizione" name="tipo_iscrizione" class="form-select"
                                        aria-label="tipo_iscrizione" placeholder="tipo_iscrizione">
                                        <option value="{{ $attivita->tipo_iscrizione }}">
                                            {{ $tipoiscrizione->firstWhere('tipo_iscrizione', $attivita->tipo_iscrizione)->nome ?? '' }}
                                        </option>
                                        @foreach ($tipoiscrizione as $iscriz)
                                            <option value="{{ $iscriz->tipo_iscrizione }}"> {{ $iscriz->nome }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>


                                <div>
                                    <label class="lab">Tipo attivita</label>
                                    <select id="tipo_attivita" name="tipo_attivita" class="form-select"
                                        aria-label="tipo_attivita" placeholder="tipo_attivita">
                                        <option value="{{ $attivita->tipo_attivita }}">
                                            {{ $tipoattivita->firstWhere('tipo_attivita', $attivita->tipo_attivita)->nome ?? '' }}
                                        </option>
                                        @foreach ($tipoattivita as $iscriz)
                                            <option value="{{ $iscriz->tipo_attivita }}"> {{ $iscriz->nome }}</option>
                                        @endforeach
                                    </select>
                                </div>


                                <!-------------- SOCI CAI ------------------------->
                                <label class="lab" for="socio_cai" class="form-label">Solo Soci CAI</label>
                                <select class="form-select" id="socio_cai" name="socio_cai">
                                    <option value="Si" {{ $attivita->socio_cai == 'Si' ? 'selected' : '' }}>Sì
                                    </option>
                                    <option value="No" {{ $attivita->socio_cai == 'No' ? 'selected' : '' }}>No
                                    </option>
                                </select>
                                <br>

                                <!-- titolo -->
                                <label class="lab">Titolo attività</label>
                                <input type="text" class="form-control titolo" name="titolo"
                                    value="{{ old('titolo') . $attivita->titolo }}" required>
                                <br>

                                <div id="descrizione_container">
                                    <label class="lab">Note</label>
                                    <label>Le Note vengono visualizzate sotto il titolo possono essere usate anche per
                                        data e luogo di eventuale presentazione</label>
                                    <textarea id="summernote" name="note" rows="3" cols="60">{{ strip_tags($attivita->note) }}</textarea>
                                    <br>
                                </div>
                                <br>
                                <!--------------- fine socio cai --------------------->

                                <!-- Accompagnatore -->
                                <label class="lab">Nome accompagnatore</label>
                                <input type="text" class="form-control" name="nome"
                                    value="{{ old('nome') . $attivita->nome }}">

                                <!-- Accompagnatore -->
                                <label class="lab">Cognome accompagnatore</label>
                                <input type="text" class="form-control" name="cognome"
                                    value="{{ old('cognome') . $attivita->cognome }}">

                                <!-- Accompagnatore -->
                                <label class="lab">Email accompagnatore</label>
                                <input type="email" class="form-control" name="email"
                                    value="{{ old('email') . $attivita->email }}">

                                <!-- Accompagnatore -->
                                <label class="lab">Contatti </label>
                                <input type="text" class="form-control" name="contatti"
                                    value="{{ old('contatti') . $attivita->cognome }}">

                                <!-- Quota lunghezza -->
                                <label class="lab">Lunghezza km</label>
                                <input type="text" class="form-control" name="lunghezza"
                                    value="{{ old('lunghezza') . $attivita->lunghezza }}">

                                <label class="lab">Durata ore</label>
                                <input type="text" class="form-control" name="durata"
                                    value="{{ old('durata') . $attivita->durata }}">
                                <br>

                                <!-- Quota dislivello -->
                                <label class="lab">Dislivello</label>
                                <input type="text" class="form-control" name="dislivello"
                                    value="{{ old('dislivello') . $attivita->dislivello }}">

                                <!-- Difficolta -->
                                <label class="lab">Difficolta</label>
                                <select id="difficolta" name="difficolta" class="form-select"
                                    aria-label="difficolta">
                                    <option value="{{ $attivita->difficolta }}">
                                        {{ $tipodifficolta->firstWhere('id', $attivita->difficolta)->nome ?? '' }}
                                    </option>
                                    @foreach ($tipodifficolta as $difficolta)
                                        <option value="{{ $difficolta->id }}">
                                            {{ $difficolta->nome . ' ' . $difficolta->descrizione }}</option>
                                    @endforeach
                                </select>

                                <!-- Qualifica -->
                                <label class="lab">Qualifica</label>
                                <select id="qualifica" name="qualifica" class="form-select" aria-label="qualifica">
                                    <option value="{{ $attivita->qualifica }}">
                                        {{ $tipoqualifica->firstWhere('id', $attivita->qualifica)->nome ?? '' }}
                                    </option>
                                    @foreach ($tipoqualifica as $qualifica)
                                        <option value="{{ $qualifica->id }}">
                                            {{ $qualifica->nome . ' ' . $qualifica->descrizione }}</option>
                                    @endforeach
                                </select>


                                <!-- Specializzazione -->
                                <label class="lab">Specializzazione</label>
                                <select id="specializzazione" name="specializzazione" class="form-select"
                                    aria-label="specializzazione">
                                    <option value="{{ $attivita->specializzazione }}">
                                        {{ $tipospecializzazione->firstWhere('id', $attivita->specializzazione)->nome ?? '' }}
                                    </option>
                                    @foreach ($tipospecializzazione as $specializzazione)
                                        <option value="{{ $specializzazione->id }}">
                                            {{ $specializzazione->nome . ' ' . $specializzazione->descrizione }}
                                        </option>
                                    @endforeach
                                </select>

                                <!-- Quota minima -->
                                <label class="lab">Quota minima</label>
                                <input type="text" class="form-control" name="quotaminima"
                                    value="{{ old('quotaminima') . $attivita->quotaminima }}">

                                <!-- Quota massima-->
                                <label class="lab">Quota massima</label>
                                <input type="text" class="form-control" name="quotamassima"
                                    value="{{ old('quotamassima') . $attivita->quotamassima }}">

                                <!-- Ora ritrovo-->
                                <label class="lab">Ora ritrovo</label>
                                <input type="text" class="form-control" name="oraritrovo"
                                    value="{{ old('oraritrovo') . $attivita->oraritrovo }}">

                                <!-- luogo ritrovo-->
                                <label class="lab">Luogo ritrovo</label>
                                <input type="text" class="form-control" name="luogoritrovo"
                                    value="{{ old('luogoritrovo') . $attivita->luogoritrovo }}">

                                <!-- cicloescursione-->
                                @if ($attivita->tipo_attivita == 5)
                                    <!-- Portage-->
                                    <label class="lab">Portage</label>
                                    <input type="text" class="form-control" name="portage"
                                        value="{{ old('portage') . $attivita->portage }}">

                                    <!-- A spinta-->
                                    <label class="lab">A spinta</label>
                                    <input type="text" class="form-control" name="a_spinta"
                                        value="{{ old('a_spinta') . $attivita->a_spinta }}">
                                @endif

                                <!-- Max -->
                                <label class="lab">Numero max partecipanti</label>
                                <input type="text" class="form-control" name="numeromassimo"
                                    value="{{ old('numeromassimo') . $attivita->numeromassimo }}">

                                <!-- Max -->
                                <label class="lab">Numero minimo partecipanti</label>
                                <input type="text" class="form-control" name="numerominimo"
                                    value="{{ old('numerominimo') . $attivita->numerominimo }}">

                                <!-- Data inizio -->
                                <label class="lab">Attività Data inizio</label>
                                <input type="date" class="date form-control" name="data_inizio"
                                    value="{{ old('data_inizio') . $attivita->data_inizio }}" reqiured>

                                <!-- Data fine -->
                                <label class="lab">Attività Data fine</label>
                                <input type="date" class="date form-control" name="data_fine"
                                    value="{{ old('data_fine') . $attivita->data_fine }}" required>
                                <br>

                                <!-- Data iscrizioni inizio -->
                                <label class="lab">Data inizio iscrizioni</label>
                                <input type="date" class="date form-control" name="inizio_iscrizioni"
                                    value="{{ old('inizio_iscrizioni') . $attivita->inizio_iscrizioni }}">

                                <!-- Data iscrizioni fine -->
                                <label class="lab">Data fine iscrizioni</label>
                                <input type="date" class="date form-control" name="fine_iscrizioni"
                                    value="{{ old('fine_iscrizioni') . $attivita->fine_iscrizioni }}">

                                <!-------------- Email amministratore ------------------------->
                                <label class="lab">Email amministratore di questa attività</label><br>
                                @if ($user->is_admin == 1)
                                    <input type="text" class="form-control" name="user_email"
                                        value="{{ old('user_email') . $attivita->user_email }}">
                                @else
                                    <label>not auth</label><br>
                                @endif

                                <br>
                                <label class="lab">Volantino attuale</label>

                                <!-- volantino interno -->
                                <div id="interno_container">
                                    <div id="attuale_volantino">

                                        <br>
                                        <div class="frame">
                                            <iframe
                                                src="{{ url('/show-pdf' . '/' . $attivita->pdf_file . '/' . $attivita->id) }}"
                                                width="100%" height="600px">
                                                Il tuo browser non supporta gli iframe.
                                            </iframe>
                                        </div>

                                        <br><br>

                                        <!-- immagine -->
                                        <label class="lab">Seleziona Immagine</label><br><label>sostituisce immagine
                                            attuale
                                            .jpg o .png</label>
                                        <input class="form-control" type="file" name="image_file"
                                            onchange="previewImage(event)">
                                        <script>
                                            function previewImage(event) {
                                                var reader = new FileReader();
                                                reader.onload = function() {
                                                    var output = document.getElementById('preview');
                                                    output.src = reader.result;
                                                    document.getElementById('imagePreview').style.display = 'block';
                                                }
                                                reader.readAsDataURL(event.target.files[0]);
                                            }
                                        </script>

                                        {{ $attivita->image_file }}<br>
                                        <!-- immagine esistente -->
                                        <label class="lab">Immagine attuale</label><br>
                                        @if (isset($attivita->image_file) && $attivita->image_file != null)
                                            <img class="img_box"
                                                src="{{ asset("storage/imgtrek/{$attivita->image_file}") }}"
                                                alt="attivita cai bologna">
                                        @else
                                            {{ 'IMMAGINE MANCANTE' }}
                                        @endif
                                        <br><br>
                                        <!-- nuova immagine -->
                                        <div class="preprev">
                                            <label class="lab">Nuova Immagine max 2M</label>
                                            <div id="imagePreview" class="grid-item" style="display: none;">
                                                <img id="preview" class="imag"
                                                    src="{{ asset("public/{$attivita->image_file}") }}"
                                                    alt="Immagine escursione">
                                            </div>
                                        </div>
                                        <hr>
                                    </div>
                                    <!-- link al modulo google esteno -->
                                    <label class="lab" id="input2_label">Link al modulo
                                        esterno</label><br><label>Se scelto come tipo di iscrizione 'Modulo online
                                        personalizzato' Incollare il link ad un modulo Form google per
                                        iscrizione</label>
                                    <input type="text" class="form-control" name="link_modulo_esterno"
                                        value="{{ $attivita->link_modulo_esterno }}">


                                    <!-- Published -->
                                    <label class="lab">Stato</label><br>S
                                    <label>Nello stato 'Sospeso' l'attività non viene visualizzata</label>
                                    <select id="abilitato" name="published" class="form-select codice"
                                        aria-label="abilitato">
                                        <option value=1 {{ $attivita->published == 1 ? 'selected' : '' }}>Abilitato
                                        </option>
                                        <option value=0 {{ $attivita->published == 0 ? 'selected' : '' }}>Sospeso
                                        </option>
                                    </select>
                                    <br>

                                    <br>
                                    <button type="submit" class="btn btn-primary">Salva</button>

                                    <br><br>


                                    <a type="button" class="btn btn-danger btn-sm"
                                        href="{{ url('/attivita/destroy') . '/' . $attivita->id }}"
                                        onclick="return confirm('Sei sicuro? Attenzione.. ')">Cancella</a>
                                </div>
                        </form>
                    </div>
                    <div class="col-md-6">
                    </div>
                </div>
            </div>


            <!-- Bootstrap CSS
            <link href="https://stackpath.bootstrapcdn.com/bootstrap/5.1.3/css/bootstrap.min.css" rel="stylesheet">
            <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.1.3/js/bootstrap.bundle.min.js"></script>
       -->

</x-layout_cai>






<script type="text/javascript">
    $('.date').datepicker({
        format: 'dd-mm-yyyy'
    });
</script>
