<?php

namespace App\Http\Controllers\Server;

use App\Http\Controllers\Controller;
use App\Models\Subject;
use App\Models\UserTask;
use Illuminate\Http\Request;

class UserTaskController extends Controller
{
    public function index($courseId,$subjectId,$userId){
        $course = $this->findCourse($courseId);
        $user = $this->findUser($userId);
        $subject =$this->findSubject($subjectId);
        $tasks = $subject->task()->with(['userTask' => function ($query) use($userId) {
            $query->where('user_id', $userId);
        }])->get();
        
        return view('server.course.user.task',compact('tasks','course','user','subject'));
    }
}
