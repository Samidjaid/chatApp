<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth as FacadesAuth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use Symfony\Component\Translation\Catalogue\TargetOperation;

class Auth extends Controller
{
    function login(){
        return view('login');
    }

    function register(){
        return view('registration');
    }

    function loginPost(Request $request){
        $request -> validate([
            'email' => 'required',
            'password' => 'required'
        ]);

        $credentials = $request->only('email','password');
        if(FacadesAuth::attempt($credentials)){
            return redirect(route('home'));
        }

        return redirect(route('login'))->with("error","login details are not valid");

    }

    function registerPost(Request $request){

        $request -> validate([
            'firstname' => 'required',
            'lastname' => 'required',
            'email' => 'required',
            'password' => 'required',
            'avatar' => 'image|mimes:jpeg,png,jpg,gif',
        ]);

        $data['firstname'] = $request->firstname;
        $data['lastname'] = $request->lastname;
        $data['email'] = $request->email;
        $data['password'] = Hash::make($request->password);


        if ($request->hasFile('avatar')) {
            $avatar = $request->file('avatar');
            $avatarName = Str::random(20) . '.' . $avatar->getClientOriginalExtension();
            $avatar->storeAs('public/avatars', $avatarName); 
            $data['avatar'] = $avatarName;
        }

        $user = User::create($data);
        if(!$user){
            return redirect(route('registration'))->with("error","Registration failed");
        }

        return redirect(route('login'))->with("succeSS","Registration success");   

    }

    function logout(){
        Session::flush();
        FacadesAuth::logout();
        return redirect(route('login'));
    }
}
