<style>
    .grid-containerx {
        display: grid;
        grid-template-rows: repeat(4, 1fr);
        grid-template-columns: repeat(4, 1fr);
        gap: 10px;
    }

    .grid-item {
        background-color: #f2f2f2;
        border: 1px solid #ccc;
        padding: 20px;
        text-align: center;
        height: 250px;
        display: flex;
        /* Layout flessibile */
        flex-direction: column;
        /* Disporre in colonna */
        justify-content: center;
        /* Centra verticalmente */
        align-items: center;
        /* Centra orizzontalmente */
    }

    .grid-item img {
        width: 150px;
        height: auto;
        margin: 10px 0;
        /* Margine per separare l'immagine dal testo */
    }

    .mco {
        margin-top: 10px;
    }

    .tit-testo {
        text-align: center;
        color: blue;
    }

    /* Responsive Styles */
    @media (max-width: 1200px) {
        .grid-containerx {
            grid-template-columns: repeat(3, 1fr);
        }
    }

    @media (max-width: 900px) {
        .grid-containerx {
            grid-template-columns: repeat(2, 1fr);
        }
    }

    @media (max-width: 600px) {
        .grid-containerx {
            grid-template-columns: 1fr;
        }

        .testo {
            margin-top: 1px;
        }
    }
</style>

<body>
    @php
        if (auth()->check()) {
            $aut = 1;
        } else {
            $aut = 0;
        }
        $user = auth()->user();
    @endphp
    @if (session("message"))
        <div class="alert alert-success">
            {{ session("message") }}
        </div>
    @endif

    <div class="container-xl mco">
        <div class="row justify-content-center">
            <div class="grid-containerx">
               
                    <div class="grid-item"><a class="btn  btn-sm" href="{{ url("/eventi.index/0/" . $dataOggi) }}">
                        <div class="tit-testo">Escursionismo</div><img class="ima" src="img/calendario.jpeg"
                            alt="Calendario escursioni cai Bologna">
                    </a></div>


                <div class="grid-item">
                    <li> <a class="btn  btn-sm" href="{{ url("/eventi.index/1/" . $dataOggi) }}">
                        <div class="tit-testo">Sci</div><img class="ima"
                                src="img/trekking-attivita.webp" alt="Trekking cai"></a></li>
                </div>

                <div class="grid-item">
                    <li> <a class="btn  btn-sm" href="{{ url("/eventi.index/2/" . $dataOggi) }}">
                        <div class="tit-testo">Varie</div><img class="ima" src="img/corsi3.webp" alt="Corsi CAI Image"></a></li>
                </div>


           


                <div class="grid-item">
                    <li> <a class="btn  btn-sm" href="{{ url("/eventi.index/3/" . $dataOggi) }}">
                        <div class="tit-testo">Alpinismo Giovanile</div><img class="ima" src="img/ag_logo.jpg"
                        alt="Alpinismo giovanile"></a></li>
                </div>

        
                <div class="grid-item">
                    <li> <a class="btn  btn-sm" href="{{ url("/eventi.index/4/" . $dataOggi) }}">
                        <div class="tit-testo">Grandi Trekking</div><img class="ima" src="img/gtrek3.png"
                        alt="Grandi Trekking"></a></li>
                </div>

           
                <div class="grid-item">
                    <li> <a class="btn  btn-sm" href="{{ url("/eventi.index/5/" . $dataOggi) }}">
                        <div class="tit-testo">Grandi Trekking Residenziali</div><img class="ima"
                        src="img/gtrek4.png" alt="Grandi Trekking Residenziali"></a></li>
                </div>

                <div class="grid-item">
                    <li> <a class="btn  btn-sm" href="{{ url("/eventi.index/6/" . $dataOggi) }}">
                        <div class="tit-testo">Trekking col Treno</div><img class="ima" src="img/trt.jpg"
                        alt="Trekking col Treno"></a></li>
                </div>

                <div class="grid-item">
                    <li> <a class="btn  btn-sm" href="{{ url("/eventi.index/7/" . $dataOggi) }}">
                        <div class="tit-testo">Sci Alpinismo</div><img class="ima" src="img/sci3.png"
                        alt="Sci Alpinismo"></a></li>
                </div>
            
                <div class="grid-item">
                    <li> <a class="btn  btn-sm" href="{{ url("/eventi.index/9/" . $dataOggi) }}">
                        <div class="tit-testo">Eventi</div><img class="ima" src="img/eventi.png" alt="Eventi cai"></a></li>
                </div>
                
                <div class="grid-item">
                    <li> <a class="btn  btn-sm" href="{{ url("/mercatino.mercatino-welcome") }}">
                        <div class="tit-testo">MMERCATINO CAIBO</div><img class="ima" src="img/submarine.png"
                        alt="Mercatino cai bo"></a></li>
                </div>

            </div>
        </div>
    </div>
</body>



