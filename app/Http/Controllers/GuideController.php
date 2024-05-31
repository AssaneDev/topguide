<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GuideController extends Controller
{
    public function GuideDashboard(){
        return view('guide.guide_dashboard');
    }
}
