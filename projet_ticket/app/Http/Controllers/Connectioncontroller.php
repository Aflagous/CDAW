<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Connectioncontroller extends Controller
{
     public function register()
    {
        return view('auth.register');

    }

}
