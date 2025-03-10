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
        font-size: 18px;
        font-weight: 700;
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
    @if (session('message'))
        <div class="alert alert-success">
            {{ session('message') }}
        </div>
    @endif

    <div class="container-xl mco">
        <div class="row justify-content-center">
            <div class="grid-containerx">



                <div class="grid-item">
                    <a class="btn btn-sm" href="{{ url('/attivita/index/' . $dataOggi . '/0') }}">
                        <div class="tit-testo">Calendario Attivita Sezionale</div>
                        <label>Tutti i calendari annuali e parziali</label>
                        <img class="ima" src="img/calendario.jpeg" alt="Calendario escursioni cai Bologna" style="display: block; margin: 0 auto;">
                    </a>
                </div>
            


            <div class="grid-item">
                <a class="btn btn-sm" href="{{ url('/attivita/index/' . $dataOggi . '/1') }}">
                    <div class="tit-testo">Trekking</div>
                    <label>Escursionismo passeggiate ecc..</label>
                    <img class="ima" src="img/trekking-attivita.webp" alt="Trekking cai" style="display: block; margin: 0 auto;">
                </a>
            </div>

            <div class="grid-item">
                <a class="btn btn-sm" href="{{ url('/attivita/index/' . $dataOggi . '/2') }}">
                    <div class="tit-testo">Corsi</div>
                    <label>Corsi di tutti i tipi</label>
                    <img class="ima" src="img/corsi3.webp" alt="Corsi CAI Image" style="display: block; margin: 0 auto;">
                </a>
            </div>

            <div class="grid-item">
                <a class="btn btn-sm" href="{{ url('/attivita/index/' . $dataOggi . '/6') }}">
                    <div class="tit-testo">Alpinismo Giovanile</div>
                    <label>Riservato ai ragazzi</label>
                    <img class="ima" src="img/ag_logo.jpg" alt="Alpinismo giovanile" style="display: block; margin: 0 auto;">
                </a>
            </div>

            <div class="grid-item">
                <a class="btn btn-sm" href="{{ url('/attivita/index/' . $dataOggi . '/3') }}">
                    <div class="tit-testo">Grandi Trekking</div>
                    <label>Trekking di piu giorni nel mondo itinerante</label>
                    <img class="ima" src="img/gtrek3.png" alt="Grandi Trekking" style="display: block; margin: 0 auto;">
                </a>
            </div>

            <div class="grid-item">
                <a class="btn btn-sm" href="{{ url('/attivita/index/' . $dataOggi . '/9') }}">
                    <div class="tit-testo">Grandi Trekking Residenziali</div>
                    <label>Trekking nel mondo ma con unico soggiorno</label>
                    <img class="ima" src="img/gtrek4.png" alt="Grandi Trekking Residenziali" style="display: block; margin: 0 auto;">
                </a>
            </div>

            <div class="grid-item">
                <a class="btn btn-sm" href="{{ url('/attivita/index/' . $dataOggi . '/4') }}">
                    <div class="tit-testo">Sci Alpinismo</div>
                    <img class="ima" src="img/sci3.png" alt="Sci Alpinismo" style="display: block; margin: 0 auto;">
                </a>
            </div>

            <div class="grid-item">
                <a class="btn btn-sm" href="{{ url('/attivita/index/' . $dataOggi . '/8') }}">
                    <div class="tit-testo">Eventi sede CAI Bologna</div>
                    <label>Eventi vari in sede </label>
                    <img class="ima" src="img/eventi.png" alt="Grandi Trekking" style="display: block; margin: 0 auto;">
                </a>
            </div>


            {{-- <div class="grid-item">
                    <li> <a class="btn  btn-sm" href="{{ url("/mercatino.index") }}">
                        <div class="tit-testo">MMERCATINO CAIBO</div><img class="ima" src="img/submarine.png"
                        alt="Mercatino cai bo"></a></li>
                </div> --}}

        </div>
    </div>
    </div>
</body>


<script>
    function aggiungiData() {
        var dataOggi = document.getElementById('dataOggi').value;

    }
</script>
