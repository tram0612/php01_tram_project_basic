<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CourseSubject extends Model
{
    protected $table = 'course_subject';
    protected $primaryKey='id';
    protected $fillable = [
        'course_id',
        'subject_id',
        'status',
        'started_at',
        'days'
    ];
    public function course()
    {
        return $this->belongsTo(Course::class,'course_id');
    }
    public function subject()
    {
        return $this->belongsTo(Subject::class,'subject_id');
    }
    public static function updateStatus($courseId,$subjectId){
        $subject = CourseSubject::where('course_id',$courseId)->where('subject_id',$subjectId)->first();
        if($subject->status==Status::Start){
            $subject->status = Status::Finish;
            
        }
        else{
           $subject->status = Status::Start; 
        }
        $subject->save();
        return $subject;
    }
    public static function sortSubject($req){
        $arr = explode(',', $req->ids);
        for($i=0; $i<count($arr); $i++){
            CourseSubject::where('course_id',$req->courseId)
                        ->where('subject_id',$arr[$i])
                        ->update(['position'=>$i]);
        }
    }
}
