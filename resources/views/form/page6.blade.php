<head>

    @php

        use App\Models\TipoAttivita;
        use App\Models\TipoDifficolta;

        $tipo_attivita = TipoAttivita::where('published', 1)->orderBy('order', 'ASC')->get();
          $tipo_difficolta = TipoDifficolta::where('published', 1)->orderBy('order', 'ASC')->get();
        $attivita = session()->get('tipo_attivita');
        $iscrizione = session()->get('tipo_iscrizione');
        $volantino = session()->get('tipo_volantino');
    @endphp

</head>

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

    body {
        font-size: 16px;
    }

    #preview1 {
        width: 250px;
        margin-top: 5px;
    }
</style>



<x-layout_cai>

    <div id="main">

        <body>
            <div class="container-sm">
                <x-menu-bar-home>
                    <li><a class="btn btn-success btn-sm" href="{{ url('/form/page1') }}">Ritorno all'inizio</a></li>
                </x-menu-bar-home>

                <form method="post" action="{{ url('/form/page6') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="row justify-content-md-center ">
                        <div class="col col-lg-6">
                            <label class="labe">Immagine del programma (questa immagine verrà visualizzata sull'elenco
                                delle attività nel sito caibo.it)</label>
                            <!------------------------------------ Immagine ---------------------------------->
                            <br><br>
                            <label class="lab">Seleziona Immagine *</label>
                            <input class="form-control" type="file" class="form-control" name="image_file"
                                onchange="previewImage1(event)" required>

                            <div class="preprev1">
                                <div id="imagePreview1" class="grid-item" style="display: none;">
                                    <img id="preview1" class="imag" alt="Immagine escursione">
                                </div>
                            </div>


                            <br>
                            <a href="javascript:history.back()" class="btn btn-primary" role="button"
                                aria-pressed="true">Indietro</a> <button type="submit"
                                class="btn btn-primary">Avanti</button>
                        </div>
                    </div>
                </form>
            </div>
        </body>
    </div>

</x-layout_cai>

<script>
    function previewImage1(event) {
        var input = event.target;
        var reader = new FileReader();
        reader.onload = function() {
            var imgElement = document.getElementById('preview1');
            imgElement.src = reader.result;
            document.getElementById('imagePreview1').style.display = 'block';
        }
        reader.readAsDataURL(input.files[0]);
    }
</script>




<!----->
<script src="https://mozilla.github.io/pdf.js/build/pdf.js"></script>
