<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
class LoginController extends Controller
{
	public function getLogin(){
		return view('login');
	}
    public function postLogin(LoginRequest $req){
    	if (Auth::attempt(
    		['email' => $req->email, 
    		'password' => $req->password])) {
    		if(Auth::user()->role==1){
    			return redirect()->route('server.index');
    		}else{
    			return redirect()->route('client.index');
    		}
    		
		}
    	else{
    		return Redirect::back()->with('msg','Email or password is uncorrect .');
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
