<style>
    .excel {
        margin-right: 10px;
    }
</style>

<div class="container-fluid" id="main">



    <x-layout_cai>
        <div id="main">

            @if (session("success"))
                <div class="alert alert-success">
                    {{ session("success") }}
                </div>
            @endif

            <body>
                <div class="container-sm">
                    <x-cai_bar_semplice />
                    <x-menu-bar-home>
                        <li> <a class="btn btn-primary btn-sm" href="{{ url()->previous() }}">
                                <i class="fa fa-arrow-circle-o-left"></i>
                                <span>Indietro</span>
                            </a> </li>
                    </x-menu-bar-home>

                    <form action="{{ url("/import_excel") }}" method="post" enctype="multipart/form-data">

                        @csrf
                        <fieldset>
                            <label>Segliere il file excel da caricare <br> Il file deve essere sul proprio PC <small
                                    class="warning text-muted">{{ __("Caricare solo Excel (.xlsx or .xls) files") }}</small></label>
                            <div class="minput-group">
                                <input type="file" required class="form-control" name="uploaded_file"
                                    id="uploaded_file">
                                @if ($errors->has("uploaded_file"))
                                    <p class="text-right mb-0">
                                        <small class="danger text-muted"
                                            id="file-error">{{ $errors->first("uploaded_file") }}</small>
                                    </p>
                                @endif
                                <br>
                                <div class="input-group-append" id="button-addon2">
                                    <button class="btn btn-primary square btn-sm cae" type="submit"><i
                                            class="ft-upload mr-1"></i> Carica</button>
                                </div>

                            </div>
                        </fieldset>
                        <label>Numeri di riga del file excel da caricare inizio,fine es. 10,15</label>
                        <input type="text" name="ids" placeholder=""><br>
                        <label>Vengono caricate le righe di excel che non esistono come titolo gia nel database<br>
                            in seguito è possibile come amministatori modificare i dati <br>
                             alle celle con data non corretta (d/m/yy) verra assegnata la data '01-01-2000'<br>
                            quindi per visualizzare questi eventi è necessario cambire la <b> Da data Inizio</b> in '01-01-2000' e clic su Vedi tutti</label>

                    </form>

                </div>
            </body>
        </div>
    </x-layout_cai>
</div>


<br>
<br>
<br>
