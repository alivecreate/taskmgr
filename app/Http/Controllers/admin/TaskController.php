<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\admin\Client;
use App\Models\admin\Category;
use App\Models\admin\Admin;
use App\Models\admin\Task;
use App\Models\admin\TaskAssign;

use Illuminate\Support\Facades\Hash;
use File;
use Image;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    
    public function __construct(){
        $this->clients = Client::orderBy('id', 'DESC')->get();
        $this->tasks = Task::orderBy('id', 'DESC')->get();
        $this->categories = Category::orderBy('id', 'DESC')->get();
        $this->employees = Admin::get();
        $this->parent_categories = category::where(['parent_id'=>0])->orderBy('id','DESC')->get();
    }
    

    public function index()
    {
        $data = ['clients' =>  $this->clients, 'tasks' =>  $this->tasks,
                 'categories' =>  $this->categories];
        return view('adm.pages.task.index', $data);
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = [
            'clients' =>  $this->clients, 'parent_categories' => $this->parent_categories,
            'employees' =>  $this->employees, 'tasks' =>  $this->tasks, 'categories' =>  $this->categories
        ];
        return view('adm.pages.task.create', $data);
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
            'name' => 'required|max:255',
            'client_id' => 'required',
            'category_id' => 'required',
            'admin_id' => 'required',
        ]);

        $task = new Task;
        $task->name = $request->name;      
        $task->client_id  = $request->client_id;
        $task->category_id  = $request->category_id;
        $task->admin_id  = $request->admin_id ;
        $save = $task->save();

        if($save){
            return back()->with('success', 'Task Added...');
        }else{
            return back()->with('fail', 'Something went wrong, try again later...');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
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
            'employees' =>  $this->employees, 'task' =>  Task::where('id', $id)->first(), 'categories' =>  $this->categories
        ];

        // dd($data);
        
        return view('adm.pages.task.edit', $data);
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
        
        $request->validate([
            'name' => 'required|max:255',
            'client_id' => 'required',
            'category_id' => 'required',
            'admin_id' => 'required',
        ]);

        $task = Task::find($id);
        $task->name = $request->name;      
        $task->client_id  = $request->client_id;
        $task->category_id  = $request->category_id;
        $task->admin_id  = $request->admin_id ;
        $save = $task->save();

        if($save){
            return back()->with('success', 'Task Updated...');
        }else{
            return back()->with('fail', 'Something went wrong, try again later...');
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Task $task)
    {
        
        $delete = $task->delete();
        if($delete){
            return back()->with('success', 'Client Deleted...');
        }else{
            return back()->with('fail', 'Something went wrong, try again later...');
        }
    }
}
