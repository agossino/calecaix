@php
    use Carbon\Carbon;
    use App\Models\User;
    use App\Models\TipoUtente;
@endphp

@php

    $utente = $viewData["utente"]; //tipo, escursione,categoria
    $tipo_utente = TipoUtente::all();

@endphp


<head>

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



    <x-cai_bar_semplice />

    <x-menu-bar-home>

    </x-menu-bar-home>
    <div class="container mt-5">

        <div class="row justify-content-md-center ">
            <div class="col col-lg-6">


                <form action="{{ url("/admin/utente_store") }}" method="POST">
                    @csrf

                    <div class="mb-3">

                        <input type="hidden" id="id" name="id" value={{ $utente->id }}>


                        <label class="lab">Nome</label>
                        {{ $utente->name }}<br>
                        <label class="lab">Email</label>
                        {{ $utente->email }}<br>
                        <label class="lab">Attivo</label>
                        {{ $utente->published }}<br><br>

                        <label class="lab">Autorizzazione</label>

                        <select id="categoria" name="role" class="form-select" aria-label="role">
                            <option>{{ $utente->role }}</option>
                            @foreach ($tipo_utente as $tute)
                                <option>{{ $tute->tipo_role }}</option>
                            @endforeach
                        </select>
                        <br>
                        <input type="hidden" class="form-control" name="published" value="{{ $utente->published }}">

                        <button type="submit" class="btn btn-primary">Aggiorna</button>
                </form>
            </div>

        </div>
    </div>



</x-layout_cai>
