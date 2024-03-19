<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User; 

class AdminController extends Controller
{
    public function home()
    {
        $isAdmin = auth()->user()->admin ?? false;
        return view('dashboard')->with('isAdmin', $isAdmin);
    }
    public function classement()
    {
        $isAdmin = auth()->user()->admin ?? false;
        return view('ranking')->with('isAdmin', $isAdmin);
    }
    public function amis()
    {
        $isAdmin = auth()->user()->admin ?? false;
        return view('amis')->with('isAdmin', $isAdmin);
    }
    public function administration()
    {
        $userId = auth()->user()->id;

        $informations = User::where('id', '!=', $userId)->get();   
        $isAdmin = auth()->user()->admin ?? false;

        return view('administration', [
            'informations' => $informations,
            'isAdmin' => $isAdmin
        ]);
    }
    public function parties()
    {
        $isAdmin = auth()->user()->admin ?? false;
        return view('parties')->with('isAdmin', $isAdmin);
    }
    public function profile()
    {
        $isAdmin = auth()->user()->admin ?? false;
        return view('compte')->with('isAdmin', $isAdmin);
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
