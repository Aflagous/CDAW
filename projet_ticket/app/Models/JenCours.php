<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JenCours extends Model
{
    protected $fillable = [
        'id_partie',
        'joueur_id',
        'pioche',
        'pioche_2',

    ];


    public function joueurenlive()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
