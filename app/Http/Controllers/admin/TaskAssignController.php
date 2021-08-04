<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\admin\TaskAssign;
use App\Models\admin\TaskStatus;
use App\Models\admin\Status;

use App\Models\admin\Client;
use App\Models\admin\Category;
use App\Models\admin\Admin;
use App\Models\admin\Task;
use App\Models\admin\TaskComment;


class TaskAssignController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct(){
        $this->clients = Client::orderBy('id', 'DESC')->get();
        $this->taskAssigns = TaskAssign::orderBy('id', 'DESC')->get();
        $this->categories = Category::orderBy('id', 'DESC')->get();

        $this->tasks = Task::orderBy('id', 'DESC')->get();

        $this->employees = Admin::get();
        $this->parent_categories = category::where(['parent_id'=>0])->orderBy('id','DESC')->get();
        $this->current_time = \Carbon\Carbon::now()->toDateTimeString();
        $this->statuses = Status::get();

        
    }
    
    public function index()
    {
        if(session('LoggedUser')->id == 1){
            $taskAssigns = $this->taskAssigns;
        }else{
            $taskAssigns = TaskAssign::orderBy('id', 'DESC')->where('admin_id',session('LoggedUser')->id)->get();
        }

        // dd($taskAssigns);

        $data = ['clients' =>  $this->clients, 'taskAssigns' =>  $taskAssigns,
                 'categories' =>  $this->categories];

        return view('adm.pages.task-assign.index', $data);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        // dd($request->input());

        $request->validate([
            'task_id' => 'required',
            'type' => 'required',
            'description' => 'required',
            'admin_id' => 'required',
            'date_inward' => 'required',
            'date_check' => 'required',
            'file_live_status' => 'required',
            'computer_file_status' => 'required',
            'cupboard_file_status' => 'required',

        ]);

        $task = new TaskAssign;
        $task->task_id = $request->task_id;              
        $task->type = $request->type;      
        $task->description = $request->description;  
        $task->admin_id  = $request->employee_id ; 
        $task->date_inward = $request->date_inward;      
        $task->date_check  = $request->date_check;
        $task->file_live_status  = $request->file_live_status;
        $task->computer_file_status  = $request->computer_file_status;
        $task->cupboard_file_status  = $request->cupboard_file_status;
        $save = $task->save();
        // dd($task->id);

        if($save){

            $taskStatus = new TaskStatus;
            $taskStatus->status_id  = 1 ; 
            $taskStatus->task_assign_id = $task->id;
            $taskStatus->save();

            return back()->with('success', 'Task Assigned...');
        }else{
            return back()->with('fail', 'Something went wrong, try again later...');
        }
    }

    public function create()
    {
        $data = [
            'clients' =>  $this->clients, 'parent_categories' => $this->parent_categories,
            'employees' =>  $this->employees, 'tasks' =>  $this->tasks, 'categories' =>  $this->categories
        ];
        return view('adm.pages.task-assign.create', $data);
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        $data = [
            'clients' =>  $this->clients, 'parent_categories' => $this->parent_categories,
             'taskAssign' =>  TaskAssign::where('id', $id)->first(), 'categories' =>  $this->categories,
             'statuses' => $this->statuses
        ];
        $taskAssign = TaskAssign::where('id', $id)->first();
        // dd($taskAssign);
        $taskComments = $taskAssign->getComments($taskAssign->id);

        // if(session('LoggedUser')->id == 1){
        //     $task_comment = TaskComment::where(['task_assign_id'=>$taskAssign->id,'seen'=>0,
        //                     ])->update(['seen' => 1, 'seen_time' => $this->current_time]);
        //     dd($task_comment);
        // }
        // else{

        //     $task_comment = TaskComment::where(['task_assign_id'=>$taskAssign->id,'seen'=>0,
        //                     ])->whereNotIn('admin_id' , [session('LoggedUser')->id]
        //                 )->update(['seen' => 1, 'seen_time' => $this->current_time]);
        // }

        $task_comment = TaskComment::where(['task_assign_id'=>$taskAssign->id,'seen'=>0,
                        ])->whereNotIn('admin_id' , [session('LoggedUser')->id]
                    )->update(['seen' => 1, 'seen_time' => $this->current_time]);
        // dd($task_comment);

        // $task_comment->seen = 1;
        // $task_comment->seen_time = $this->current_time;

        // $task_comment->save();


        // dd($this->current_time);
        // if()
        return view('adm.pages.task-assign.show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        
        
        $data = [
            'clients' =>  $this->clients, 'parent_categories' => $this->parent_categories,
            'employees' =>  $this->employees, 'taskAssign' =>  TaskAssign::where('id', $id)->first(), 'categories' =>  $this->categories
        ];

        // dd($data);
        
        return view('adm.pages.task-assign.edit', $data);


    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(TaskAssign $taskAssign)
    {
        
        $delete = $taskAssign->delete();
        if($delete){
            return back()->with('success', 'Task Assignment Deleted...');
        }else{
            return back()->with('fail', 'Something went wrong, try again later...');
        }
    }
    
    public function task_comment_store(Request $request){
        // dd($request->input());    
        $request->validate([
            'task_assign_id' => 'required',
            'comment' => 'required', 
        ]);

        $task = new TaskComment;
        $task->task_assign_id = $request->task_assign_id;   
        $task->comment = $request->comment;             
        $task->admin_id = $request->admin_id;      
        $save = $task->save();

        if($save){
            return back()->with('success', 'Comment submited...');
        }else{
            return back()->with('fail', 'Something went wrong, try again later...');
        }
    }

    public function task_comment_delete($id){
        // dd($id);
        $task_comment = TaskComment::find($id);     
        $delete = $task_comment->delete();

        if($delete){
            return back()->with('success', 'Comment Deleted...');
        }else{
            return back()->with('fail', 'Something went wrong, try again later...');
        }
    }

    public function task_update_status(Request $request){
        // dd($request->input());

        $taskStatus = TaskStatus::where('task_assign_id', $request->task_assign_id);
        $taskStatus->update(['status_id'=>$request->status_id]);

        $task = new TaskComment;
        $task->task_assign_id = $request->task_assign_id;   
        $task->type = 'status';             
        $task->comment = $request->status_id;             
        $task->admin_id = session('LoggedUser')->id;      
        $save = $task->save();

        if($taskStatus){
            return back()->with('success', 'Task Status Updated...');
        }else{
            return back()->with('fail', 'Something went wrong, try again later...');
        }

    }
}
