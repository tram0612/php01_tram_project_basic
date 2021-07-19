<?php

namespace App\Observers;

use App\Enums\Status;
use App\Models\UserCourse;
use App\Models\UserSubject;
use App\Models\UserTask;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\URL;

class UserCourseObserver
{
    /**
     * Handle the UserCourse "created" event.
     *
     * @param  \App\Models\UserCourse  $userCourse
     * @return void
     */
    public function created(UserCourse $userCourse)
    {
        $ids = DB::table('course_subject')
            ->select('id')
            ->where('course_id',$userCourse->course_id)
            ->get();
        foreach($ids as $id){
            UserSubject::create([
                'user_id' => $userCourse->user_id,
                'cs_id' => $id->id,
                'status' => Status::Start,
            ]); 
        }
    }
    public function findRelateddUserSubject($courseId,$userId){
        return UserSubject::withTrashed()->where('user_id',$userId)->whereHas('courseSubject' , function ($query) use ($courseId){
            $query->where('course_id',$courseId);
        })->get();
    }
    
    public function findRelateddUserTask($courseId,$userId){
        return UserTask::withTrashed()->where('user_id', $userId)
        ->whereHas('task.subject.courseSubject', function ($query) use ($courseId){
            $query->where('course_id', $courseId);
        })
        ->get();
    }
    
    public function deleting(UserCourse $userCourse)
    {
        $courseId = $userCourse->course_id;
        $userId = $userCourse->user_id;
        $userSubjects = $this->findRelateddUserSubject($courseId,$userId);
        $userTasks = $this->findRelateddUserTask($courseId,$userId);
       
        if ($userCourse->isForceDeleting()) {
            foreach($userSubjects as $userSubject){
                $userSubject->forceDelete();
            }
            foreach($userTasks as $userTask){
                $userTask->forceDelete();
            }

        }else{
            foreach($userSubjects as $userSubject){
                $userSubject->delete();
            }
            foreach($userTasks as $userTask){
                $userTask->delete();
            }
        }
    }
    
    /**
     * Handle the UserCourse "restored" event.
     *
     * @param  \App\Models\UserCourse  $userCourse
     * @return void
     */
    public function restored(UserCourse $userCourse)
    {
        $courseId = $userCourse->course_id;
        $userId = $userCourse->user_id;
        $userSubjects = $this->findRelateddUserSubject($courseId,$userId);
        $userTasks = $this->findRelateddUserTask($courseId,$userId);
        
        foreach($userSubjects as $userSubject){
            $userSubject->restore();
        }
        foreach($userTasks as $userTask){
            $userTask->restore();
        }

    }
}
