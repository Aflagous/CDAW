<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Groupe extends Model
{
    use HasFactory;

    protected $fillable = ['joueur_id', 'partie_id', 'couleur'];
    public $timestamps = false;

    public function joueurs()
    {
        return $this->belongsToMany(User::class, 'groupes', 'partie_id', 'joueur_id');
    }

    public function joueur()
    {
        return $this->hasOne(User::class, 'joueur_id');
    }
}
