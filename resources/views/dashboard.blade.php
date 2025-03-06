@php
    use Carbon\Carbon;

    $user = auth()->user();
    $dataOggius = Carbon::now()->toDateString(); // Ottiene la data di oggi nel formato 'YYYY-MM-DD'
    $dataOggi = Carbon::createFromFormat("Y-m-d", $dataOggius)->format("d-m-Y");

    $message = "message layout-to-container";
@endphp

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Benvenuto</title>
    @vite(["resources/css/app.css", "resources/js/app.js"])
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>

</head>

<style>
    .lgin a {

        padding: 20px;
    }

    .container {
        display: flex;
        justify-content: center;
        align-items: center;

        justify-content: flex-start
    }

    .container img {
        height: 100px;
        margin-right: 10px;
    }

    .part {
        border: solid;
        box-align: center;
        background: yellow;
    }

    .menu-bar {

        border: none !important;

    }

    #mySidebar {
        margin-top: 10px !important;
        margin-left: 12px;
    }
</style>

@if (session("success"))
<div class="alert alert-success">
    {{ session("success") }}
</div>
@endif
<div class="container-fluid">

    <div id="maih3">

        <x-app-layout>
            <div class="text-center">
                <br><br>
                <h1>{{ "Benvenuto " . $user->name . ' ('.$user->role.')'}}</h1>
            </div>
       {{--<x-menu-bar-home>
            </x-menu-bar-home> --}}
            <li class="l"><a class="btn btn-primary btn-sm" href="{{ url('/') }}">Inizio</a></li>
        </x-app-layout>
        
    </div>
    <br>


    <x-slot name="header">
        Accesso come : {{ $user->role }}
    </x-slot>



</div>

<x-footer />

