<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Events\MessageEvent;
use App\Models\User;
use App\Models\Friendship;
use Illuminate\Database\Eloquent\Builder; 

class MessageController extends Controller
{
    public function test() {
        $event = new MessageEvent();
        event($event);


        return view('message');
    }
}
