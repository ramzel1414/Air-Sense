<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PollutantController extends Controller
{
    
    public function showPollutant() {      

        return view('user.pollutants');   

    }
}
