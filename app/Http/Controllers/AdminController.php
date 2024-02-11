<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use App\Models\User;



class AdminController extends Controller
{
    public function AdminDashboard() {      //this is a method inside the class AdminController

        return view('admin.index');   //look this file in views

    } //end method

    public function AdminLogout(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/admin/login');
    }

    public function AdminLogin() {
        return view('admin.login');   //look this file in views
    }

    public function AdminProfile() {
        
        $id = Auth::user()->id;         //access user table authenticated field
        $profileData = User::find($id);

        return view('admin.admin_profile_view',compact('profileData')); //passing through compact method
    }
}
