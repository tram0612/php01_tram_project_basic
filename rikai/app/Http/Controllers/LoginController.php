<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use App\Enums\UserRole;

class LoginController extends Controller
{
	public function getLogin(){
		return view('login');
	}
    public function postLogin(LoginRequest $req){
    	if (Auth::attempt(
    		['email' => $req->email, 
    		'password' => $req->password])) {
            
    		if(Auth::user()->role==UserRole::Supervisor){
                //dd(UserRole::toArray());
    			return redirect()->route('server.index');
    		}else{
    			return redirect()->route('index');
    		}
    		
		}
    	else{
    		return Redirect::back()->with('msg',__('mesages.login.fail'));
    	}
    }
    public function logout(){
    	Auth::logout();
    	return redirect()->route('signin');
    }
    public function profile(){
        return view('server.user.profile');
    }
}
