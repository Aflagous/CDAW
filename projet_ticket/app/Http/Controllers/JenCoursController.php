<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\JenCours;
use App\Models\Partie;

class JenCoursController extends Controller
{
    public function miseAJourJenCours($id)
    {
        $partie = Partie::find($id);
        $nomsDesJoueurs = $partie->joueurs()->get();
    
        $jenCoursActuel = JenCours::where('id_partie', $id)->first();
        $joueurActuelId = $jenCoursActuel->joueur_id;
    
        $indexJoueurActuel = $nomsDesJoueurs->search(function ($joueur) use ($joueurActuelId) {
            return $joueur->id === $joueurActuelId;
        });
    
        $indexJoueurSuivant = ($indexJoueurActuel + 1) % count($nomsDesJoueurs);
        $joueurSuivantId = $nomsDesJoueurs[$indexJoueurSuivant]->id;
    
        JenCours::where('id_partie', $id)->update(['joueur_id' => $joueurSuivantId]);
    
        return response()->json(['success' => true]);
    }
    
}

