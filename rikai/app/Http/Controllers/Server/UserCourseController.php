<?php

namespace App\Http\Controllers\Server;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Subject;
use App\Models\Course;
use App\Models\User;
use App\Enums\UserRole;
use Illuminate\Support\Facades\URL;
use App\Enums\Status;
use App\Models\UserSubject;

class UserCourseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    
    public function index($courseId)
    {
        $course = $this->findCourse($courseId);
        $url = URL::current();
        $role=0;
        if (strpos($url,'traniee') !== false) {
           $role = UserRole::Trainee;
        } else if(strpos($url,'supervisor') !== false) {
            $role = UserRole::Supervisor;
        }
        else{
            return back()->with('msg', __('messages.oop!'));
        }
        $userOfCourse=$course->user()->where('role',$role)->get();
        $users = User::where('role',$role)->get()->toArray();
        foreach($userOfCourse as $userCourse) {
            
            foreach ($users as $key=> $user){
                if($userCourse->id==$user['id']){
                    unset($users[$key]);
                    break;
                }
            }
        }
        return view('server.course.user.index',compact('course','users','userOfCourse'));
        
    }
    public function addUser(Request $req)
    {
        $course = $this->findCourse($req->courseId);
        $user = User::find($req->userId);
        if( blank($course) || blank($user) ){
            return response()->json(['success' => false]);
        }
        
        $course->user()->attach($req->userId);
        $subjects = $course->subject()->get();
        foreach($subjects as $subject){
            UserSubject::create([
                'user_id' => $req->userId,
                'course_id' => $req->courseId,
                'subject_id' => $subject->id,
                'status'    => Status::Start,
            ]);
        }
       
       
        $html = view('server.course.user.userAjax')->with(compact('user','req'))->render(); 
        return response()->json(['success' => true, 'html' => $html]);
    }
    public function destroy($courseId,$userId)
    {
        $course = $this->findCourse($courseId);
        $del=$course->user()->detach($userId);
        if($del){
            return back()->with('msg', __('messages.delete.success'));
        }else{
            return back()->with('msg', __('messages.delete.fail'));
        }
    }
}
