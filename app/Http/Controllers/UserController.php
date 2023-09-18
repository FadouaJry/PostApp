<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegisterRequest;

class UserController extends Controller
{
    public function register(){
      return view('users.register');
    }
    public function registerAction(RegisterRequest $request){
        $request->validated();
        $user = $request->all();
        $user['password'] = Hash::make($request->password);
        User::create($user);
      return  to_route('index');
        
    }
    public function login(){
        return view('users.login');
    }
    public function loginAction(LoginRequest $request){
      $request->validated();
       $login = $request->all();
        if (Auth::attempt(['email' => $login['email'], 'password' => $login['password']])) {
            $request->session()->regenerate();
            return  to_route('index');
        }
        return  redirect()->back();
    }
    public function logout(Request $request){
        $request->session()->flush();
        Auth::logout();
        return to_route('login.create');
    }
}
