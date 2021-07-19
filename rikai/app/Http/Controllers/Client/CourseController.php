<?php

namespace App\Http\Controllers\Client;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\Task;
use App\Enums\UserRole;
use App\Enums\Status;
use App\Models\UserCourse;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    
    public function index()
    {
        $user = $this->findUser(Auth::id());
        
        $courses = UserCourse::where('user_id',Auth::id())->with('course')->paginate(3);
        
        return view('client.course.index',compact('courses'));
    }

    public function dashboard()
    {
        $user = $this->findUser(Auth::id());
        $unfinishedCourses = UserCourse::where('user_id',Auth::id())->where('status',Status::Start)->get();
        $doneCourses = UserCourse::where('user_id',Auth::id())->where('status',Status::Finish)->get();
        return view('client.index',compact('unfinishedCourses','doneCourses'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $course = $this->findCourse($id);
        $members =  $course->user()->where('role',UserRole::Trainee)->get();
        $subjects = Course::findSubjectforUserInCourse($id,Auth::id());
        $ids = array();
        foreach($course->subject as $subject){
            $ids[] = $subject->id;
        }
        $tasks = Task::with(['userTask' => function ($query) {
                        $query->where('user_id', Auth::id())->where('status',Status::Finish);
                    }])->whereIn('subject_id',$ids)->get();
        return view('client.course.detail',compact('course','members','subjects','tasks'));
    }
}
