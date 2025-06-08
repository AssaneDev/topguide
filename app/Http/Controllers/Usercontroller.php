<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\VoyageModel;


class Usercontroller extends Controller
{
    //
       
    public function Index(){
         $voyage = VoyageModel::latest()->get();
        return view('frontend.index',compact('voyage'));
    }
}
