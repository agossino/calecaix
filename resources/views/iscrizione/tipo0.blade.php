@php
    use Carbon\Carbon;
    use App\Models\CaiSezioni;
    use App\Models\TipoAttivita;
    use App\Models\Attivita;
    use App\Models\TipoIscrizione;
    use App\Models\Iscrizione;
@endphp

@php
    $attivita = Attivita::where("published", 1)->get();
    $tipo_attivita = TipoAttivita::where("published", 1)->get();
    $tipo_iscrizione = TipoIscrizione::where("published", 1)->get();

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

    img#preview {
        width: 250px;
    }

    body {
        font-size: 16px;
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

        <div class="row justify-content-md-center ">
            <div class="col col-lg-6">
                <x-cai_bar_semplice />

                <x-menu-bar-home>
                    <li> <a class="btn btn-primary btn-sm" href="{{ url()->previous() }}">
                            <i class="fa fa-arrow-circle-o-left"></i>
                            <span>Indietro</span>
                        </a> </li>
                </x-menu-bar-home>


                <div class="tito">{{-- $evento->titolo --}}</div>



                <label> Telefono accompagnatore</label>

                <button type="submit" class="btn btn-primary">Chiudi</button>

            </div>
        </div>
    </div>
</x-layout_cai>
