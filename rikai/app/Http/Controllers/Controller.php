<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use App\Models\User;
use App\Models\Course;
use Illuminate\Support\Facades\Redirect;
class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function findUser($id){

        $user = User::find($id);
        if(blank($user)){
            abort(redirect()->back()->with('msg', __('messages.oop!')));
        } 
        else{
            return $user; 
        }
    }
    public function findCourse($id){

        $course = Course::find($id);
        if(blank($course)){
            abort(redirect()->back()->with('msg', __('messages.oop!')));
        } 
        else{
            return $course; 
        }
    }
}
