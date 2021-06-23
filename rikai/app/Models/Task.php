<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;
    protected $table = 'task';
    protected $primaryKey='id';
   	public $timestamps = false;
    protected $fillable = [
        'name',
        'subject_id',
        'detail',
        'position'
    ];
    public function userTask()
    {
        return $this->hasMany(UserTask::class,'task_id');
    }
    public function subject()
    {
        return $this->belongsTo(Subject::class,'subject_id');
    }
    
}
