<?php

namespace App\Http\Controllers;

use App\Models\Sitelogo;
use Illuminate\Http\Request;

class PublicController extends Controller
{
    public function index(){
    $logo = Sitelogo::orderBy('id', 'asc')->first(); // Ensure it gets the first logo by ID
    return view('welcome', compact('logo'));   //look for this file in views
    }

    public function about(){
    $logo = Sitelogo::orderBy('id', 'asc')->first(); // Ensure it gets the first logo by ID
    return view('about', compact('logo'));   //look for this file in views
    }

    public function location(){
    $logo = Sitelogo::orderBy('id', 'asc')->first(); // Ensure it gets the first logo by ID
    return view('location', compact('logo'));   //look for this file in views
    }
}
