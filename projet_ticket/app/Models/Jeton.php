<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jeton extends Model
{
    protected $fillable = [
        'joueur_id', // Ajout de 'joueur_id' à la liste fillable
        'id_partie',
        'nombre',
    ];


}
