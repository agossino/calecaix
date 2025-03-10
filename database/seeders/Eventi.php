<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class Eventi extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('tipo_volantinos')->truncate();
        DB::table('tipo_volantinos')->insert(['id' => 0, 'tipo_volantino' => 0,  'order' => 0,'nome' => 'Interno','descrizione' => ' (carica il progamma in pdf dal tuo PC)','published' => 1]);
        DB::table('tipo_volantinos')->insert(['id' => 1, 'tipo_volantino' => 1,  'order' => 1,'nome' => 'Esterno','descrizione' => '(link al programma in pdf che hai su di un server)','published' => 1]);
        DB::table('tipo_volantinos')->insert(['id' => 2, 'tipo_volantino' => 2,  'order' => 2,'nome' => 'Autogenerato','descrizione' => '(Viene creato dai dati inseriti di seguito)','published' => 0]);

        DB::table('tipo_utentes')->truncate();
        DB::table('tipo_utentes')->insert(['id' => 1, 'tipo_role' => 'user',  'order' => 1,'nome' => 'Utente','descrizione' => 'Utente registrato']);
        DB::table('tipo_utentes')->insert(['id' => 0, 'tipo_role' => 'accompagnatore',  'order' => 0,'nome' => 'Accompagnatore','descrizione' => '(Accompagna trekking,gestisce corsi)']);
        DB::table('tipo_utentes')->insert(['id' => 2, 'tipo_role' => 'accompagnatore_editor',  'order' => 2,'nome' => 'Accompagnatore Editor','descrizione' => '(Inserisce eventi, corsi ecc)']);
        DB::table('tipo_utentes')->insert(['id' => 3, 'tipo_role' => 'amministratore', 'order' => 3,'nome' => 'Amministratore','descrizione' => '(Gestione massima)']);


        DB::table('tipo_iscriziones')->truncate();
        DB::table('tipo_iscriziones')->insert(['id' => 0, 'published' => 0,'tipo_iscrizione' => 0,  'order' => 0,'nome' => 'Dall\'accompagnatore telefono','descrizione' => '(Chiamata telefonica all\'accompagnatore)']);
        DB::table('tipo_iscriziones')->insert(['id' => 1, 'published' => 1,'tipo_iscrizione' => 1,  'order' => 3,'nome' => 'Dal sito caibo','descrizione' => '(Apposito modulo gia preparato nel sito dal quale potrai gestire gli isctitti)']);
        DB::table('tipo_iscriziones')->insert(['id' => 2, 'published' => 0,'tipo_iscrizione' => 2,  'order' => 1,'nome' => 'Dall\'accompagnatore Email','descrizione' => '(Mandare email all\'accompagnatore)']);
        DB::table('tipo_iscriziones')->insert(['id' => 3, 'published' => 1,'tipo_iscrizione' => 3,  'order' => 2,'nome' => 'Modulo online personalizzato','descrizione' => '(Form/modulo Google)']);
        DB::table('tipo_iscriziones')->insert(['id' => 4, 'published' => 1,'tipo_iscrizione' => 4,  'order' => 4,'nome' => 'No iscrizione','descrizione' => '(Nessuna iscrizione)']);
    

        DB::table('tipo_attivitas')->truncate();
        DB::table('tipo_attivitas')->insert(['id' => 0, 'published' => 0,'tipo_attivita' => 0, 'order' => 0, 'nome' => 'Calendario','descrizione' => 'Calendari attivita diverse con date durante l\'anno']);
        DB::table('tipo_attivitas')->insert(['id' => 1, 'tipo_attivita' => 1, 'order' => 1, 'nome' => 'Escursionismo','descrizione' => 'Trekkig in Italia']);
        DB::table('tipo_attivitas')->insert(['id' => 2, 'tipo_attivita' => 2,  'order' => 2,'nome' => 'Corsi', 'descrizione' => 'Corsi di qualsiasi tipo']);
        DB::table('tipo_attivitas')->insert(['id' => 3, 'tipo_attivita' => 3,  'order' => 3,'nome' => 'Grandi Trekking','descrizione' => 'Trekking a tappe successive in Italia e all\'estero di piu giorni']);
        DB::table('tipo_attivitas')->insert(['id' => 4, 'tipo_attivita' => 4,  'order' => 4,'nome' => 'Scialpinismo','descrizione' => 'Sci Alpinismo']);
        DB::table('tipo_attivitas')->insert(['id' => 5, 'tipo_attivita' => 5,  'order' => 5,'nome' => 'Ciclo escursionismo','descrizione' => 'Ciclo escursionismo']);
        DB::table('tipo_attivitas')->insert(['id' => 6, 'tipo_attivita' => 6,  'order' => 6,'nome' => 'AlpinismoGiovanile','descrizione' => 'Alpinismo per ragazzi fino ai 17 anni']);
        DB::table('tipo_attivitas')->insert(['id' => 7, 'tipo_attivita' => 7,  'order' => 7,'nome' => 'Trekkingcoltreno','descrizione' => 'Link al sito Trekking col treno']);
        DB::table('tipo_attivitas')->insert(['id' => 8, 'tipo_attivita' => 8,  'order' => 8,'nome' => 'Eventi CAIBO','descrizione' => 'Eventi vari, cinema, incontri in sede,riunioni, aggiornamenti ecc ... ']);
        DB::table('tipo_attivitas')->insert(['id' => 9, 'tipo_attivita' => 9,  'order' => 9,'nome' => 'Trekking Residenziali','descrizione' => 'Trekkig in Italia e al\'estero di piu giorni con base in singolo luogo']);
        

        DB::table('catids')->truncate();
        DB::table('catids')->insert(['id' => 0, 'categoria' => 0, 'nome' => 'Info']);
        DB::table('catids')->insert(['id' => 1, 'categoria' => 1, 'nome' => 'Articoli']);

        // evento eventi di prova iniziales
       // DB::table('eventis')->insert(['id' => 0, 'titolo' => 'Test iniziale per prove da seeders Eventi.php ', 'descrizione' => '(cancellare il record nel database tabella eventi)', 'categoria' => 0, 'inizio' => '2024-12-30', 'fine' => '2024-12-30', 'image_file' => 'imgtrek/3.png', 'volantino' => 'Contributi-pubblici 2021.pdf', 'tipo_iscrizione' => 0, 'published' => 1, 'tipo_volantino' => 0, 'contatti' => 'Contatti con xxxxxx']);
       
        DB::table('contents')->truncate();
        DB::table('contents')->insert(['id' => 0, 'titolo' => 'Termini', 'alias' => 'termini', 'introtext' => 'Prenotazione da effettuare entro le 17 del venerdì  
        socio  quota di partecipazione 2 € 
        non socio quota di partecipazione 7 € assicurazione compresa
        da pagare alla partenza con danaro contato da inserire in apposito contenitore (senza possibilità di resto) per evitare maneggio di denaro 
        Nota: per i "Grandi trekking" le quote sono indicate sul volantino (programma)
Soci under 25: iscrizione gratuita', 'catid' => 0, 'state' => 1, 'published' => 1]);

        DB::table('contents')->insert(['id' => 0, 'titolo' => 'privacy', 'alias' => 'privacy', 'introtext' => 'Inserire la privacy', 'catid' => 0, 'state' => 1, 'published' => 1]);
       
        DB::table('contents')->insert(['id' => 0, 'titolo' => 'ciao_leggi', 'alias' => 'ciao-leggi', 'introtext' => 'Questa applicazione è stata creata da volontari del CAI Bologna, segnalare a (rino.ruggeri@staff.caibo.it)  errori e suggerimenti<br>Grazie', 'catid' => 0, 'state' => 1, 'published' => 1]);
      
        DB::table('stato_iscriziones')->truncate();
        DB::table('stato_iscriziones')->insert(['id' => 0, 'stato_iscrizione' => 0,  'order' => 0,'nome' => 'Non iscritto']);
        DB::table('stato_iscriziones')->insert(['id' => 1, 'stato_iscrizione' => 1,  'order' => 1,'nome' => 'Iscritto']);
     
   
    }
}
