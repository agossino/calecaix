<head>
    @php
        use Carbon\Carbon;
        use App\Models\Attivita;
        use App\Mail\SendeMail;
        use Illuminate\Support\Facades\Mail;

        $sendemail = $viewData["sendemail"];
        $attivita = Attivita::where("published", 1)
            ->where("id", $sendemail["attivita_id"])
            ->first();
        $titolo = $attivita->titolo;
        $dataOggius = Carbon::now()->toDateString(); // Ottiene la data di oggi nel formato 'YYYY-MM-DD'
        $dataOggi = Carbon::createFromFormat("Y-m-d", $dataOggius)->format("d-m-Y");

        
    @endphp

</head>


<x-layout_cai>
    <x-cai_bar_semplice />
    <x-menu-bar-home>

    </x-menu-bar-home>

 

    @php
        $email_accompagnatore = $attivita->email;
        $tipo_iscrizione = $sendemail["tipo_iscrizione"];
        $email = $sendemail["email"];
        $attivita_id = $sendemail["attivita_id"];
        $nome = $sendemail["nome"];
        $cognome = $sendemail["cognome"];
        $idiscr = $sendemail["iscrizione_id"];
        $cellulare = $sendemail["cellulare"];
       // $titolo = $titolo;
        
        $details = [
            "Oggetto" => "Dal Cai Bologna",
            "options" => $email,
            "subject" => "Attivita CAI Bologna ".$titolo,
            "title" => $titolo,
            "body" => "Ti sei iscritto alla attivita: " . $titolo,
            "utente" => "Nome utente: " . $nome . " " . $cognome. " ".$email,
            "testo" => "<div style='border: solid 1px; padding: 10px;'>
                        Per eventuale cancellazione o info scrivere a:" .$email_accompagnatore ."</div>",
        ];


        Mail::to($email)->send(new SendeMail($details));

        $details = [
            "Oggetto" => "si è iscritto dal sito caibo.it, Cai Bologna",
            "options" => $email,
            "subject" => "Attivita CAI Bologna: ".$titolo,
            "title" => $titolo,
            "body" => "Si è iscritto alla attivita: " . $titolo,
            "utente" => "Nome utente: " . $nome . " " . $cognome,
            "testo" => "<div> email: " .$email ." Cellulare: ".$cellulare ."</div>"
        ];
        Mail::to($email_accompagnatore)->send(new SendeMail($details));

    @endphp

    {{ $titolo . " Mandato email a:" . $email ." e ".$email_accompagnatore}}<br>

</x-layout_cai>
