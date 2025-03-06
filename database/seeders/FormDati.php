<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FormDati extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        DB::table('tipo_qualificas')->truncate();
        DB::table('tipo_qualificas')->insert(['id' => 0, 'tipo_qualifica' => 0, 'nome' => 'ANC - ', 'descrizione' => 'ANC (Accompagnatore Nazionale di Cicloescursionismo)']);
        DB::table('tipo_qualificas')->insert(['id' => 1, 'tipo_qualifica' => 1, 'nome' => 'AC  - ', 'descrizione' => 'AC (Accompagnatore di Cicloescursionismo)']);
        DB::table('tipo_qualificas')->insert(['id' => 2, 'tipo_qualifica' => 2, 'nome' => 'ASC - ', 'descrizione' => 'ASC (Accompagnatore Sezionale di Cicloescursionismo)']);
        DB::table('tipo_qualificas')->insert(['id' => 3, 'tipo_qualifica' => 3, 'nome' => 'DC  --', 'descrizione' => 'DC (Direttore di Cicloescursionismo)']);
        DB::table('tipo_qualificas')->insert(['id' => 4, 'tipo_qualifica' => 4, 'nome' => 'ANE - ', 'descrizione' => 'ANE (Accompagnatore Nazionale di Escursionismo)']);
        DB::table('tipo_qualificas')->insert(['id' => 5, 'tipo_qualifica' => 5, 'nome' => 'AE  - ', 'descrizione' => 'AE (Accompagnatore di Escursionismo)']);
        DB::table('tipo_qualificas')->insert(['id' => 6, 'tipo_qualifica' => 6, 'nome' => 'ASE - ', 'descrizione' => 'ASE (Accompagnatore Sezionale di Escursionismo)']);
        DB::table('tipo_qualificas')->insert(['id' => 7, 'tipo_qualifica' => 7, 'nome' => 'DE  - ', 'descrizione' => 'DE (Direttore di Escursionismo)']);
        DB::table('tipo_qualificas')->insert(['id' => 8, 'tipo_qualifica' => 8, 'nome' => 'Altro  - ', 'descrizione' => 'Altro:']);

        DB::table('tipo_specializzaziones')->truncate();
        DB::table('tipo_specializzaziones')->insert(['id' => 0, 'tipo_specializzazione' => 0, 'nome' => 'EEA - ', 'descrizione' => 'EEA']);
        DB::table('tipo_specializzaziones')->insert(['id' => 1, 'tipo_specializzazione' => 1, 'nome' => 'EAI - ', 'descrizione' => 'EAI']);
        DB::table('tipo_specializzaziones')->insert(['id' => 2, 'tipo_specializzazione' => 2, 'nome' => 'Altro - ', 'descrizione' => 'Altro']);

        DB::table('tipo_socios')->truncate();
        DB::table('tipo_socios')->insert(['id' => 0, 'tipo_socio' => 0, 'nome' => 'Tutti', 'descrizione' => '(Soci e non soci)']);
        DB::table('tipo_socios')->insert(['id' => 1, 'tipo_socio' => 1, 'nome' => 'Soci', 'descrizione' => ' (Solo Soci CAI)']);
      
        DB::table('tipo_difficoltas')->truncate();
        DB::table('tipo_difficoltas')->insert(['id' => 0, 'tipo_difficolta' => 0, 'nome' => 'T', 'descrizione' => ' Turistico']);
        DB::table('tipo_difficoltas')->insert(['id' => 1, 'tipo_difficolta' => 1, 'nome' => 'E', 'descrizione' => 'Escursionisrtico']);
        DB::table('tipo_difficoltas')->insert(['id' => 2, 'tipo_difficolta' => 2, 'nome' => 'EE', 'descrizione' => 'Escursionisti esperti']);
        DB::table('tipo_difficoltas')->insert(['id' => 3, 'tipo_difficolta' => 3, 'nome' => 'EEA', 'descrizione' => 'Escursionisrti esperti con atterzzatura']);
 
        DB::table('tipo_calendarios')->truncate();
        DB::table('tipo_calendarios')->insert(['id' => 0, 'tipo_calendario' => 0, 'nome' => 'No calendario', 'descrizione' => 'Attività singola']);
        DB::table('tipo_calendarios')->insert(['id' => 1, 'tipo_calendario' => 1, 'nome' => 'Parziale', 'descrizione' => ' Solo un periodo dell\'anno']);
        DB::table('tipo_calendarios')->insert(['id' => 2, 'tipo_calendario' => 2, 'nome' => 'Annuale', 'descrizione' => 'Sezionale, copre tutto l\'anno']);
       
        DB::table('tipo_scelte_internes')->truncate();
        DB::table('tipo_scelte_internes')->insert(['id' => 0, 'tipo_scelte' => 0, 'scelta' => '0', 'descrizione' => 'xx']);
        DB::table('tipo_scelte_internes')->insert(['id' => 1, 'tipo_scelte' => 1, 'scelta' => '0', 'descrizione' => 'x']);
    }
}
