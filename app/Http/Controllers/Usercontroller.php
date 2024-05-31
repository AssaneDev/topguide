<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Usercontroller extends Controller
{
    //
    public function Index(){
        return view('frontend.index');
    }
}
