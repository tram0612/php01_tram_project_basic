<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
    public function userCourse()
    {
        return $this->hasMany(UserCourse::class,'course_id');
    }
    public function userSubject()
    {
        return $this->hasMany(UserSubject::class,'course_id');
    }
    public function courseSubject()
    {
        return $this->hasMany(UserTask::class,'course_id');
    }
    public function activity()
    {
        return $this->morphMany(Activity::class, 'actionable');
    }
}
