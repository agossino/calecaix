<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <!-- .. Other head code  -->

    <!-- Scripts -->

</head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">

<!-- CSRF Token -->
<meta name="csrf-token" content="{{ csrf_token() }}">

<title>Attivita ed Eventi CAI Bologna</title>

<!-- Fonts -->
<link rel="dns-prefetch" href="//fonts.bunny.net">
<link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
<!-- Scripts -->
<link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<style>
    .titolo {
        text-align: center;

    }

    .le li {
        display: inline-block;
        margin-right: 10px;
        /* Aggiunge uno spazio tra i due <li> */
    }

    .lele {
        margin-top: 10px;
    }

    ul.dropdown-menu.log {
        background: #fff !important;
        border: none !important;
    }

    a {
        text-decoration: none;

    }

    .lay {
        font-size: 16px;

    }

    .bsup {
        background-color: #eee;
        width: 100%
    }
</style>

@php
    $user = auth()->user();
@endphp

@if (auth()->check())
    @php
        //echo $user->role . '' . $user->admin;
    @endphp
@endif

<body class="lay">

    <div class="container-fluid">
        <div class="bsup">
            <div class="row">

                @if (auth()->check())
                    <div class="col-sm">
                        <!-- Left Side Of Navbar -->
                        <x-sidebar_collaps>
                        </x-sidebar_collaps>
                        <div class="apri">
                            <button class="openbtn" onclick="openNav()">☰ Menu Admin</button>
                        </div>
                    </div> 
                    @else

                    @endif

             

            </div>
        </div>
    </div>

</body>

</html>
