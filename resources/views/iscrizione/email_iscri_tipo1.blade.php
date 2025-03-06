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
        $cellulare = $sendemail["cellulare"];
        $iscrizione_tipo = $sendemail["iscrizione_tipo"];
        $email = $sendemail["email"];
        $attivita_id = $sendemail["attivita_id"];
        $nome = $sendemail["nome"];
        $cognome = $sendemail["cognome"];
        $idiscr = $sendemail["iscrizione_id"];
       // $titolo = $titolo;
        $url_cancella = route("iscrizione.canc_daweb", ["idiscr" => $idiscr], true);
        $url_conferma = route("iscrizione.conf_daweb", ["idiscr" => $idiscr], true);
        $details = [
            "options" => "caibo",
            "subject" => "Attivita CAI Bologna: " . $titolo,
            "title" => $titolo,
            "body" => "Ti sei iscritto alla attivita: " . $titolo,
            "utente" => "Nome utente: " . $nome . " " . $cognome,
            "testo" =>
                "<div style='border: solid 1px; padding: 10px;'>
                        Per eventuale cancellazione fai clic su questo link: 
                        <a href='" .$url_cancella . "' style='color: #d81e75; text-decoration: none;'>Cancella Iscrizione</a>
                    </div><div style='border: solid 1px; padding: 10px;'>
                        Per confermare fai clic su questo link: 
                        <a href='" .$url_conferma . "' style='color: #4CAF50; text-decoration: none;'>Conferma Iscrizione</a>
                    </div>",
        ];
        Mail::to($email)->send(new SendeMail($details));

    @endphp

    {{ $titolo . " Mandato email per conferma o cancellazione a:" . $email }}<br>

</x-layout_cai>
