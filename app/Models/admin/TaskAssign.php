<?php

namespace App\Models\admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TaskAssign extends Model
{
    protected $table = 'task_assign';
    
    use HasFactory;

    function status(){
        return $this->belongsTo(Status::class);
    }
    function taskStatus($id){
        
        $taskStatus = TaskStatus::where('task_assign_id', $id)->first();
        if($taskStatus){
            $taskStatus = Status::find($taskStatus->status_id);
            return $taskStatus;
        }else{
            return Status::find(1);
        }
    }


    function getParent($id){
        $task = Task::withTrashed()->find($id);
        
        $kacheri = Category::find($task->category_id);

        if($kacheri->parent_id == 0){
            // dd(['kacheri'=>$kacheri, 'petaKacheri' => null, 'department' => null]);
            
            return (['kacheri'=>$kacheri, 'petaKacheri' => null, 'department' => null]);
        }
        else{
            $petaKacheri = Category::find($kacheri->parent_id);
            if($petaKacheri->parent_id == 0){
                
            // dd(['kacheri'=>$petaKacheri, 'petaKacheri' => $kacheri, 'department' => null]);
                return (['kacheri'=>$petaKacheri, 'petaKacheri' => $kacheri, 'department' => null]);
            }else{
                $department = Category::find($petaKacheri->parent_id);
               
                return(['kacheri'=>$department, 'petaKacheri' => $petaKacheri, 'department' => $kacheri]);

            }
        }
        
    }
    function task($id){
        $task = Task::withTrashed()->find($id);
        // return dd($task);
        return $task;
    }
    function getTask($id){
        $task = Task::withTrashed()->find($id);
        // return dd($task);
        return $task;
    }

    function employee($id){
        $employee = Admin::find($id);
        // return dd($employee);
        return $employee;
    }

    function getEmployee($id){
        $employee = Admin::find($id);
        // dd($task);
        return $employee;
    }

    
    function getClient($id){
        $task = Task::withTrashed()->find($id);
        // dd($task);
        $client = Client::find($task->client_id);
        return $client;
    }
    
    function getCategory($id){
        $task = Task::find($id);
        // dd($task);
        $category = Category::find($task->category_id);
        return $category;
    }
    
    function getCategory2($id){
        $task = Task::find($id);
        $category = Category::find($task->category_id);
        if($category->parent_id !== 0){

            $category2 = Category::find($category->parent_id);
            return $category2;
        }else{            
            return $category;
        }

    }

    function getCategory3($id){
        $task = Task::find($id);
        $category = Category::find($task->category_id);
        $category2 = Category::find($category->parent_id);
        $category3 = Category::find($category2->parent_id);
        // dd($category2);
        return $category3;
    }

    function getComments($id){
        $taskComments = TaskComment::where('task_assign_id',$id)->get();
        // dd($taskComments);
        return $taskComments;
    }
    
    function getCommentUser($id){

        $commentUser = Admin::find($id);

        // print_r($commentUser->name);
        return $commentUser;
    }
    
    
    
}
