<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Proposte extends Model
{
    protected $fillable = [
        'data_inizio',
        'descrizione',
        'note',
        'data_proposta',
        'inizio_iscrizioni',
        'tipo_iscrizione',
        'fine_iscrizioni',
        'nome',
        'cognome',
        'gruppo',
        'email',
        'telefono',
        'qualifica',
        'specializzazione',
        'altri_organizzatori',
        'tipologia',
        'difficolta',
        'durata',
        'socio',
        'dislivello',
        'quota_minima',
        'quota_massima',
        'tratti_spinta',
        'portage',
        'numero_minimo',
        'numero_massimo',
        'ammissione',
        'altri_costi',
        'tipo_trasporto',
        'ora_ritrovo',
        'luogo_ritrovo',
        'attrezzatura_specifica',
        'fotografie',
        'traccia_gpx'
    ];
}
