<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Partie; 
use App\Models\User;
use App\Models\Groupe;
use App\Models\Velo;
use App\Models\Routes;
use App\Models\Jeton;
use App\Models\Point;
use App\Models\JenCours;
use App\Models\CheminLePlusLong;
use App\Models\CardDestination;
use App\Models\Friendship;
use Illuminate\Support\Facades\Redirect;
use App\Events\PlayerJoined;
use App\Events\LauchEvent;
use App\Events\ChangementDeJoueur;
use App\Events\PlayerLeft;
use App\Events\actualisation;
use App\Events\finpartie;

class Gamecontroller extends Controller
{
    
    public function showParties()
    {
        $amis = auth()->user()->friends()->select('users.id')->pluck('users.id');
        $isAdmin = auth()->user()->admin ?? false;
        $gamesprivees = Partie::where('publique', 0)
        ->where(function($query) use ($amis) {
            $query->whereIn('hote_id', $amis)
                ->orWhere('hote_id', auth()->user()->id);
        })
        ->where('fini', 0)
        ->where('commencer', 0)
        ->get();
    

        $encours = Groupe::where('joueur_id', auth()->user()->id)
                        ->first();

        $groupe = $encours ? true : false;
        $gamespubliques = Partie::where('publique', 1)
                                ->where('fini', 0)
                                ->where('commencer', 0)
                                ->get();
                                
        return view('partie', [
            'gamespubliques' => $gamespubliques,
            'groupe' => $groupe,
            'encours' => $encours,
            'gamesprivees' => $gamesprivees,
            'isAdmin' => $isAdmin,
        ]);

    }

    public function creerParties(Request $request)
    {
        
        // Validation des données du formulaire
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'publique' => 'nullable|boolean',
            'temps' => 'required|integer',
            'mdp' => 'nullable|string|max:255',
            'mdptext' => 'nullable|string|max:255',
            'hote_id' => 'required|exists:users,id',
            'commencer' => 'nullable|boolean',
            'fini' => 'nullable|boolean',
        ]);
     
        $partie = Partie::create($validatedData);
        $groupe = Groupe::create([
            'joueur_id' => auth()->user()->id, 
            'partie_id' => $partie->id,
            'couleur' => 'rouge'
        ]);
        return redirect()->route('parties');
    }

    public function creerPartiesvue()
    {
        $isAdmin = auth()->user()->admin ?? false;
        $personne = User::findOrFail(auth()->user()->id);
        $friends = $personne->friends()->get();

        

        return view('creerpartie', [
            'amis' => $friends,
            'isAdmin' => $isAdmin
        ]);
    }

  


    public function joinPrivateGame(Request $request, $userId)
    {
        $mdpSaisi = $request->input('mdp');

        $partie = Partie::where('id', $userId)
                        ->where('mdp', $mdpSaisi)
                        ->first();
        $couleursUtilisees = Groupe::where('partie_id', $partie->id)
                        ->pluck('couleur')
                        ->toArray();
                            
        $couleursDisponibles = ['rose', 'vert', 'bleu', 'jaune'];
        $couleurAttribuee = null;
        foreach ($couleursDisponibles as $couleur) {
            if (!in_array($couleur, $couleursUtilisees)) {
                $couleurAttribuee = $couleur;
                break;
            }
        }
        if ($partie) {
            $groupe = Groupe::create([
                'joueur_id' => auth()->user()->id,
                'partie_id' => $partie->id,
                'couleur' => $couleurAttribuee
            ]);
            $groupe->save();
            event(new PlayerJoined(auth()->user()->name,  $partie->id));
            return redirect()->route('parties');

        } else {
          
            return back();
        }
    }

    public function joinPubliqueGame($partieId)
    {
        $partie = Partie::where('id', $partieId)
                        ->first();
        $couleursUtilisees = Groupe::where('partie_id', $partie->id)
                        ->pluck('couleur')
                        ->toArray();
                            
        $couleursDisponibles = ['rose', 'vert', 'bleu', 'jaune'];
        $couleurAttribuee = null;
        foreach ($couleursDisponibles as $couleur) {
            if (!in_array($couleur, $couleursUtilisees)) {
                $couleurAttribuee = $couleur;
                break;
            }
        }

        Groupe::create([
            'joueur_id' => auth()->user()->id,
            'partie_id' => $partieId,
            'couleur' => $couleurAttribuee

        ]);
        event(new PlayerJoined(auth()->user()->name,  $partieId));
        return redirect()->route('parties');


    }

    public function attente($id)
    {    

        $isAdmin = auth()->user()->admin ?? false;
        $partie = Partie::find($id);
        $nomsDesJoueurs = $partie->joueurs()->get();
        if ($partie->commencer) {
            return redirect()->route('parties.lauch', ['id' => $partie->id]);

        } else {
            return view('attentepartie', [
                'isAdmin' => $isAdmin,
                'partie' => $partie,
                'nomsDesJoueurs' => $nomsDesJoueurs,
            ]);
        }
    }

    public function boum($id)
    {
        event(new PlayerLeft(auth()->user()->name, $id));
        $userId = auth()->user()->id;
        $groupes = Groupe::where('joueur_id', $userId)->where('partie_id', $id)->get();

        foreach ($groupes as $groupe) {
            $groupe->delete();
        }
        return redirect()->route('parties');
    }

    public function lauchEvent($id) 
    {
        $partie = Partie::find($id);
        broadcast(new LauchEvent($partie->id))->toOthers();
        return redirect()->route('parties.lauch', ['id' => $partie->id]);
    }

    public function destroy($id) 
    {
        $partie = Partie::find($id);
        $isAdmin = auth()->user()->admin ?? false;
        $partie->update(['commencer' => false]);
        $nomsDesJoueurs = $partie->joueurs()->get();
    
     
      
        $cards = CardDestination::where('id_partie', $partie->id)->get();
        foreach ($cards as $card) {
            $card->delete();
        }
        
        $jetons = Jeton::where('id_partie', $partie->id)->get();
        foreach ($jetons as $jeton) {
            $jeton->delete();
        }
        
        $velos = Velo::where('id_partie', $partie->id)->get();
        foreach ($velos as $velo) {
            $velo->delete();
        }
        
        $points = Point::where('id_partie', $partie->id)->get();
        foreach ($points as $point) {
            $point->delete();
        }
        Routes::where('id_partie', $partie->id)->delete();

        
        $jencours = JenCours::where('id_partie', $partie->id)->get();
        foreach ($jencours as $jencour) {
            $jencour->delete();
        }
        Partie::where('id', $id)->update(['debut' => false]);


        return redirect()->route('parties.attente', ['id' => $partie->id]);

    }

    public function lauch($id) 
    {
        $partie = Partie::find($id);
        $isAdmin = auth()->user()->admin ?? false;
        $partie->update(['commencer' => true]);
        $nomsDesJoueurs = $partie->joueurs()->get();
        if (auth()->user()->id == $partie->hote_id) {
            foreach ($nomsDesJoueurs as $joueur) {
                Jeton::create([
                    'joueur_id' => $joueur->id,
                    'id_partie' => $partie->id,
                    'nombre' => 5,
                ]);
                Point::create([
                    'joueur_id' => $joueur->id,
                    'id_partie' => $partie->id,
                    'points' => 0,
                ]);
            }
            for ($i = 2; $i < 12; $i++) {
                CardDestination::create([
                    'id_partie' => $partie->id,
                    'lien' => 'A ('.$i.').png',
                    'joueur_id' => 1,
                    'from' => 1,
                    'to' => 1,
                    'banque' => 1
    
                ]);
            }
            $route = [[5,3], [2,1], [3,3], [6,3], [7,2], [2,2], [0,2], [5,2], [1,5], [9,3], [6,3], [1,3], [3,3], [5,2], [0,1], [6,2], [4,1], [4,3], [0,3], [7,4], [9,4]];

            for ($i = 0; $i < 21; $i++) {
                Routes::create([
                    'couleur' => $route[$i][0],
                    'nombre' => $i,
                    'id_partie' => $partie->id,
                    'joueur_id' => 1,
                    'longueur' =>$route[$i][1],
                ]);
            }
            $banqueValues = [1, 2, 3, 4, 5, 6];
            $velos_couleur = ['velo_bleu.png', 'velo_jaune.png', 'velo_marron.png', 'velo_orange.png', 'velo_rose.png', 'velo_vert.png', 'velo_rouge.png', 'velo_violet.png', 'velo_joker.png'];
            for ($i = 0; $i < 9; $i++) {
                for ($j = 0; $j < 12; $j++) {
                    $banqueValue = $j % 7; 
                    Velo::create([
                        'joueur_id' => 1,
                        'banque' => $banqueValue,
                        'id_partie' => $partie->id,
                        'couleur' => 0,
                        'lien' => $velos_couleur[0],

                    ]);
                    Velo::create([
                        'joueur_id' => 1,
                        'banque' => $banqueValue,
                        'id_partie' => $partie->id,
                        'couleur' => 1,
                        'lien' => $velos_couleur[1],

                    ]);
                    Velo::create([
                        'joueur_id' => 1,
                        'banque' => $banqueValue,
                        'id_partie' => $partie->id,
                        'couleur' => 2,
                        'lien' => $velos_couleur[2],

                    ]);
                    Velo::create([
                        'joueur_id' => 1,
                        'banque' => $banqueValue,
                        'id_partie' => $partie->id,
                        'couleur' => 3,
                        'lien' => $velos_couleur[3],

                    ]);
                    Velo::create([
                        'joueur_id' => 1,
                        'banque' => $banqueValue,
                        'id_partie' => $partie->id,
                        'couleur' => 4,
                        'lien' => $velos_couleur[4],

                    ]);
                    Velo::create([
                        'joueur_id' => 1,
                        'banque' => $banqueValue,
                        'id_partie' => $partie->id,
                        'couleur' => 5,
                        'lien' => $velos_couleur[5],

                    ]);
                    Velo::create([
                        'joueur_id' => 1,
                        'banque' => $banqueValue,
                        'id_partie' => $partie->id,
                        'couleur' => 6,
                        'lien' => $velos_couleur[6],

                    ]);
                    Velo::create([
                        'joueur_id' => 1,
                        'banque' => $banqueValue,
                        'id_partie' => $partie->id,
                        'couleur' => 7,
                        'lien' => $velos_couleur[7],

                    ]);
                    Velo::create([
                        'joueur_id' => 1,
                        'banque' => $banqueValue,
                        'id_partie' => $partie->id,
                        'couleur' => 8,
                        'lien' => $velos_couleur[8],

                    ]);
                }
                Velo::create([
                    'joueur_id' => 1,
                    'banque' => $banqueValue,
                    'id_partie' => $partie->id,
                    'couleur' => 8,
                    'lien' => $velos_couleur[8],

                ]);
                Velo::create([
                    'joueur_id' => 1,
                    'banque' => $banqueValue,
                    'id_partie' => $partie->id,
                    'couleur' => 8,
                    'lien' => $velos_couleur[8],

                ]);
            }

            JenCours::create([
                'joueur_id' => $nomsDesJoueurs[0]->id,
                'id_partie' => $partie->id,
            ]);
        }
        $velos = Velo::where('id_partie', $partie->id)
        ->where('joueur_id', 1)->get();
        if (!$velos->isEmpty()) {
            $seed = 12345; 
       
            $shufflevelos = $velos->shuffle($seed);
            if (!$shufflevelos->isEmpty()) {
                for ($j = 0; $j < 4; $j++) {
                        $card = $shufflevelos->pop();
                        $card->joueur_id = auth()->user()->id;
                        $card->save();
                   
                }
            }
        }
      
        
        

        return redirect()->route('parties.game', ['id' => $partie->id]);

    }

    public function lagame($id) 
    {
        $shufflevelos = null; 
        $partie = Partie::find($id);
        $isAdmin = auth()->user()->admin ?? false;
        $nomsDesJoueurs = $partie->joueurs()->get();
        $couleursDesJoueurs = $nomsDesJoueurs->where('joueur_id', auth()->user()->id);
        $cards = CardDestination::where('id_partie', $partie->id)
                                ->where('joueur_id', 1)
                                ->get();
        $routes1 = Routes::where('id_partie', $partie->id)
                                ->where('nombre', 0)
                                ->first();
        $routes2 = Routes::where('id_partie', $partie->id)
                                ->where('nombre', 1)
                                ->get();
        $routes3 = Routes::where('id_partie', $partie->id)
                                ->where('nombre', 2)
                                ->get();
        $routes4 = Routes::where('id_partie', $partie->id)
                                ->where('nombre', 3)
                                ->get();
        $routes5 = Routes::where('id_partie', $partie->id)
                                ->where('nombre', 4)
                                ->get();
        $routes6 = Routes::where('id_partie', $partie->id)
                                ->where('nombre', 5)
                                ->get();
        $routes7 = Routes::where('id_partie', $partie->id)
                                ->where('nombre', 6)
                                ->get();
        $routes8 = Routes::where('id_partie', $partie->id)
                                ->where('nombre', 7)
                                ->get();
        $routes9 = Routes::where('id_partie', $partie->id)
                                ->where('nombre', 8)
                                ->get();
        $routes10 = Routes::where('id_partie', $partie->id)
                                ->where('nombre', 9)
                                ->get();
        $routes11 = Routes::where('id_partie', $partie->id)
                                ->where('nombre', 10)
                                ->get();
        $routes12 = Routes::where('id_partie', $partie->id)
                                ->where('nombre', 11)
                                ->get();
        $routes13 = Routes::where('id_partie', $partie->id)
                                ->where('nombre', 12)
                                ->get();
        $routes14 = Routes::where('id_partie', $partie->id)
                                ->where('nombre', 13)
                                ->get();
        $routes15 = Routes::where('id_partie', $partie->id)
                                ->where('nombre', 14)
                                ->get();
        $routes16 = Routes::where('id_partie', $partie->id)
                                ->where('nombre', 15)
                                ->get();
        $routes17 = Routes::where('id_partie', $partie->id)
                                ->where('nombre', 16)
                                ->get();
        $routes18 = Routes::where('id_partie', $partie->id)
                                ->where('nombre', 17)
                                ->get();
        $routes19 = Routes::where('id_partie', $partie->id)
                                ->where('nombre', 18)
                                ->get();
        $routes20 = Routes::where('id_partie', $partie->id)
                                ->where('nombre', 19)
                                ->get();
        $routes21 = Routes::where('id_partie', $partie->id)
                                ->where('nombre', 20)
                                ->get();
        $shuffledCards = $cards->shuffle();
        $cardSelected = CardDestination::where('id_partie', $partie->id)
                                ->whereNotIn('joueur_id', [1])
                                ->get();
        $jetons = Jeton::where('id_partie', $partie->id)->get();
        $velos = Velo::where('id_partie', $partie->id)
        ->where('joueur_id', 1)
        ->get()
        ->sortBy('couleur');
        $veloss = $velos->shuffle();
                $velosmain = Velo::where('id_partie', $partie->id)->whereNotIn('joueur_id', [1])->get();
        $points = Point::where('id_partie', $partie->id)->get();
        $jencours = Jencours::where('id_partie', $partie->id)->first();
        $personne = User::find($nomsDesJoueurs[0]->id);
        return view('ingame', [
            'partie' => $partie,
            'isAdmin' => $isAdmin,
            'jetons' => $jetons,
            'routes1' => $routes1,
            'routes2' => $routes2,
            'routes3' => $routes3,
            'routes4' => $routes4,
            'routes5' => $routes5,
            'routes6' => $routes6,
            'routes7' => $routes7,
            'routes8' => $routes8,
            'routes9' => $routes9,
            'routes10' => $routes10,
            'routes11' => $routes11,
            'routes12' => $routes12,
            'routes13' => $routes13,
            'routes14' => $routes14,
            'routes15' => $routes15,
            'routes16' => $routes16,
            'routes17' => $routes17,
            'routes18' => $routes18,
            'routes19' => $routes19,
            'routes20' => $routes20,
            'routes21' => $routes21,
            'cards' => $shuffledCards,
            'cardSelected' => $cardSelected,
            'velos' => $veloss,
            'velosmain' => $velosmain,                     
            'points' => $points,
            'jencours' => $jencours,
            'nomsDesJoueurs' => $nomsDesJoueurs,
            'couleursDesJoueurs' => $couleursDesJoueurs,
            'personne' => $personne,
        ]);
    }

    public function desti(Request $request, $id)
    {
        $cartesSelectionnees = $request->input('cartes_selectionnees');
        foreach ($cartesSelectionnees as $carteId) {
            CardDestination::where('id', $carteId)->update(['joueur_id' => auth()->user()->id]);
        }        
        Partie::where('id', $id)->update(['debut' => true]);
    }

    public function piochedesti(Request $request, $id)
    {
        $partie = Partie::find($id);
            $cartesSelectionnees = $request->input('cartes_selectionnees');
            foreach ($cartesSelectionnees as $carteId) {
                CardDestination::where('id', $carteId)->update(['joueur_id' => auth()->user()->id]);
            }       
            $this->miseAJourJenCours($id);
                        event(new ChangementDeJoueur($id));
         
    }

  
    public function piochevelo(Request $request, $id)
    {
        $jenCoursActuel = JenCours::where('id_partie', $id)->first();
        $velo = $request->input('velo');
        $veloo = Velo::find($velo['id']);
        $veloo->joueur_id = auth()->user()->id;
        if($jenCoursActuel->joueur_id == auth()->user()->id) {
            $veloo = Velo::find($velo['id']);
            $veloo->joueur_id = auth()->user()->id;
            if($jenCoursActuel->pioche != 3) {
                $jenCoursActuel->pioche = $jenCoursActuel->pioche + 1;
                if($veloo->couleur == 8) {
                    $jenCoursActuel->pioche = 0;
                    $jenCoursActuel->save();
                    $this->miseAJourJenCours($id);
                    broadcast(new ChangementDeJoueur($id))->toOthers();
                } else {
                    $jenCoursActuel->save();
                    event(new actualisation($id));
                }
            }
            $jenCoursActuel = JenCours::where('id_partie', $id)->first();
            if($jenCoursActuel->pioche == 3) {
                $jenCoursActuel->pioche = 0;
                $jenCoursActuel->save();
                $this->miseAJourJenCours($id);
                broadcast(new ChangementDeJoueur($id))->toOthers();
            }
        }
        $jenCoursActuel = JenCours::where('id_partie', $id)->first();
        $veloo->save();
        // Retourner $jenCoursActuel
        return response()->json(['jenCoursActuel' => $jenCoursActuel], 200);
    }
    public function piochevelopot(Request $request, $id)
    {
        $jenCoursActuel = JenCours::where('id_partie', $id)->first();
        $velo = $request->input('velo');
        if($jenCoursActuel->joueur_id == auth()->user()->id) {
            $veloo = Velo::find($velo['id']);
            $veloo->joueur_id = auth()->user()->id;
            if($jenCoursActuel->pioche != 3) {
                $jenCoursActuel->pioche = $jenCoursActuel->pioche + 1;
                $jenCoursActuel->save();
                event(new actualisation($id));
            }
            $jenCoursActuel = JenCours::where('id_partie', $id)->first();
            if($jenCoursActuel->pioche == 3) {
                $jenCoursActuel->pioche = 0;
                $jenCoursActuel->save();
                $this->miseAJourJenCours($id);
                broadcast(new ChangementDeJoueur($id))->toOthers();
            }
        }
        $jenCoursActuel = JenCours::where('id_partie', $id)->first();
        $veloo->save();
        // Retourner $jenCoursActuel
        return response()->json(['jenCoursActuel' => $jenCoursActuel], 200);
    }
    

    public function route(Request $request, $id)
{
    $user = $request->input('user');
    $nombre = $request->input('nombre');
    $jenCoursActuel = JenCours::where('id_partie', $id)->first();
    $route = Routes::where('id_partie', $id)->where('nombre', $nombre)->first();
    $jeton =  Jeton::where('id_partie', $id)->where('joueur_id', auth()->user()->id)->first();
    $point =  Point::where('id_partie', $id)->where('joueur_id', auth()->user()->id)->first();
    $valeurpoint = [[1,1],[2,2],[3,4],[4,7],[5,10],[6,15]];
    if($jenCoursActuel->joueur_id == auth()->user()->id) {
        $velosmain = Velo::where('id_partie', $id)
        ->where('joueur_id', auth()->user()->id)
        ->whereIn('couleur', [$route->couleur, 9, 8])
        ->get();

        if(count($velosmain) >= $route->longueur) {
            $valeur = 0;
            foreach ($valeurpoint as $vp) {
                $valeur = $vp[1];
                if ($vp[0] == $route->longueur) {
                    foreach ($velosmain as $velo) {
                        $velo->joueur_id = 1;
                        $velo->save();
                        
                    }
                    $route->joueur_id = auth()->user()->id;
                    $route->save();
                    $route->active = 1;
                    $route->save();
                    $jeton->nombre = $jeton->nombre - $route->longueur;
                    $jeton->save();
                    $point->points = $point->points + $valeur;
                    $point->save();      
                    if($jeton->points < 3){
                        event(new finpartie($id));
                    } else {
                        $this->miseAJourJenCours($id);
                        broadcast(new ChangementDeJoueur($id))->toOthers();
                    }      
   
                    
                }
            }
        }

    }

}

    public function finish($id) {
        $partie = Partie::find($id);
        $points = Point::where('id_partie', $id)
        ->orderBy('points', 'desc') 
        ->get();
        $isAdmin = auth()->user()->admin ?? false;
        return view('finish', [
            'points' => $points,
            'isAdmin' => $isAdmin
        ]);
    }


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
    
        $jenCoursMisAJour = JenCours::where('id_partie', $id)->first();

        return response()->json(['success' => true, 'jenCours' => $jenCoursMisAJour]);    
    }
}
