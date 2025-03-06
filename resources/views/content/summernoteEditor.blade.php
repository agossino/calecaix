<!DOCTYPE html>
<html lang="en">

@php
    use Carbon\Carbon;
    $anno = Carbon::now()->format("Y");
    $message = "message layout-to-container";
@endphp


    <!-- include libraries(jQuery, bootstrap) -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

    <!-- include summernote css/js -->
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>



    @php
        $contenuti = $viewData["contents"];
        $viewData["error"];
        $catid = $viewData["catids"];
        //dd($contenuti);
    @endphp


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

           <x-menu-bar-home>
            <li>
                <a type="button" class="btn btn-primary btn-sm" href="{{ url("/listArticoli") }}">Lista
                    Testi
                </a>
            </li>
            <li><a class="btn btn-success btn-sm" href="{{ url("/content.addArticolo") }}">Aggiungi Testo</a>
            </li>
        </x-menu-bar-home>

            <form method="post" action="{{ url("/storeEditor".'/'.$contenuti->id) }}" enctype="multipart/form-data">
                @csrf
                <div class="row justify-content-md-center">
                    <div class="col col-lg-4">

                        <div>
                            <label class="labl">Titolo</label>

                                <div class="tex">
                                    <input class="consegne_param" name="titolo" type="text"
                                        value="{{ $contenuti->titolo }}" />
                                </div>

                        </div>
                        <br>
                        <div>
                            <label class="labl">Categoria</label>
                            @if (isset($contenuti->catid))
                                <div class="tex">
                                    <input class="categoria" name="catid" type="text"
                                        value="{{ $catid[$contenuti->catid]->nome }}" />
                                </div>
                            @endif
                        </div>
                        <br>
                        <div>
                            <label class="labl">Alias</label>
                            @if (isset($contenuti->alias))
                                <div class="tex">
                                    <input class="consegne_param" name="alias" type="text"
                                        value="{{ $contenuti->alias }}" />
                                </div>
                            @endif
                        </div>
                        <br>
                        <div>
                            <label class="labl">Pubblicato</label>
                            @if (isset($contenuti->published))
                                <div class="tex">
                                    <input class="consegne_param" name="published" type="text"
                                        value="{{ $contenuti->published }}" />
                                </div>
                            @endif
                        </div>
                        <br>
                        <div>
                            <label class="labl">ID</label>
                            @if (isset($contenuti->id))
                                <div class="tex">
                                    <input class="consegne_param" name="published" type="text"
                                        value="{{ $contenuti->id }}" disabled/>
                                </div>
                            @endif
                        </div>
                        <br>
                    </div>

                    <div class="col col-lg-6">

                        <div>
                            <label>Testo</label>
                            @if (isset($contenuti->introtext))
                                <textarea id="summernote" name="introtext">{{ $contenuti->introtext }}</textarea>
                            @endif
                            <br>
                        </div>
                        <br>


                        <div class="tex">
                            <button type="submit" class="btn btn-primary">Salva</button>
                        </div>

                    </div>

                </div>
            </form>
            <br>
      
        </div>
    </div>
    <script type="text/javascript">
        $(document).ready(function() {
            $('#summernote').summernote({
                height: 300,
            });
        });
    </script>


</html>
