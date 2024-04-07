<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Partie extends Model
{
    protected $fillable = [
        'name', 'publique', 'temps', 'mdp', 'mdptext', 'hote_id', 'commencer', 'fini', 'debut'
    ];
    public function joueurs()
    {
        return $this->belongsToMany(User::class, 'groupes', 'partie_id', 'joueur_id');
    }
}
