<head>
</head>

<style>
    label {
        color: blue;
        font-weight: 700;
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


                @if (session()->has("message"))
                    <div class="alert alert-success">
                        {{ session()->get("message") }}
                    </div>
                @endif

                <form method="get" action="{{ url("/") }}">
                    @csrf
                    <div class="row justify-content-md-center ">
                        <div class="col col-lg-6">

                            <div class="inpu">
                                <button type="submit" class="btn btn-primary">Chiudi</button>
                            </div>

                        </div>
                    </div>
                </form>

            </div>
        </body>
    </div>
</x-layout_cai>
