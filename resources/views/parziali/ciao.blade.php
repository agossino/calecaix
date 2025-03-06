<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--
     utilizzare queste versioni per il corretto funzionamento del popup
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</head>
-->

    @php
        use App\Models\Content;
        $ciao_leggi = Content::where("titolo", "=", "ciao_leggi")->first();
    @endphp

    <style>
        .grid-item {
            height: auto;
            text-align: left;
        }
    </style>

    <!-- The Modal -->
    <div class="modal" id="myModal">

        <div class="modal-dialog">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Contatti</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <!-- Modal body -->
                <div class="modal-body">

                    <div class="grid-item">
                        @if (isset($ciao_leggi->introtext))
                            {!! $ciao_leggi->introtext !!}
                        @endif

                    </div>

                    <!-- Modal footer -->
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Chiudi</button>
                    </div>

                </div>
            </div>
        </div>
