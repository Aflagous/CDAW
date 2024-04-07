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
            'amis' => $friends,
            'isAdmin' => $isAdmin,
            'userId' => $userId
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
            return redirect()->back();
        }
    }

    public function retirerFriends($Id, $userId)
    {
        $personne = User::findOrFail($Id);
        $user = User::findOrFail($userId);

        $relation = Friendship::where('user_id', '=', $userId)
                                ->where('friend_id', '=', $Id)
                                ->delete();

        
        return redirect()->back();
    }

}
