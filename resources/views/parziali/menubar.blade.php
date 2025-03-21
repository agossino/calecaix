<!-- resources/views/menu-bar.blade.php -->
@php

    use App\Models\TipoAttivita;

    $tipo_attivita = TipoAttivita::where('published', 1)->get();

    // Aggiungi i mesi e le loro date di inizio mese
    $monthsData = [
        ['id' => 1, 'month' => 'Gennaio', 'start_date' => '01-01-2025'],
        ['id' => 2, 'month' => 'Febbraio', 'start_date' => '01-02-2025'],
        ['id' => 3, 'month' => 'Marzo', 'start_date' => '01-03-2025'],
        ['id' => 4, 'month' => 'Aprile', 'start_date' => '01-04-2025'],
        ['id' => 5, 'month' => 'Maggio', 'start_date' => '01-05-2025'],
        ['id' => 6, 'month' => 'Giugno', 'start_date' => '01-06-2025'],
        ['id' => 7, 'month' => 'Luglio', 'start_date' => '01-07-2025'],
        ['id' => 8, 'month' => 'Agosto', 'start_date' => '01-08-2025'],
        ['id' => 9, 'month' => 'Settembre', 'start_date' => '01-09-2025'],
        ['id' => 10, 'month' => 'Ottobre', 'start_date' => '01-10-2025'],
        ['id' => 11, 'month' => 'Novembre', 'start_date' => '01-11-2025'],
        ['id' => 12, 'month' => 'Dicembre', 'start_date' => '01-12-2025'],
    ];

    $monthsCollection = collect($monthsData);
@endphp

<div class="dropdown">
    <button class="dropdown-toggle" id="dataDropdownButton">Seleziona Mese</button>
    <ul class="dropdown-menu" id="dataDropdownMenu">
        @foreach ($monthsCollection as $data)
        @php
           $dataOggi = $data['start_date'];
        @endphp
        <li>
            <a class="dropdown-item"
                href="{{ url("/attivita/index/{$data['start_date']}/99") }}"
                onclick="updateDataOggiInput('{{ $data['start_date'] }}')">{{ $data['month'] }}
            </a>
        </li>
        @endforeach
    </ul>
</div>

<div class="dropdown">
    <button class="dropdown-toggle" id="attivitaDropdownButton">Seleziona Attività</button>
    <ul class="dropdown-menu" id="attivitaDropdownMenu">
        @foreach ($tipo_attivita as $attivita)
            <li>
                <a class="dropdown-item"
                    href="{{ url("/attivita/index/{$dataOggi}/{$attivita->id}") }}">
                    {{ $attivita->nome }}
                </a>
            </li>
        @endforeach
    </ul>
</div>


<script>
    let selectedDataOggi = "{{ $dataOggi }}";

    function updateDataOggiInput(selectedDate) {
        const dataOggiInput = document.getElementById('dataOggi_index');
        if (dataOggiInput) {
            dataOggiInput.value = selectedDate;
            selectedDataOggi = selectedDate; // Aggiorna il valore di $dataOggi
        }
    }

    document.addEventListener("DOMContentLoaded", function() {
        const attivitaDropdownButton = document.getElementById("attivitaDropdownButton");
        const attivitaDropdownMenu = document.getElementById("attivitaDropdownMenu");
    
        if (!attivitaDropdownButton || !attivitaDropdownMenu) {
            console.error("Dropdown button or menu not found. Ensure the IDs are correct.");
            return;
        }

        attivitaDropdownButton.addEventListener("click", function(event) {
            event.stopPropagation(); // Prevent click from propagating
            attivitaDropdownMenu.style.display = attivitaDropdownMenu.style.display === "block" ? "none" : "block";
        });

        document.addEventListener("click", function(event) {
            if (!attivitaDropdownMenu.contains(event.target)) {
                attivitaDropdownMenu.style.display = "none";
            }
        });
    });
</script>





<script>
    // Seleziona gli elementi
    const dataDropdownMenu = document.getElementById("dataDropdownMenu");
    const attivitaDropdownMenu = document.getElementById("attivitaDropdownMenu");

    // Aggiungi un listener per il click
    attivitaDropdownButton.addEventListener("click", function() {
        // Mostra/nasconde il menu
        if (attivitaDropdownMenu.style.display === "block") {
            attivitaDropdownMenu.style.display = "none";
        } else {
            attivitaDropdownMenu.style.display = "block";
        }
    });

    // Chiude il menu cliccando fuori
    document.addEventListener("click", function(event) {
        if (!attivitaDropdownButton.contains(event.target) && !attivitaDropdownMenu.contains(event.target)) {
            attivitaDropdownMenu.style.display = "none";
        }
    });





       // Aggiungi un listener per il click
       dataDropdownButton.addEventListener("click", function() {
        // Mostra/nasconde il menu
        if (dataDropdownMenu.style.display === "block") {
            dataDropdownMenu.style.display = "none";
        } else {
            dataDropdownMenu.style.display = "block";
        }
    });

    // Chiude il menu cliccando fuori
    document.addEventListener("click", function(event) {
        if (!dataDropdownButton.contains(event.target) && !dataDropdownMenu.contains(event.target)) {
            dataDropdownMenu.style.display = "none";
        }
    });
</script>
