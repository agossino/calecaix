<head>

    @php
        use Carbon\Carbon;
        use App\Models\TipoQualifica;
        use App\Models\TipoSpecializzazione;
       

        $qualifica = TipoQualifica::where('published', 1)->get();
        $specializzazione = TipoSpecializzazione::where('published', 1)->get();
   
        $volantino = session()->get('tipo_volantino');
        
    @endphp

</head>

<style>
    .lab {
        color: blue;
        font-weight: 700;
    }

    .labex {
        color: green;
        font-weight: 700;
        display: block;
         text-align: center;
    }

    .col {
        border: solid 1px #cccccc;
        padding: 15px;
        border-radius: 5px;
        box-shadow: 0px 0px 3px 3px rgb(203, 203, 206);
    }

    body {
        font-size: 16px;
    }
</style>

<x-layout_cai>
    <div id="main">

        <body>
            <div class="container-sm">
                <x-menu-bar-home>

                </x-menu-bar-home>

                <form method="post" action="{{ url('/form/page3') }}">
                    @csrf

                    <div class="row justify-content-md-center ">


                        <div class="col col-lg-6">


                            <label class="labex">Dati dell'Accompagnatore o organizzatore</label>
                            <br>
                            <div data-mdb-input-init class="form-outline">
                                <label class="lab" for="nome">Nome *</label>
                                <input type="text" class="form-control" id="nome" name="nome"
                                    value="{{ old('nome') }}" required>
                            </div>

                            <div data-mdb-input-init class="form-outline">
                                <label class="lab" for="cognome">Cognome *</label>
                                <input type="text" class="form-control" id="cognome" name="cognome"
                                    value="{{ old('cognome') }}" required>

                            </div>

                            <div data-mdb-input-init class="form-outline">
                                <label class="lab" for="email">Email *</label>
                                <input type="email" class="form-control" id="email" name="email"
                                    value="{{ old('email') }}" required>
                            </div>
<br>
                            
                                <div data-mdb-input-init class="form-outline">
                                    <label class="lab" for="telefono">Telefono (opzionale)</label>
                                    <input type="text" class="form-control" id="telefono" name="telefono"
                                        value="{{ old('telefono') }}">
                                </div>


                               
                            <br>
                            <div class="inpu">
                                <a href="javascript:history.back()" class="btn btn-primary" role="button"
                                    aria-pressed="true">Indietro</a> <button type="submit"
                                    class="btn btn-primary">Avanti</button>
                            </div>
                        </div>

                        <br>

                    </div>
            </div>
            </form>

    </div>
    </body>
    </div>
</x-layout_cai>
