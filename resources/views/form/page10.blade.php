<head>
</head>


@php

 use App\Models\TipoIscrizione;

    $tipo_iscrizione = TipoIscrizione::where("published", 1)->get();
  

@endphp


<style>
    label {
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

                <form method="post" action="{{ url("/form/page10") }}">
                    @csrf
                    <div class="row justify-content-md-center ">
                        <div class="col col-lg-6">
                    
                            <br>
                            <a href="javascript:history.back()" class="btn btn-primary" role="button"
                            aria-pressed="true">Indietro</a>
                        <button type="submit" class="btn btn-primary">Salva</button>

                        </div>
                    </div>
                </form>

            </div>
        </body>
    </div>
</x-layout_cai>
