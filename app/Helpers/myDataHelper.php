<?php
use App\Models\admin\TaskComment;

function getTaskComments(){
    // TaskComment::where('admin_id', session('LoggedUser')->id);session('LoggedUser')->id
    
    $taskComments = DB::table('task_comments')
        ->join('task_assign', 'task_assign.id', '=', 'task_comments.task_assign_id')
        ->join('task_status', 'task_status.task_assign_id', '=', 'task_comments.task_assign_id')
        
        ->join('status', 'status.id', '=', 'task_status.status_id')
        
        // ->innerJoin('admins', 'admins.id', '=', 'task_assign.admin_id')
        

        ->select('task_assign.id as task_assign_id', 'task_assign.description as task_assign_description',
                'task_comments.comment as comment', 'task_comments.seen as comment_seen',
                'task_comments.seen_time as comment_seen_time', 'task_comments.type as comment_type',
                'task_comments.created_at as comment_created_at',
                // 'status.name as status_name', 'admins.image as admin_image',

                // 'admins.name as admin_name', 'task_assign.description as task_assign_description'
            )
        ->where('task_comments.admin_id', '!=', session('LoggedUser')->id)
        ->where(['task_comments.seen' => 0])
        ->orderBy('task_comments.id', 'DESC')
        
            // ->distinct()
        ->get();
        // dd($taskComments);
        
    return $taskComments;
}

function getTaskAssign(){
    $taskAssign = DB::table('task_assign')
        ->join('tasks', 'tasks.id', '=', 'task_assign.task_id')
        ->join('clients', 'clients.id', '=', 'tasks.client_id')
        ->join('admins', 'admins.id', '=', 'task_assign.admin_id')
        ->join('categories', 'categories.id', '=', 'tasks.category_id')

        ->select('task_assign.id as task_assign_id', 'task_assign.description as task_description',
                'admins.name as admin_name', 'admins.id as admin_id', 'admins.image as admin_image',
                'task_assign.created_at as task_created_at','tasks.name as task_name',
                'clients.image as client_image','clients.name as client_name'

            )
        ->where('task_assign.admin_id', session('LoggedUser')->id)
        ->where(['task_assign.seen' => 0])
        ->orderBy('task_assign.id', 'DESC')

        ->get();

    return $taskAssign;
}

function getTaskStatus($id){

    $taskStatus = DB::table('status')->where('id', $id)->first();
    return $taskStatus;
}