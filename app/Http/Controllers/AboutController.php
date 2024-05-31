<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AboutController extends Controller
{
    public function Apropos(){
        return view('frontend.apropos.about_page');
    }
    //
}
