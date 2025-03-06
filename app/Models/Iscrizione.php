<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Iscrizione extends Model
{
    use HasFactory;

    protected $fillable = [
        'nome',
        'cognome',
        'indirizzo',
        'socio_cai',
        'sezione',
        'email',
        'cellulare',
    ];

}
