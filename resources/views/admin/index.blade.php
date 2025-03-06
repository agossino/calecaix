<head>
    @php
        use App\Models\TipoUtente;
        $tipo_utente = TipoUtente::where("published", 1)->get();

        if (isset($viewData)) {
            $utenti = $viewData["utenti"];
        }

    @endphp

</head>

<x-layout_cai>
    <div id="main">
        <x-menu-bar>

        </x-menu-bar>
        @if (session("message"))
            <div class="alert alert-success">
                {{ session("message") }}
            </div>
        @endif

        <div class="container">
            <div class="row">
                <div class="col-md-6 co">

                    @if (isset($utenti))
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <!-- <th scope="col">Sel</th>-->
                                    <th scope="col">Nome</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Ruolo</th>

                                    <th>Abilitazione</th>
                                    <th>Cancella</th>

                                </tr>
                            </thead>
                            <tbody>

                                @foreach ($utenti as $utente)
                                    @if (isset($utente->is_admin) && $utente->is_admin !== 1)
                                        <tr>
                                            <!--<td><input type="checkbox" class="checkbox"></td>-->
                                            <td scope="row">
                                                {{ $utente->name }}
                                            </td>
                                            <td> {{ $utente->email }}</td>



                                            <td>
                                                <a class="btn btn-primary"
                                                    href="{{ url("admin/edit_role" . "/" . $utente->id) }}">{{ $utente->role }}</a>

                                            </td>

                                            <td>
                                                <a class="btn btn-secondary"
                                                    href="{{ url("/admin/disableUtente" . "/" . $utente->id) }}">
                                                    @if ($utente->published == 1)
                                                        {{ "Abilitato" }}
                                                    @else
                                                        {{ "Escluso" }}
                                                    @endif
                                                </a>
                                            </td>
                                            <td>
                                                <a class="btn btn-danger"
                                                    href="{{ url("/admin/destroyUtente" . "/" . $utente->id) }}"
                                                    onclick="return confirm('Sei sicuro? Attenzione.. ')">Cancella</a>
                                            </td>
                                        </tr>
                                    @endif
                                @endforeach
                            </tbody>
                        </table>
                        <br>
                    @else
                        <label> Utente non autorizzato</label>
                    @endif
                    </form>
                </div>


            </div>
        </div>
    </div>

</x-layout_cai>
