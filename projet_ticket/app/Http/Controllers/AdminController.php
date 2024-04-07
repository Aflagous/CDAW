<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User; 

class AdminController extends Controller
{
    public function home()
{
    if (auth()->check()) {
        // L'utilisateur est connecté
        $isAdmin = auth()->user()->admin ?? false;
        $personne = User::findOrFail(auth()->user()->id);
        $amis = $personne->friends()->get();

        return view('dashboard', [
            'amis' => $amis,
            'isAdmin' => $isAdmin
        ]);
    } else {
        return view('dashboard');
    }
}


    public function classement()
    {
        $isAdmin = auth()->user()->admin ?? false;
        $personne = User::findOrFail(auth()->user()->id);
        $friends = $personne->friends()->get();


        return view('ranking', [
            'amis' => $friends,
            'isAdmin' => $isAdmin
        ]);
    }
    public function amis()
    {

        $isAdmin = auth()->user()->admin ?? false;
        $personne = User::findOrFail(auth()->user()->id);
        $amis = $personne->friends()->get();


        return view('amis', [
            'amis' => $amis,
            'isAdmin' => $isAdmin
        ]);
    }
    public function administration()
    {
        $userId = auth()->user()->id;

        $informations = User::where('id', '!=', auth()->user()->id)->get();   
        $isAdmin = auth()->user()->admin ?? false;
        $personne = User::findOrFail(auth()->user()->id);
        $amis = $personne->friends()->get();


        return view('administration', [
            'amis' => $amis,
            'informations' => $informations,
            'isAdmin' => $isAdmin
        ]);
    }
    public function parties()
    {
        $isAdmin = auth()->user()->admin ?? false;
        $personne = User::findOrFail(auth()->user()->id);
        $amis = $personne->friends()->get();


        return view('partie', [
            'amis' => $amis,
            'isAdmin' => $isAdmin
        ]);
    }
    public function profile()
    {
        $isAdmin = auth()->user()->admin ?? false;
        $user = auth()->user();
        $personne = User::findOrFail($user->id);
        $friends = $personne->friends()->get();

        return view('compte', [
            'friends' => $user,
            'amis' => $friends,
            'isAdmin' => $isAdmin
        ]);
    }

    public function changeAdmin($id)
    {
        $personne = User::findOrFail($id);
        $personne->admin = !$personne->admin;
        $personne->save();
        return redirect()->back();
    }

    public function changeBloque($id)
    {
        $personne = User::findOrFail($id);
        $personne->blocked = !$personne->blocked;
        $personne->save();
        return redirect()->back();
    }
}
