<?php

namespace App\Http\Controllers;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function UserDashboard() {     

        return view('user.index');   //look for this file in views

    } 

    public function UserManagement() {      

        return view('user.management');   

    }


    public function UserLocation() {      

        return view('user.location');   

    } 
    
    public function UserSettings() {    

        return view('user.settings');   

    } 

    public function UserLogout(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        // return redirect('/admin/login');     //commented because we are using the same loginpage for users and admin's, after logout they will be redirected to that page

        // return redirect('/login');
        return redirect('/');                   //redirected to welcome page

    }
}
