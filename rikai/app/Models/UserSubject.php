<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserSubject extends Model
{
    protected $table = 'user_subject';
    protected $primaryKey='id';
    protected $fillable = [
        'user_id',
        'course_id',
        'subject_id',
        'status'
    ];
    public function user()
    {
        return $this->belongsTo(Task::class,'user_id');
    }
    public function course()
    {
        return $this->belongsTo(User::class,'course_id');
    }
    public function subject()
    {
        return $this->belongsTo(Subject::class,'subject_id');
    }
    public static function findSubjectForUser($courseId,$userId){
        return UserSubject::where('course_id',$courseId)->where('user_id',$userId)->with('subject')->get()->toArray();
    }
}
