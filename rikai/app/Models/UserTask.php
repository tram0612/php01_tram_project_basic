<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserTask extends Model
{
    protected $table = 'user_task';
    protected $primaryKey='id';
   	public $timestamps = true;
    protected $fillable = [
        'user_id',
        'task_id',
        'status',
        'comment'
    ];
    public function task()
    {
        return $this->belongsTo(Task::class,'task_id');
    }
    public function user()
    {
        return $this->belongsTo(User::class,'user_id');
    }
}
