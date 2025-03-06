<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Summernote Example</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

    <!-- include summernote css/js -->
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>
    <style>
        .note-editable {
            height: 300px;
            /* Altezza fissa */
            max-height: 500px;
            /* Altezza massima */
            overflow-y: auto;
            /* Aggiungi lo scroll verticale se necessario */
        }
    </style>
</head>
@php

    $attivita = session()->get('tipo_attivita');
        $iscrizione = session()->get('tipo_iscrizione');
        $tipo_volantino = session()->get('tipo_volantino');
@endphp


<style>
    .labe {
        color: blue;
        font-weight: 700;
    }

    .col-lg-6 {
        border: solid 1px #cccccc;
        padding: 15px;
        border-radius: 5px;
        box-shadow: 0px 0px 3px 3px rgb(203, 203, 206);
    }

    body {
        font-size: 16px;
    }
</style>


<div id="main">

    <body>
        <div class="container">
            <x-menu-bar-home>
                <li><a class="btn btn-success btn-sm" href="{{ url('/form/page1') }}">Ritorno all'inizio</a></li>
            </x-menu-bar-home>

            <form method="post" action="{{ url('/form/page8') }}">
                @csrf

                <div class="row justify-content-md-center ">
                    <div class="col col-lg-2">
                    </div>
                    <div class="col col-lg-6">


                        <!-- Autogenerato -->        
                            <div class="col col-lg-12">
                                <label>Descrivere l'attività aggiungendo eventuali informazioni (questo testo varra
                                    aggiunto al pdf programma autogenerato)</label>
                                <br> <label class="labe" for="descrizione">Descrizione attivita</label>
                                <textarea id="summernote" name="descrizione"></textarea>
                                <br>
                                <label class="lab">Note sottotitolo</label>
    
                                <div data-mdb-input-init class="form-outline">
                                    <label for="note">Note</label>
                                    <textarea class="form-control" id="note" name="note" rows="4"
                                        value="{{ old('note') }}"></textarea>
                                </div>
                                <br>
                            </div>

                        <div class="inpu">
                            <a href="javascript:history.back()" class="btn btn-primary" role="button"
                                aria-pressed="true">Indietro</a>
                            <button type="submit" class="btn btn-primary">Avanti</button>
                        </div>

                    </div>
                </div>
            </form>

        </div>
    </body>
</div>




<script type="text/javascript">
    $(document).ready(function() {
        $('#summernote').summernote({
            height: 300,
        });
    });
</script>