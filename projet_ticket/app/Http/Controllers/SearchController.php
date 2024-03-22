<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Friendship;
use Illuminate\Database\Eloquent\Builder; 

class SearchController extends Controller
{
    public function search(Request $request)
    {
        $query = $request->input('query');

        $informations = User::where('name', 'like', '%' . $query . '%')->get();
        $isAdmin = auth()->user()->admin ?? false;

        return view('administration', [
            'informations' => $informations,
            'isAdmin' => $isAdmin
        ]);
    }

    public function search_profile(Request $request)
    {
        $query = $request->input('query');

        $user = User::where('name', $query)->first();

        $isAdmin = auth()->user()->admin ?? false;

        return view('compte', [
            'friends' => $user,
            'isAdmin' => $isAdmin
        ]);
    }
    

    public function search_amis(Request $request, $userId)
    {
        $query = $request->input('query');
        $personne = User::findOrFail($userId);

        $amis = $personne->friends()
            ->where('name', 'like', '%' . $query . '%')
            ->get();

        $isAdmin = auth()->user()->admin ?? false;

        return view('amis', [
            'amis' => $amis,
            'isAdmin' => $isAdmin
        ]);

    }
}
