<?php
use App\Models\admin\TaskComment;
use App\Models\admin\Admin;
use App\Models\admin\Task;
use App\Models\admin\Category;
use App\Models\admin\Client;

use Illuminate\Support\Facades\Mail;

function getAdminData($id){
    // dd($id);

        return Admin::where('id', '=', session('LoggedUser')->id)->first();
        
        // return Admin::find($id)->first();
}

function sendMailNotification($type, $to, $title, $data = []){
    
$user['to'] = $to;

switch ($type) {
    case 'comment':
        $user['subject']  = $data['name'].' Comment:- '.$data['msg'];
        break;
    
    default:
        $user['subject']  = $data['name'].' Comment:- '.$data['msg'];
        break;
}

try {
    // dd(['user' => $user, 'data' => $data]);
    
    Mail::send('mail/send-notification', $data, function($message) use ($user){
        $message->to($user['to']);
        $message->subject($user['subject']);
    });

} catch (\Throwable $th) {
    throw $th;
}

}

function getCommentData($id){
    $taskComments = DB::table('task_comments')
    ->join('task_assign', 'task_assign.id', '=', 'task_comments.task_assign_id')
    ->join('tasks', 'tasks.id', '=', 'task_assign.task_id')
    ->join('clients', 'clients.id', '=', 'tasks.client_id')
    ->join('task_status', 'task_status.task_assign_id', '=', 'task_comments.task_assign_id')
    
    ->join('status', 'status.id', '=', 'task_status.status_id')
    
    ->join('admins', 'admins.id', '=', 'task_assign.admin_id')
    

    ->select('task_assign.id as task_assign_id', 'task_assign.description as task_assign_description',
            'task_comments.comment as comment', 'task_comments.seen as comment_seen',
            'task_comments.seen_time as comment_seen_time', 'task_comments.type as comment_type',
            'task_comments.created_at as comment_created_at',

            'status.name as status_name', 'tasks.name as task_name', 'clients.name as client_name',
            'clients.image as client_image',
            'task_assign.created_at as task_created_at',
            'task_comments.admin_id as task_admin_id',
            'task_assign.admin_id as employee_id',

            'admins.image as admin_image','admins.email as admin_email',
        )
    ->where( ['task_comments.id' => $id])

    ->first();
    
    
return $taskComments;
}

function getLastComment($id){
    $taskComments = DB::table('task_comments')
    ->join('task_assign', 'task_assign.id', '=', 'task_comments.task_assign_id')
    ->join('tasks', 'tasks.id', '=', 'task_assign.task_id')
    ->join('clients', 'clients.id', '=', 'tasks.client_id')
    

    ->select('task_assign.id as task_assign_id', 'task_assign.description as task_assign_description',
            'task_comments.comment as comment', 'task_comments.seen as comment_seen',
            'task_comments.seen_time as comment_seen_time', 'task_comments.type as comment_type',
            'task_comments.created_at as comment_created_at',
            'tasks.name as task_name', 'clients.name as client_name',
            'clients.image as client_image',
            'task_assign.created_at as task_created_at',


            'task_comments.admin_id as task_admin_id',
            'task_assign.admin_id as employee_id',

        )
    ->where( ['task_comments.id' => $id])
    ->first();

return $taskComments;
}

function getAdminGroupData($userId){

    
    return DB::table('admins')->whereRaw('FIND_IN_SET("'.$userId.'",id)')->get();
}

function getEmployee($id){
    $employee = Admin::find($id);
    return $employee;
}

function getClient($id){
    $task = Task::find($id);
    // dd($task);
    $client = Client::find($task->client_id);
    return $client;
}

function getNotificationsOld(){
    $taskComments = DB::table('task_comments')
    ->join('task_assign', 'task_assign.id', '=', 'task_comments.task_assign_id')
    ->join('tasks', 'tasks.id', '=', 'task_assign.task_id')
    ->join('clients', 'clients.id', '=', 'tasks.client_id')
    ->join('task_status', 'task_status.task_assign_id', '=', 'task_comments.task_assign_id')
    
    ->join('status', 'status.id', '=', 'task_status.status_id')
    
    ->join('admins', 'admins.id', '=', 'task_comments.admin_id')
    

    ->select('task_assign.id as task_assign_id', 'task_assign.description as task_assign_description',
            'task_comments.comment as comment', 'task_comments.seen as comment_seen',
            'task_comments.seen_time as comment_seen_time', 'task_comments.type as comment_type',
            'task_comments.created_at as comment_created_at',

            'status.name as status_name', 'tasks.name as task_name', 'clients.name as client_name',
            'clients.image as client_image',
            'task_assign.created_at as task_created_at',
            'task_comments.admin_id as task_admin_id',
            'task_assign.admin_id as employee_id',

            'admins.image as admin_image',

        )

    ->where('task_comments.admin_id', '=', session('LoggedUser')->id)
    // ->where([ 'task_comments.type' => 'new_task'])
    ->where(['task_comments.seen' => 0])
    ->whereIn('task_comments.type', ['task_comments.type','new_task'])
    ->where(['task_assign.admin_id' => session('LoggedUser')->id])

    ->orderBy('task_comments.id', 'DESC')
    
    
    ->get();
    // dd($taskComments);
return $taskComments;
}


function getNotifications($userId){
    // dd(session('LoggedUser'));
    // $taskComments = DB::table('task_comments')


    // return $taskComments;


            $taskComments = DB::table('task_comments')
            ->join('task_assign', 'task_assign.id', '=', 'task_comments.task_assign_id')
            ->join('tasks', 'tasks.id', '=', 'task_assign.task_id')
            ->join('clients', 'clients.id', '=', 'tasks.client_id')
            ->join('task_status', 'task_status.task_assign_id', '=', 'task_comments.task_assign_id')
            
            ->join('status', 'status.id', '=', 'task_status.status_id')
            
            ->join('admins', 'admins.id', '=', 'task_comments.admin_id')

            // ->whereRaw('FIND_IN_SET("'.$userId.'",admin_group)')

            // ->whereRaw('admins.id', [$userId])
            
    
            ->select('task_assign.id as task_assign_id', 'task_assign.description as task_assign_description',
                    'task_comments.comment as comment', 'task_comments.seen as comment_seen',
                    'task_comments.seen_time as comment_seen_time', 'task_comments.type as comment_type',
                    'task_comments.created_at as comment_created_at',
    
                    'status.name as status_name', 'tasks.name as task_name', 'clients.name as client_name',
                    'clients.image as client_image',
                    'task_assign.created_at as task_created_at',
                    'task_comments.admin_id as task_admin_id',
                    'task_assign.admin_id as employee_id',
    
                    'admins.image as admin_image',
    
                )

            // ->where([ 'task_comments.type' => 'new_task'])
            ->where(['task_comments.admin_to' => $userId])

            ->where(['task_comments.seen' => 0])
            ->whereIn('task_comments.type', ['task_comments.type','new_task'])
            ->whereRaw('task_assign.admin_group', [$userId])

            ->orderBy('task_comments.id', 'DESC')
            
            
            ->get();
            // dd($taskComments);
        return $taskComments;
}


function getTaskCommentsById($userId){
// dd($userId);
    $taskComments = DB::table('task_comments')
        ->join('task_assign', 'task_assign.id', '=', 'task_comments.task_assign_id')
        ->join('task_status', 'task_status.task_assign_id', '=', 'task_comments.task_assign_id')
        
        ->join('status', 'status.id', '=', 'task_status.status_id')
        
        ->join('admins', 'admins.id', '=', 'task_comments.admin_id')
        

        ->select('task_assign.id as task_assign_id', 'task_assign.description as task_assign_description',
                'task_comments.comment as comment', 'task_comments.seen as comment_seen',
                'task_comments.seen_time as comment_seen_time', 'task_comments.admin_id as admin_id', 
                'task_comments.type as comment_type',
                'task_comments.created_at as comment_created_at',

                'status.name as status_name', 
                'task_comments.admin_id as task_admin_id',
                'task_assign.admin_id as employee_id',

                'admins.image as admin_image',
            )

        // ->whereNotIn('task_comments.type',['new_task'])

        // ->where('task_comments.admin_to', '=', $userId)
        // ->where(['task_comments.seen' => 0])

        // ->whereIn('task_comments.type', ['comment','status'])

        ->where(['task_comments.seen' => 0])
        ->whereNotIn('task_comments.admin_id', [$userId])

        ->whereIn('task_comments.type', ['comment','status'])
        ->whereRaw('task_comments.admin_to', [$userId])

        ->orderBy('task_comments.id', 'DESC')
        
        ->get();
        return $taskComments;
}

function getTaskComments(){
    // TaskComment::where('admin_id', session('LoggedUser')->id);session('LoggedUser')->id

    if(session('LoggedUser')->id == 1){
    $taskComments = DB::table('task_comments')
        ->join('task_assign', 'task_assign.id', '=', 'task_comments.task_assign_id')
        ->join('task_status', 'task_status.task_assign_id', '=', 'task_comments.task_assign_id')
        
        ->join('status', 'status.id', '=', 'task_status.status_id')
        
        ->join('admins', 'admins.id', '=', 'task_comments.admin_id')
        

        ->select('task_assign.id as task_assign_id', 'task_assign.description as task_assign_description',
                'task_comments.comment as comment', 'task_comments.seen as comment_seen',
                'task_comments.seen_time as comment_seen_time', 'task_comments.type as comment_type',
                'task_comments.created_at as comment_created_at',

                'status.name as status_name', 
                'task_comments.admin_id as task_admin_id',
                'task_assign.admin_id as employee_id',

                'admins.image as admin_image',
            )

        // ->whereNotIn('task_comments.type',['new_task'])

        ->where('task_comments.admin_id', '!=', session('LoggedUser')->id)
        ->where(['task_comments.seen' => 0])

        ->whereIn('task_comments.type', ['comment','status'])
        
        ->orderBy('task_comments.id', 'DESC')
        
        ->get();
        // print_r($taskComments);
    }else{
        $taskComments = DB::table('task_comments')
        ->join('task_assign', 'task_assign.id', '=', 'task_comments.task_assign_id')
        ->join('task_status', 'task_status.task_assign_id', '=', 'task_comments.task_assign_id')
        
        ->join('status', 'status.id', '=', 'task_status.status_id')
        
        ->join('admins', 'admins.id', '=', 'task_comments.admin_id')
        

        ->select('task_assign.id as task_assign_id', 'task_assign.description as task_assign_description',
                'task_comments.comment as comment', 'task_comments.seen as comment_seen',
                'task_comments.seen_time as comment_seen_time', 'task_comments.type as comment_type',
                'task_comments.created_at as comment_created_at',

                'status.name as status_name', 
                'task_comments.admin_id as task_admin_id',
                'task_assign.admin_id as employee_id',

                'task_assign.created_at as task_created_at',
                'admins.image as admin_image',

            )
        ->where('task_comments.admin_id', '!=', session('LoggedUser')->id)
        ->where(['task_comments.seen' => 0])
        ->where(['task_assign.admin_id' => session('LoggedUser')->id])
        ->whereIn('task_comments.type', ['comment','status'])

        ->orderBy('task_comments.id', 'DESC')
        
        ->get();
    }
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

function getParentCategory($id){
    $category = Category::find($id);

    if(isset($id)){
        if($category->parent_id == 0){

            return (['category'=>$category, 'subcategory' => null, 'subcategory2' => null]);

        }
        else{
            $subcategory = Category::find($category->parent_id);
            if($subcategory->parent_id == 0){
                return (['category'=>$subcategory, 'subcategory' => $category, 'subcategory2' => null]);
            }else{
            $subcategory2 = Category::find($subcategory->parent_id);
                return(['category'=>$subcategory2, 'subcategory' => $subcategory, 'subcategory2' => $category]);
            }
        }
    }else{
        return(['category'=>null, 'subcategory' => null, 'subcategory2' => null]);
    }
}

function downloadImage($file){
    return response()->download(public_path("/web/files/{$file}"));
}

function checkProductIsEXist($id){
    $products = DB::table('tasks')->where('category_id', $id)->get();
 
    if($products){
     foreach($products as $product){
         $del = DB::table('tasks')->where('id', $product->id)->delete();
             echo '<br>  p - '.$product->name;
     }
    }else{
        echo ' No prd -';
    }
 }

function deleteBulkImage($image){
    if(File::exists(public_path('web').'/media/lg/'.$image)){
        unlink(public_path('web').'/media/lg/'.$image);
        unlink(public_path('web').'/media/md/'.$image);
        unlink(public_path('web').'/media/sm/'.$image);
        unlink(public_path('web').'/media/xs/'.$image);
        unlink(public_path('web').'/media/icon/'.$image);
      }
}

     
function getParent($id){

    $category = Category::find($id);
    if($category == null){
        return ['parent_id' => 0];
    }else{
        return $category;
    }
}


// function getParent($id){
//     $task = Task::withTrashed()->find($id);
//     $kacheri = Category::find($task->category_id);
//     if($kacheri->parent_id == 0){
//         return (['kacheri'=>$kacheri, 'petaKacheri' => null, 'department' => null]);
//     }
//     else{
//         $petaKacheri = Category::find($kacheri->parent_id);
//         if($petaKacheri->parent_id == 0){
//             return (['kacheri'=>$petaKacheri, 'petaKacheri' => $kacheri, 'department' => null]);
//         }else{
//             $department = Category::find($petaKacheri->parent_id);
           
//             return(['kacheri'=>$department, 'petaKacheri' => $petaKacheri, 'department' => $kacheri]);
//         }
//     }
    
// }