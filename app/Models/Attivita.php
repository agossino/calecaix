<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attivita extends Model
{
    use HasFactory;

    protected $fillable = [

        'email',
        'titolo',
        'data_inizio',
        'data_fine',
        'telefono',
        'nome',
        'cognome',
        'qualifica',
        'calendario',
        'altro',
        'specializzazione',
        'altriorganizzatori',
        'tipologia',
        'difficolta',
        'durata',
        'socio',
        'a_spinta',
        'portage',
        'dislivello',
        'quotaminima',
        'quotamassima',
        'numerominimo',
        'numeromassimo',
        'altricosti',
        'tipologiatrasporto',
        'oraritrovo',
        'luogoritrovo',
        'linkluogo',
       'link_modulo_esterno',
        'descrizione',
        'note',
        'image1_file',
        'image2_file',
        'inizio_iscrizioni',
        'fine_iscrizioni',
        'user_email'
    ];
    protected $casts = [
        'qualifica' => 'array',
        'specializzazione' => 'array',
        'canale' => 'array',
        'difficolta' => 'array',
        'tipologiatrasporto' => 'array',
        'secondoritrovo' => 'array',
        'tipo_iscrizione'  => 'array',
    ];
}
