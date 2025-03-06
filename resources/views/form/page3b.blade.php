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

                <form method="post" action="{{ url('/form/page3b') }}">
                    @csrf

                    <div class="row justify-content-md-center ">


                        <div class="col col-lg-6">

                                <br>
                                <!---------------- QUALIFICA ------------------->
                                <div class="form-group"> <label class="lab">Qualifica</label>
                                    @foreach ($qualifica as $qual)
                                        <div class="form-check"> 
                                            <input class="form-check-input" type="radio"
                                                name="qualifica[]" value="{{ $qual->tipo_qualifica }}"
                                                id="qualifica_{{ $qual->id }}"> <label class="form-check-label"
                                                for="qualifica_{{ $qual->id }}">{{ $qual->descrizione }}</label>
                                        </div>
                                        @endforeach @if ($errors->has('qualifica'))
                                            <div class="alert alert-danger"> {{ $errors->first('qualifica') }} </div>
                                        @endif
                                </div>
                                <br>


                                <!---------------- SPECIALIZZAZIONE ------------------->
                                <div class="form-group">
                                    <label class="lab">Specializzazione</label>
                                    @foreach ($specializzazione as $qual)
                                        <div class="form-check"> <input class="form-check-input" type="radio"
                                                name="specializzazione[]" value="{{ $qual->tipo_specializzazione }}"
                                                id="specializzazione{{ $qual->id }}"> <label
                                                class="form-check-label"
                                                for="specializzazione{{ $qual->id }}">{{ $qual->descrizione }}</label>
                                        </div>
                                        @endforeach @if ($errors->has('specializzazione'))
                                            <div class="alert alert-danger"> {{ $errors->first('specializzazione') }}
                                            </div>
                                        @endif
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
