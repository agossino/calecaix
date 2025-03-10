<!DOCTYPE html>
<html lang="en">

@php
    use Carbon\Carbon;
    use App\Models\Attivita;
@endphp

<!-- include libraries(jQuery, bootstrap) -->
<link href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css" rel="stylesheet">
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

<script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>

@php
    $attivita = $viewData['attivita'];
@endphp

<style>
    input {
        border-top: none;
        border-left: none;
        border-right: none;
        border-bottom: solid 1px #ccc;
    }

    label {
        color: blue;
        font-weight: 700;
    }
</style>

<div id="main">

    @if (session('message'))
        <div class="alert alert-success">
            {{ session('message') }}
        </div>
    @endif

    <div class="container">

        <x-menu-bar-home>
            <li>
                <a type="button" class="btn btn-primary btn-sm" href="{{ url('/listArticoli') }}">Lista
                    Testi
                </a>
            </li>
        </x-menu-bar-home>

        <form method="post" action="{{ url('/attivita/update_descrizione' . '/' . $attivita->id) }}"
            enctype="multipart/form-data">
            @csrf
            <div class="row justify-content-md-center">
                <div class="col col-lg-6">
                    <div>
                        <label class="labl">{{ $attivita->titolo }}</label>
                    </div>

                    <div>
                        <label>Testo</label>
                        <textarea id="summernote" name="descrizione">{{ $attivita->descrizione }}</textarea>
                        <textarea id="content" name="descrizione" class="tinymce-editor">{{ $attivita->descrizione }}</textarea>
                        <br>
                    </div>
                    <br>

                    <div class="tex">
                        <button type="submit" class="btn btn-primary">Salva</button><br>
                        <label>Chiudi poi 'salva' anche in fondo all'editor per aggiornare il programma</label><br>
                        <a type="button" class="btn btn-primary btn-sm"
                        href="{{ url("/attivita/edit") . "/" . $attivita->id ."/2"}}">Chiudi</a>
                    </div>

                </div>

            </div>
        </form>
        <br>

    </div>
</div>
<script>
    tinymce.init({
        selector: 'textarea.tinymce-editor', // Selettore per il tuo elemento textarea
        plugins: 'advlist autolink lists link image charmap print preview fullscreen media table code',
        toolbar: 'undo redo | formatselect | bold italic backcolor | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | removeformat | help',
        height: 300
    });
</script>
</html>
