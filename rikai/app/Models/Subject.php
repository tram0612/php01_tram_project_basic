<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    use HasFactory;
    protected $table = 'subject';
    protected $primaryKey='id';
   	public $timestamps = false;
    protected $fillable = [
        'name',
        'img',
        'finish',
        'detail'
    ];
    public function courseSubject()
    {
        return $this->hasMany(CourseSubject::class,'subject_id');
    }
    public function userSubject()
    {
        return $this->hasMany(UserSubject::class,'subject_id');
    }
    public function task()
    {
        return $this->hasMany(Task::class,'subject_id');
    }
    public function activity()
    {
        return $this->morphMany(Activity::class, 'actionable');
    }
}
