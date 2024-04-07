<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Velo extends Model
{
    protected $fillable = [
        'couleur', // Ajout de 'joueur_id' à la liste fillable
        'id_partie',
        'lien',
        'joueur_id',
        'banque',

    ];
}
