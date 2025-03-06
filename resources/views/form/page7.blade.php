<!DOCTYPE html>
<html lang="en">

@php
   
    use App\Models\TipoAttivita;
    use App\Models\TipoDifficolta;

    $tipo_attivita = TipoAttivita::where('published', 1)->orderBy('order', 'ASC')->get();
    $tipo_difficolta = TipoDifficolta::where('published', 1)->orderBy('order', 'ASC')->get();
    $attivita = session()->get('tipo_attivita');
        $iscrizione = session()->get('tipo_iscrizione');
        $volantino = session()->get('tipo_volantino');
@endphp


<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PDF Preview</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.10.377/pdf.min.js"></script>
</head>

<style>
    #preview {
        width: 80%;
        height: 600px;
    }

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
</style>

 
<x-layout_cai>
    <div id="main">

        <body>
            <div class="container-sm">
                <x-menu-bar-home>
                    <li><a class="btn btn-success btn-sm" href="{{ url('/form/page1') }}">Ritorno all'inizio</a></li>
                </x-menu-bar-home>

                <form method="post" action="{{ url('/form/page7') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="row justify-content-md-center">
                        <div class="col col-lg-6">

                            @if ($volantino[0] == 0)
                                <label class="labe">Volantino programma viene caricato dal proprio PC in formato
                                    pdf</label>
                                <br><br>
                                <label class="lab" id="input1_label">Seleziona volantino programma</label>
                                <input type="file" class="form-control" name="pdf_file" onchange="previewFile(event)"
                                    required>
                                <div id="filePreview" class="grid-item">
                                    <canvas id="preview" class="imag"></canvas>
                                </div>
                                <br>
                            @endif

                            @if ($volantino[0] == 1 )
                                <label class="labe">Link al volantino caricato su server tipo: Drive, Dropbox
                                    ecc...</label>
                                <div data-mdb-input-init class="form-outline">
                                    <label for="link_volantino">Link *</label>
                                    <input type="text" class="form-control" id="link_volantino" name="link_volantino"
                                        value="{{ old('link_volantino') }}" required>
                            @endif

                            {{--<br>
                            <label class="lab">Note</label>
                            <div data-mdb-input-init class="form-outline">
                                <label for="note">Note</label>
                                <textarea class="form-control" id="note" name="note" rows="4"
                                    value="{{ old('note') }}"></textarea>
                            </div>
                            <br>--}}

                            <a href="javascript:history.back()" class="btn btn-primary" role="button"
                                aria-pressed="true">Indietro</a>
                            <button type="submit" class="btn btn-primary">Avanti</button>
                        </div>
                    </div>
                </form>
            </div>

            <script>
                function previewFile(event) {
                    const file = event.target.files[0];
                    if (file.type === 'application/pdf') {
                        const fileReader = new FileReader();
                        fileReader.onload = function() {
                            const typedarray = new Uint8Array(this.result);
                            pdfjsLib.getDocument(typedarray).promise.then(function(pdf) {
                                pdf.getPage(1).then(function(page) {
                                    const scale = 1.5;
                                    const viewport = page.getViewport({
                                        scale: scale
                                    });
                                    const canvas = document.getElementById('preview');
                                    const context = canvas.getContext('2d');
                                    canvas.height = viewport.height;
                                    canvas.width = viewport.width;

                                    const renderContext = {
                                        canvasContext: context,
                                        viewport: viewport
                                    };
                                    page.render(renderContext);
                                });
                            });
                        };
                        fileReader.readAsArrayBuffer(file);
                    } else {
                        alert('Please select a valid PDF file.');
                    }
                }
            </script>
        </body>
    </div>
</x-layout_cai>

</html>
