<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Menu Responsive con Data del Giorno</title>
<div class="menu" id="menu"></div>
<style>
    body {
        font-family: Arial, sans-serif;
        margin: 0;
        padding: 0;
    }

    .menu {
        display: flex;
        flex-wrap: wrap;
        justify-content: center;
        padding: 10px;
        /* background-color: #333;*/
    }

    .menu-item {
        color: rgb(11, 26, 109);
        margin: 5px;
        padding: 5px 10px;
        text-decoration: none;
        cursor: pointer;
    }

    .menu-item:hover {
        color: #ffcc00;
        /* Colore durante l'hover */
    }

    .menu-item.active {
        color: #ffcc00;
        /* Colore quando il link è attivo */
    }

    li {
        float: left;
        margin-left: 20px;
        list-style-type: none;
    }

    .menu-bar {
        margin-top: 5px;
        margin-bottom: 6px;
        padding: 3px;
        border: solid 1px #ccc;
        border-radius: 3px;

    }

    .dada {
        font-weight: 700;
        color: green;

    }

    .btrova {
        margin-left: 10px;
    }

    li.homeattivita {
        margin-top: 5px;
    }

    .aggiungi {
        margin-top: 5px;
    }

    .lista {
        margin-top: 5px;
    }
</style>

@php
    use Carbon\Carbon;
    $user = auth()->user();
    $dataOggius = Carbon::now()->toDateString(); // Ottiene la data di oggi nel formato 'YYYY-MM-DD'
    $dataOggi = Carbon::createFromFormat('Y-m-d', $dataOggius)->format('d-m-Y');
@endphp
