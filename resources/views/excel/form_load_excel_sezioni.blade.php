<style>
    .excel {
        margin-right: 10px;
    }
</style>

<div class="container-fluid" id="main">


    <x-layout_cai>

        <div id="main">

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
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

                    <form action="{{ url("/form_importexcel_sezioni_cai") }}" method="post" enctype="multipart/form-data">
                       
                        @csrf
                        <fieldset>
                            <label>Segliere il file excel da caricare <br> Il file deve essere sul proprio PC <br>Colonna 'A' numero progressivo<br>
                                Colonna 'B' Nomi delle Sezioni CAI</label><br><br>
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
                                    <button class="btn btn-primary square btn-sm cae" type="submit"><i class="ft-upload mr-1"></i> Carica</button>
                                </div>
                                
                            </div>
                        </fieldset>
                        
                    </form>

                </div>
            </body>
        </div>
    </x-layout_cai>
</div>


<br>
<br>
<br>
