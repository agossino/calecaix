<style>
    .testo {
        color: white;
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
   
        color:yellow;
    }

    .imab {
        width: 60px;
        height: 56px;
    }

    .container {
        display: flex;
        justify-content: center;
        align-items: center;
        justify-content: flex-start
    }

    .container img {
        height: 125px;
        margin-right: 20px;
    }

    .hde {
        background: darkblue;
        height: 125px
    }
    .barb{
        width:100%;
    }
  
    .colorecai{
        background:darkblue;
    }
</style>
</head>

<body class="font-sans antialiased dark:bg-black dark:text-white/50">
    <div class="bg-gray-50 text-black/50 dark:bg-black dark:text-white/50">

        <div class="container-fluid">
            <header class="hde">

                <div class="container barb">
                    <img src="{{ asset('img/logo_n.png') }}" alt="Immagine">
                    <p class="testo">CLUB ALPINO ITALIANO "Sezione Mario Fantin: Bologna</p>
                </div>

                @if (Route::has('login'))
                    <nav class="-mx-3 flex flex-1 justify-end">
                        <div class="lgin">
                            <a href="{{ route('login') }}"
                                class="testo rounded-md px-3 py-2 ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:hover:text-white/80 dark:focus-visible:ring-white">
                                Log in
                            </a>

                            @if (Route::has('register'))
                                <a href="{{ route('register') }}"
                                    class="testo rounded-md px-3 py-2 ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:hover:text-white/80 dark:focus-visible:ring-white">
                                    Register
                                </a>
                            @endif
                        </div>
                    </nav>

                @endif
            </header>
            
            </header>


        </div>
    </div>
</body>
