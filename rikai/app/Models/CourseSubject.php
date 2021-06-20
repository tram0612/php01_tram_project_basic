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
}
