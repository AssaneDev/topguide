<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    //
     public function Index()
    {
        return view('frontend.index'); // ou une autre vue selon ton projet
    }
}
