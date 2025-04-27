<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Validator as ValidationValidator;

class AuthController extends Controller
{
    public function register(){
        return view('authentication.register');
    }

    public function createUser(Request $request)
    {
        // make push
        $validate  =  Validator::make($request -> all(),
            [
                'name' => 'required|max:20',
                'email' => 'required|email|unique:users,email',
                'password' => 'required|min:8|max:20',
                'profile' => [
                    'required',
                    'mimes:jpg,jpeg,png',
                    'max:1000'
                ]
            ]
        );

        if($validate->fails()){
            return redirect()->back()->withErrors($validate);
        }

        $image = $request -> file('profile');
        $filename = time() .'-'. $image->getClientOriginalName();
        $destination = './image';

        if(!file_exists($destination)){
            mkdir('./image',0777,1);
        }

        $image->move($destination, $filename);

        $result = DB::table('users')->insert([
            'name' => $request->name,
            'email' => $request->email,
            'email_verified_at' => now(),
            'password' => Hash::make($request->password),
            'profile' => $filename
        ]);

        if($result){
            return redirect()->route('login')->with('success','User Register Success');
        }
        
    }

    public function login(){
        return view('authentication.login');
    }

    public function submitLogin(Request $request){
        $name_email = $request -> name_email;
        $password   = $request -> password;

        if(Auth::attempt(['name' => $name_email,'password' => $password])){
            return redirect('/')->with('success','Login Success');
        }
        elseif (Auth::attempt(['email' => $name_email, 'password' => $password])){
            return redirect('/')->with('success','Login Success');
        }
        else{
            return redirect()->back()->with('error', 'Login Failed');
        }
    }

    public function logout(){
        return view('dashboard.logout');
    }

    public function submitLogout(){
        
        Auth::logout();

        return redirect()->route('login')->with('success','Logout Success');
    }
    
}   