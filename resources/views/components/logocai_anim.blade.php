


<style>
    .testo {
        color: white;

        margin-left: 150px;
        margin-top: 40px;
    }

    .lgin a {

        padding: 20px;
    }

    .lgin {
        float: right;
        margin-right: 100px;
        padding: 20px;
        margin-top: -50px;
    }

    .lgin a:hover {

        color: yellow;
    }

    .imab {
        width: 60px;
        height: 56px;
    }

    .container_logo {
        display: flex;
        justify-content: center;
        align-items: center;
        justify-content: flex-start
    }

    .container_logo img {
        height: 65px;
        left: 30px;
        top: 48px;
        position: absolute;
    }

    .hde {
        background: darkblue;
        height: 125px
    }

    .barb {
        width: 100%;
    }

    .colorecai {
        background: darkblue;
    }

    .log_in {
        margin-top: 30px;
    }
</style>

</head>
<img id="myImage" src="{{ asset("img/Aquila2.png") }}" style="position: absolute; top: -110px; left: 25px;width:140px;">


<div class="container-fluid">
    <header class="hde">

        <div class="container_logo barb">
            <img src="{{ asset("img/Scudo2.png") }}" alt="Immagine">
            <p class="testo">CLUB ALPINO ITALIANO "Sezione Mario Fantin: Bologna</p>
        </div>
    <div class="log_in">
        @if (Route::has("login"))
        <nav class="-mx-3 flex flex-1 justify-end">
            <div class="lgin">
            @auth
                <a href="{{ route('logout') }}"
                onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                class="testo rounded-md px-3 py-2 ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:hover:text-white/80 dark:focus-visible:ring-white">
                Log out
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
                </form>
            @else
                <a href="{{ route("login") }}"
                class="testo rounded-md px-3 py-2 ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:hover:text-white/80 dark:focus-visible:ring-white">
                Log in (amministratori)
                </a>

                @if (Route::has("register"))
                <!-- Registrazione esclusa -->
                {{--a href="{{ route("register") }}"
                    class="testo rounded-md px-3 py-2 ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:hover:text-white/80 dark:focus-visible:ring-white">
                    Registrazione
                </a>--}}

                @endif
            @endauth
            </div>
        </nav>
        @endif
    </div>   </header>

    </header>


</div>
