<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
   	protected $table = 'activity';
    protected $primaryKey='id';
   	public $timestamps = true;
    protected $fillable = [
        'user_id',
        'action_type',
        'action_id',
        'action'
    ];
    public function user()
    {
    	return $this->belongsTo(User::class,'user_id');
    }
    public function actionable()
    {
        return $this->morphTo();
    }
}
