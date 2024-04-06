<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

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

    public function UserProfile() {
        
        $id = Auth::user()->id;         //access user table authenticated field
        $profileData = User::find($id);

        return view('user.user_profile_view',compact('profileData')); //passing through compact method
    }

    public function UserProfileStore(Request $request) {  //post request to update profile

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


    public function UserChangePassword() {
        
        $id = Auth::user()->id;         //access user table authenticated field
        $profileData = User::find($id);

        return view('user.user_change_password',compact('profileData')); //passing through compact method
    }

    public function UserUpdatePassword(Request $request) { //Every time handling post method, (param request)

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
