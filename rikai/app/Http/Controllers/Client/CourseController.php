<?php

namespace App\Http\Controllers\Client;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Subject;
use App\Models\UserSubject;
use App\Models\UserTask;
use App\Models\Course;
use App\Models\Task;
use App\Models\User;
use App\Enums\UserRole;
use App\Enums\Status;
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
        
        $courses = $user->course()->paginate(5);
         
        return view('client.course.index',compact('courses'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        $subjects = UserSubject::where('course_id',$id)->where('user_id',Auth::id())->with('subject')->get()->toArray();
        $ids = array();
        foreach($subjects as $subject){
            $ids[] = $subject['subject']['id'];
        }
        $tasks = Task::with(['userTask' => function ($query) {
                        $query->where('user_id', Auth::id())->where('status',Status::Finish);
                    }])->whereIn('subject_id',$ids)->get();
        return view('client.course.detail',compact('course','members','subjects','tasks'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
