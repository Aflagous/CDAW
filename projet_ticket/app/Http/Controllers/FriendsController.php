<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Friendship;
use Illuminate\Database\Eloquent\Builder; 

class FriendsController extends Controller
{

    public function showFriends($userId)
    {
        $personne = User::findOrFail($userId);
        $friends = $personne->friends()->get();
        $isAdmin = auth()->user()->admin ?? false;


        return view('amis', [
            'friends' => $friends,
            'isAdmin' => $isAdmin
        ]);
    }

    public function ajouterFriends(Request $request, $userId)
    {
        $request->validate([
            'friend_name' => 'required|string', 
        ]);

        $friend = User::where('name', $request->input('friend_name'))->first();

        if ($friend) {
            auth()->user()->friends()->attach($friend->id);
            return redirect()->back();
        } else {
            return redirect()->back()->with('error', 'L\'ami avec ce nom n\'a pas été trouvé.');
        }
    }
}
