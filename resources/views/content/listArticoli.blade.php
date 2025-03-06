<!DOCTYPE html>
<html lang="it">

<head>
    @php
        use Carbon\Carbon;
        $message = "message layout-to-container";
        $dataOggius = Carbon::now()->toDateString(); // Ottiene la data di oggi nel formato 'YYYY-MM-DD'
        $dataOggi = Carbon::createFromFormat("Y-m-d", $dataOggius)->format("d-m-Y");
    @endphp

    @php
        $message = "message layout-to-container";
    @endphp



    @php
        $contenuti = $viewData["contents"];
        $catid = $viewData["catids"];
    @endphp

    <style>

    </style>



    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.0/css/bootstrap.min.css" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.5.0/css/bootstrap-datepicker.css"
        rel="stylesheet">
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.5.0/js/bootstrap-datepicker.js"></script>


    <!-- utilizzare queste versioni per il corretto funzionamento del popup -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</head>



<body>

    <div id="main">
        <div class="container-fluid">
            <!--<div class="row justify-content-center">-->
            <!-- Barra con logo semplice-->
            <x-cai_bar_semplice />

            @if (session("message"))
                <div class="alert alert-success">
                    {{ session("message") }}
                </div>
            @endif

            <br>

            <x-menu-bar-home>
                <li><a class="btn btn-success btn-sm" href="{{ url("/content.addArticolo") }}">Aggiungi Testo</a>
                </li>
            </x-menu-bar-home>
            <hr>


            <div class="table-responsive-xxl">
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <!-- <th scope="col">Sel</th>-->
                            <th scope="col">Edit</th>
                            <th scope="col">Nome</th>
                            <th scope="col">Categoria</th>
                            <th>Disabilita</th>
                            <th>Cancella</th>

                        </tr>
                    </thead>
                    <tbody>

                        @foreach ($contenuti as $contenuto)
                            <tr>
                                <!--<td><input type="checkbox" class="checkbox"></td>-->

                                <td scope="row"><a class="btn btn-primary bt-sm"
                                        href="{{ url("/showEditor") . "/" . $contenuto->id }}">{{ $contenuto->id }}</a>
                                </td>
                                <td>{{ $contenuto->titolo }}--{{ $contenuto->alias }}</td>
                                
                                <td>{{ $catid[$contenuto->catid]->nome }}</td>


                                <td>

                                    @if ($contenuto->published == 1)
                                        <a class="btn btn-success"
                                            href="{{ url("/disableArticolo" . "/" . $contenuto->id) }}">Disabilita</a>
                                    @else
                                        <a class="btn btn-warning"
                                            href="{{ url("/disableArticolo" . "/" . $contenuto->id) }}">Abilita</a>
                                    @endif

                                </td>
                                <td>
                                    <a class="btn btn-danger"
                                        href="{{ url("/destroyArticolo" . "/" . $contenuto->id) }}"
                                        onclick="return confirm('Sei sicuro? Attenzione.. ')">Cancella</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <br>

            </div>

        </div>
    </div>
    {{-- @include('popup_a') --}}



</body>

</html>
