<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CardDestination extends Model
{
    protected $fillable = [
        'id_partie',
        'lien',
        'joueur_id',
        'from',
        'to',
        'banque',

    ];}
