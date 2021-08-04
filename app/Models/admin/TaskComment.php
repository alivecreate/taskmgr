<?php

namespace App\Models\admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TaskComment extends Model
{
    protected $table = 'task_comments';
    use HasFactory;
    
    function taskAssign(){
        return $this->belongsTo(TaskAssign::class);
    }
    
    
    function taskStatus($id){
        
        $taskStatus2 = Status::find($id);

        return $taskStatus2;
    }
}
