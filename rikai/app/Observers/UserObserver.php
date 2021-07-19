<?php

namespace App\Observers;

use App\Models\User;
use App\Models\UserCourse;

class UserObserver
{
    public function findRelatedUserCourse($userId){
        return UserCourse::withTrashed()->where('user_id',$userId)->get();
    }
    public function deleting(User $user)
    {
        $userCourses = $this->findRelatedUserCourse($user->id);
        if ($user->isForceDeleting()) {
            foreach($userCourses as $userCourse){
                $userCourse->forceDelete();
            }
        }else{
            foreach($userCourses as $userCourse){
                $userCourse->delete();
            }
        }
    }

    public function restored(User $user)
    {
        $userCourses = $this->findRelatedUserCourse($user->id);
        foreach($userCourses as $userCourse){
            $userCourse->restore();
        }
    }

}
