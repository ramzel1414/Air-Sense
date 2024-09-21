<?php

namespace App\Http\Controllers;

use App\Models\Sitelogo;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;



class AdminController extends Controller
{
    public function AdminDashboard() {      //this is a method inside the class AdminController

        $logo = Sitelogo::orderBy('id', 'asc')->first(); // Ensure it gets the first logo by ID
        return view('admin.index', compact('logo'));   //look for this file in views

    }

    public function AdminManagement() {

        $logo = Sitelogo::orderBy('id', 'asc')->first(); // Ensure it gets the first logo by ID
        return view('admin.admin_management', compact('logo'));

    }

    public function AdminLocation() {
        $logo = Sitelogo::orderBy('id', 'asc')->first(); // Ensure it gets the first logo by ID
        return view('admin.admin_location', compact('logo'));

    }

    public function AdminAbout() {
        $logo = Sitelogo::orderBy('id', 'asc')->first(); // Ensure it gets the first logo by ID
        return view('admin.admin_about', compact('logo'));

    }

    // public function AdminSettings() {
    //     $logo = Sitelogo::find(1); // Ensure it gets the first logo by ID
    //     return view('admin.admin_settings', compact('logo'));
    // }

    public function AdminLogout(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        // return redirect('/admin/login');     //commented because we are using the same loginpage for users and admin's, after logout they will be redirected to that page

        // return redirect('/login');
        return redirect('/');

    }

    public function AdminLogin() {
        return view('admin.login');   //look this file in views
    }

    public function AdminProfile() {

        $id = Auth::user()->id;         //access user table authenticated field
        $profileData = User::find($id);
        $logo = Sitelogo::orderBy('id', 'asc')->first(); // Ensure it gets the first logo by ID

        return view('admin.admin_profile_view',compact('profileData', 'logo')); //passing through compact method
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
            @unlink(public_path('upload/admin_images/'.$data->photo));  //replace previous admin image
            $filename = date('YmdHi').$file->getClientOriginalName(); //to avoid similar photo conflict
            $file->move(public_path('upload/admin_images'),$filename);
            $data['photo'] = $filename;
        }
        $data->save();

        $notification = array ( //toaster notif when updated
            'message' => 'Admin Profile Updated Successfully',
            'alert-type' => 'success',
        );

        return redirect()->back()->with($notification);
    }


    public function AdminChangePassword() {

        $id = Auth::user()->id;         //access user table authenticated field
        $profileData = User::find($id);

        return view('admin.admin_change_password',compact('profileData')); //passing through compact method
    }

    public function AdminUpdatePassword(Request $request) { //Every time handling post method, (param request)

        $request->validate([
            'old_password' => 'required',
            'new_password' => 'required|confirmed',

        ]);

        // match the old password
        if(!Hash::check($request->old_password, auth::user()->password)) {
        $notification = array ( //toaster notif when updated
            'message' => 'Old Password Does not Match!',
            'alert-type' => 'error',
        );

        return back()->with($notification);

        }

        //update the new password
        User::whereId(auth()->user()->id)->update([
            'password' => Hash::make($request->new_password)
        ]);

        $notification = array ( //toaster notif when updated
            'message' => 'Password Changed Successfully!',
            'alert-type' => 'success',
        );

        return back()->with($notification);
    }
}
