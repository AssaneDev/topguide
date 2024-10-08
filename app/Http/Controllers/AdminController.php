<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    //
    public function AdminDashboard(){
        return view('admin.index');
    }

  
    public function AdminLogout(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('admin/login');
    }


    public function AdminLogin(){
        return view('admin.admin_login');
    }

    public function AdminProfile(){

        $id = Auth::user()->id; 
        $profileData=User::find($id);
        return view('admin.admin_profile_view',compact('profileData'));

    }
    public function AdminProfileStore(Request $request) {
        $id = Auth::user()->id;
        $data = User::find($id);

        $data->name = $request->name;
        $data->email = $request->email;
        $data->phone = $request->phone;
        $data->address = $request->adresse;


        if($request->file('photo')){
            $file = $request->file('photo');
            @unlink(public_path('upload/admin_images/'.$data->photo));
            $filename = date('ymdHi').$file->getClientOriginalName();
            $file->move(public_path('upload/admin_images'),$filename);
            $data['photo'] =  $filename;

        }
        $data->save();
        $notification = array(
            'message'=>'Profile modifier avec succes',
            'type'=>'success'
        );
        return redirect()->back()->with($notification);
        
    }

    public function AdminChangePassword(){
        $id = Auth::user()->id;
        $profileData = User::find($id);
        return view('admin.admin_change_password',compact('profileData'));
    }
    public function AdminPasswordUpdate(Request $request){
        //validation
        $request->validate([
            'old_password' => 'required',
            'new_password' => 'required|confirmed'
        ]);

        if(!Hash::check($request->old_password, auth::user()->password)){
            $notification = array(
                'message'=>'le motdepass Actuel est incorect',
                'type'=>'error'
            );
            return redirect()->back()->with($notification);
        }


        //Mise a jour du nouveau mot de pass
        User::whereId(auth::user()->id)->update([
            'password'=>Hash::make($request->new_password)
        ]);
        $notification = array(
            'message'=>'Motdepass Changer avec succés',
            'type'=>'success'
        );
        return redirect()->back()->with($notification);



    }
}
