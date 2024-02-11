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

    public function AdminProfileStore(Request $request) {  //post request to update profile

        $id = Auth::user()->id;         //access user table authenticated field
        $data = User::find($id);
        $data->username = $request->username;   //the user input is stored in database
        $data->name = $request->name;
        $data->email = $request->email;
        $data->phone = $request->phone;
        $data->address = $request->address;

        if($request->file('photo')) {
            $file = $request->file('photo');
            $filename = date('YmdHi').$file->getClientOriginalName(); //to avoid similar photo conflict
            $file->move(public_path('upload/admin_images'),$filename);
            $data['photo'] = $filename;
        }
        $data->save();

        return redirect()->back();
    }
}
