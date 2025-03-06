<head>
</head>

@php

    use App\Models\TipoAttivita;
    use App\Models\TipoDifficolta;
    $tipo_attivita = TipoAttivita::where('published', 1)->orderBy('order', 'ASC')->get();
    $tipo_difficolta = TipoDifficolta::where('published', 1)->orderBy('order', 'ASC')->get();
    $attivita = session()->get('tipo_attivita');
    $iscrizione = session()->get('tipo_iscrizione');
    $volantino = session()->get('tipo_volantino');
@endphp


<style>
    .label {
        color: blue;
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

                </x-menu-bar-home>

                <form method="post" action="{{ url('/form/page9') }}">
                    @csrf
                    <div class="row justify-content-md-center ">
                        <div class="col col-lg-6">

                             
                                <label class="lab"> Iscrizione esterna</label><br>
                                <div class="form-check">
                                    <label class="labe" id="input2_label">Link al modulo esterno*</label>
                                    <input type="text" class="form-control" name="link_modulo_esterno"
                                        value="{{ old('link_modulo_esterno') }}" required>
                                </div>
                                <br><br>
                            

                            <a href="javascript:history.back()" class="btn btn-primary" role="button"
                                aria-pressed="true">Indietro</a>
                            <button type="submit" class="btn btn-primary">Avanti</button>

                        </div>
                    </div>
                </form>

            </div>
        </body>
    </div>

</x-layout_cai>
