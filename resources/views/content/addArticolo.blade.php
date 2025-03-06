@php
    use Carbon\Carbon;
    $anno = Carbon::now()->format("Y");
    $message = "message layout-to-container";
@endphp


@php
    $contenuti = $viewData["contents"];
    $catid = $viewData["catids"];
    //dd($contenuti);
@endphp

    <!-- include libraries(jQuery, bootstrap) -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

    <!-- include summernote css/js -->
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>
<style>
    input {
        border-top: none;
        border-left: none;
        border-right: none;
        border-bottom: solid 1px #ccc;
    }

    label {
        color: blue;
        font-weight: 700;
    }
</style>



    <x-menu-bar-home>
        <li> <a type="button" class="btn btn-primary btn-sm" href="{{ url("/listArticoli") }}">Lista
                Articoli
            </a></li>
        <li><a class="btn btn-success btn-sm" href="{{ url("/content.addArticolo") }}">Aggiungi Testo</a>
        </li>
    </x-menu-bar-home>

    <div id="main">

        @php $da= 0;@endphp

        @if ($errors->any())
            <ul class="alert alert-danger list-unstyled">
                @foreach ($errors->all() as $error)
                    <li>- {{ $error }}</li>
                @endforeach
            </ul>
        @endif


        <div class="container">

            <form method="post" action="{{ url("/addEditor") }}" enctype="multipart/form-data">
                @csrf
                <div class="row justify-content-md-center">
                    <div class="col col-lg-4">

                        <label class="labe">Titolo</label>

                        <div class="inpu">
                            <input class="consegne_param" name="titolo" type="text"
                                value="{{ $contenuti->titolo }}" />
                        </div>




                        <!-- Categoria ---->
                        <label class="labe">Categoria</label>
                        <div>
                            <select id="categoria" name="catid" class="form-select" aria-label="categoria"
                                placeholder="Categoria">
                                @foreach ($catid as $cat)
                                    <option value="{{ $cat->categoria }}"> {{ $cat->nome }} </option>
                                @endforeach
                            </select>
                        </div>
                        <!--  <label class="labe">Alias</label>
                        <div class="inpu">
                            <input class="consegne_param" name="alias" type="text"
                                value="{{-- $contenuti->alias --}}" />
                        </div>-->


                        <label class="labe">Pubblicato</label>
                        <div class="inpu">
                            <select id="abilitato" name="published" class="form-select codice" aria-label="abilitato">
                                <option value=1 {{ $contenuti->published == 1 ? "selected" : "" }}>Abilitato</option>
                                <option value=0 {{ $contenuti->published == 0 }}>Sospeso</option>
                            </select>
                        </div>


                    </div>

                    <div class="col col-lg-6">
                        <label>Testo</label>

                        <textarea id="summernote" name="introtext"></textarea>

                        <br>
                        <div class="col">
                            <div class="inpu">
                                <button type="submit" class="btn btn-primary">Salva</button>
                            </div>
                        </div>
                    </div>
            </form>

        </div>

        <script type="text/javascript">
            $(document).ready(function() {
                $('#summernote').summernote({
                    height: 300,
                });
            });
        </script>


