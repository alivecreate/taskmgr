<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\admin\Admin;
use Illuminate\Support\Facades\Hash;


class AdminAuthController extends Controller
{
    //
    
    public function login(){
        return view('adm.login');
    }
    
    public function register(){
        return view('adm.register');
    }

    public function save(Request $request){
        // return $request->input();

        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:admins',
            'password' => 'required|min:5|max:12',
        ]);

        $admin = new Admin;
        $admin->name = $request->name;
        $admin-> email = $request-> email;

        $admin->password = Hash::make($request->password);

        $save = $admin->save();
        if($save){
            return back()->with('success', 'New User has been added to database.');
        }else{
            return back()->with('fail', 'Something went wrong, try again later...');
        }
    }


    function check (Request $request){
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:5|max:15'
        ]);
        // return $request->input();
        $userInfo = Admin::where('email', '=', $request->input('email'))->first();
            
        if(!$userInfo){
            return back()->with('fail', 'We do not recognized your email.');
        }else{
            if(Hash::check($request->password, $userInfo->password)){
                $request->session()->put('LoggedUser', $userInfo);
                return redirect(route('admin.index'));
            }else{
                return back()->with('fail', 'Incorrectt Passord');
            }
        }
    }

    function logout(){
        if(session()->has('LoggedUser')){
            session()->pull('LoggedUser');
            return redirect(route('admin.login'));
        }
    }

    function dashboard(){
        $data = ['LoggedUserInfo' =>  Admin::where('id', '=', session('LoggedUser'))->first()];
        return view('adm.index', $data);
    }

    public static function AdminAuth(){
        return $data = ['LoggedUserInfo' =>  Admin::where('id', '=', session('LoggedUser'))->first()];
    }



}
