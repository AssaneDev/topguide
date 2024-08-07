<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;

class LocalController extends Controller
{
    //
    public function setLocal($lang){
        if (in_array($lang,['en','es','fr'])) {
            App::setLocale($lang);
            Session::put('local',$lang);
        }
    }

    public function Ang(){
        App::setLocale('en');
        Session::put('local','en');
       return redirect()->back();
    }

    public function Fr(){
        App::setLocale('fr');
        Session::put('local','fr');
       return redirect()->back();
    }

    public function Es(){
        App::setLocale('es');
        Session::put('local','es');
       return redirect()->back();
    }
}
