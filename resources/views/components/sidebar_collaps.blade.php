<!DOCTYPE html>
<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">-->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

        <style>
            .dropdown-submenu {
                position: relative;
            }


            ul.dropdown-menu {
                background-color: #06552e;
            }

            .test2 {
                margin-left: -15px;
            }
        </style>

        <style>
            body {
                font-family: "Lato", sans-serif;
            }

            .sidebar {
                height: 100%;
                width: 0;
                position: fixed;
                z-index: 1;
                top: 0;
                left: 0;
                background-color: #06552e;
                overflow-x: hidden;
                transition: 0.5s;
                margin-top: 65px;
            }

            .sidebar a {
                padding: 8px 8px 8px 32px;
                text-decoration: none;
                color: #ffffff;
                display: block;
                transition: 0.3s;
            }

            .sidebar a:hover {
                color: #e1e432;
            }

            .sidebar .closebtn {
                position: absolute;
                top: 0;
                right: 25px;
                font-size: 36px;
                margin-left: 50px;
            }

            .openbtn {
                font-size: 18px;
                cursor: pointer;
                background-color: #636060;
                color: white;
                padding: 10px 15px;
                border: none;
            }

            .openbtn:hover {
                background-color: #444;
            }

            #main {
                transition: margin-left .5s;
                padding: 16px;
            }

            .apri {
                margin: 5px;
            }

            .chiudi {
                font-size: 16px;
                color: yellow;
                font-weight: 700;
            }

            a.dropdown-item {
                margin-left: -4px;
            }

            li {
                list-style-type: none;
            }

            /* On smaller screens, where height is less than 450px, change the style of the sidenav (less padding and a smaller font size) */
            @media screen and (max-height: 450px) {
                .sidebar {
                    padding-top: 15px;
                }

                .sidebar a {
                    font-size: 18px;
                }
            }

            .evetrek {
                font-size: 20px;

            }

            #mySidebar {
                margin-top: 122px;
                margin-left: 12px;
            }
        </style>

        @php

            $user = auth()->user();

            use Carbon\Carbon;
            $message = "message layout-to-container";
            $dataOggius = Carbon::now()->toDateString(); // Ottiene la data di oggi nel formato 'YYYY-MM-DD'
            $dataOggi = Carbon::createFromFormat("Y-m-d", $dataOggius)->format("d-m-Y");
        @endphp

        <div id="mySidebar" class="sidebar">
            <a href="javascript:void(0)" class="closebtn" onclick="closeNav()"><span class="chiudi">Chiudi</span></a>
            <br>
            <br>
            <div class="dropdown">
                <a class="nav-link dropdown-toggle evetrek" href="#" id="navbarDarkDropdownMenuLink"
                    role="button" data-bs-toggle="dropdown" aria-expanded="false">Attività </a>

                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                    <li><a class="dropdown-item" href="{{ url("/form/page1") }}">Aggiungi attività</a>
                    </li>

                    <li><a class="dropdown-item" href="{{ url("/eventi.list") }}">Lista edit attività</a>
                    </li>

                    @if (isset($user) && $user->is_admin == 1)
                        <li><a class="dropdown-item" href="{{ url("/admin/index") }}">Autorizzazioni<br>amministratori </a>
                        </li>
                    @endif

                    <li><a class="dropdown-item" href="{{ url("/listArticoli") }}">Testi privacy consenso ecc..</a>
                    </li>

                    <!-- attivita da Claudio Marchesi su google -->
                   {{--<li><a class="dropdown-item" href="{{ url("/form_excel") }}">Carica attività da excel</a>
                    </li>--}}

                    <li><a class="dropdown-item" href="{{ url("/get_from_dbcai") }}">Carica attività<br>caibo.it da data di oggi</a>
                    </li>

                   <li><a class="dropdown-item" href="{{ url("/form_import_sezioni") }}">Carica Sezioni<br>CAI da excel</a>
                    </li>


                </ul>
            </div>

            <div class="dropdown">
                <a class="nav-link dropdown-toggle evetrek" href="#" id="navbarDarkDropdownMenuLink"
                    role="button" data-bs-toggle="dropdown" aria-expanded="false">Mercatino </a>

                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                    <li><a class="dropdown-item" href="{{ url("/form/page1m") }}">Aggiungi oggetto<br>(in costruzione)</a>
                    </li>

                </ul>
            </div>
        </div>
    </head>

<body>
    <script>
        $(document).ready(function() {
            $('.dropdown-submenu a.test').on("click", function(e) {
                $(this).next('ul').toggle();
                e.stopPropagation();
                e.preventDefault();
            });
        });
    </script>


    <script>
        function openNav() {
            document.getElementById("mySidebar").style.width = "250px";
            document.getElementById("main").style.marginLeft = "250px";

        }

        function closeNav() {
            document.getElementById("mySidebar").style.width = "0";
            document.getElementById("main").style.marginLeft = "0";
        }
    </script>

</body>

</html>
