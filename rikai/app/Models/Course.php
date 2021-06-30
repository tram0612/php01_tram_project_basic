<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Subject;
class Course extends Model
{
    use HasFactory;
    protected $table = 'course';
    protected $primaryKey='id';
    public $timestamps = true;
    protected $fillable = [
        'name',
        'img',
        'finish',
        'detail',
        'instruction'
    ];

    public function subject()
    {
        return $this->belongstoMany(Subject::class, 'course_subject', 'course_id', 'subject_id')->withPivot('status','started_at','position') ->orderBy('pivot_position');
    }
    public function user()
    {
        return $this->belongstoMany(User::class, 'user_course','course_id','user_id')->withPivot('status');
    }
    public function userCourse()
    {
        return $this->hasMany(UserCourse::class,'course_id');
    }
    public function userSubject()
    {
        return $this->hasMany(UserSubject::class);
    }
    public function courseSubject()
    {
        return $this->hasMany(UserTask::class,'course_id');
    }
    public function activity()
    {
        return $this->morphMany(Activity::class, 'actionable');
    }
    public static function index(){
        return Course::select(['id', 'name','img','finish'])->paginate(5);
    }
}
