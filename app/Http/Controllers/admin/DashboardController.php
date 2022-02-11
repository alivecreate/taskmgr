<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\admin\AdminAuthController;
use App\Models\admin\Admin;
use App\Models\admin\TaskStatus;
use App\Models\admin\TaskAssign;

use DB;

class DashboardController extends Controller
{
    //
    
    public function index()
    {

        if(session('LoggedUser')->id == 1){
            $pendingTaskCount = DB::table('task_status')
            ->join('task_assign', 'task_assign.id', '=', 'task_status.task_assign_id')
            ->where('task_status.status_id', 1)
            ->count();

            $processingTaskCount = DB::table('task_status')
                ->join('task_assign', 'task_assign.id', '=', 'task_status.task_assign_id')
                ->where('task_status.status_id', 2)
                ->count();
                
            $canceledTaskCount = DB::table('task_status')
            ->join('task_assign', 'task_assign.id', '=', 'task_status.task_assign_id')
            ->where('task_status.status_id', 3)
            ->count();

            $completedTaskCount = DB::table('task_status')
            ->join('task_assign', 'task_assign.id', '=', 'task_status.task_assign_id')
            ->where('task_status.status_id', 4)
            ->count();
            
                      
        $pendingTaskList = DB::table('task_status')
            
        ->join('task_assign', 'task_assign.id', '=', 'task_status.task_assign_id')
        
        ->join('tasks', 'tasks.id', '=', 'task_assign.task_id')

        ->where(['task_status.status_id' => 1])
        ->orderBy('task_assign.id', 'DESC')
        ->get();
        

            // $pendingTaskList = DB::table('task_status')
            // ->join('task_assign', 'task_assign.id', '=', 'task_status.task_assign_id')
            // ->join('admins', 'admins.id', '=', 'task_assign.admin_id')
            // ->join('tasks', 'tasks.id', '=', 'task_assign.task_id')
            // ->join('clients', 'clients.id', '=', 'tasks.client_id')

            // ->where('task_status.status_id', 1)
            // ->orderBy('task_assign.id', 'DESC')

            // ->select('task_assign.id as task_assign_id', 'task_assign.description as task_description',
            // 'admins.name as admin_name', 'admins.id as admin_id', 'admins.image as admin_image',
            // 'task_assign.created_at as task_created_at','tasks.name as task_name',
            // 'clients.image as client_image','clients.name as client_name'
            // )
            // ->limit(10)
            // ->get();
            
            $recentActivityLists = DB::table('task_assign')
            ->join('task_comments', 'task_comments.task_assign_id', '=', 'task_assign.id')
            ->join('admins', 'admins.id', '=', 'task_assign.admin_id')
            ->join('tasks', 'tasks.id', '=', 'task_assign.task_id')
            ->join('task_status', 'task_status.id', '=', 'task_assign.id')
            ->join('status', 'status.id', '=', 'task_comments.comment')
            ->join('clients', 'clients.id', '=', 'tasks.client_id')


            ->where('task_comments.type',['status', 'file_upload'])
            
            ->orderBy('task_comments.id', 'DESC')

            ->select('task_assign.id as task_assign_id', 'task_assign.description as task_description',
            'admins.name as admin_name', 'admins.id as admin_id', 'admins.image as admin_image',
            'task_assign.created_at as task_created_at','tasks.name as task_name',
            'task_comments.comment', 'task_comments.type' ,'status.name as status_name',
            )

            ->limit(10)
            ->get();

            $data = ['pendingTaskCount' =>  $pendingTaskCount, 'processingTaskCount' =>  $processingTaskCount,
            'completedTaskCount' =>  $completedTaskCount, 'canceledTaskCount' =>  $canceledTaskCount,
            'pendingTaskLists' => $pendingTaskList, 'recentActivityLists' => $recentActivityLists
        ];

        }
        else{
            $pendingTaskCount = DB::table('task_status')
            ->join('task_assign', 'task_assign.id', '=', 'task_status.task_assign_id')
            ->where(['task_status.status_id'=> 1])
            ->whereRaw('FIND_IN_SET("'.session('LoggedUser')->id.'",admin_group)')
            ->count();

            $processingTaskCount = DB::table('task_status')
                ->join('task_assign', 'task_assign.id', '=', 'task_status.task_assign_id')
                ->where(['task_status.status_id' => 2])
                ->whereRaw('FIND_IN_SET("'.session('LoggedUser')->id.'",admin_group)')
                ->count();
                
            $canceledTaskCount = DB::table('task_status')
            ->join('task_assign', 'task_assign.id', '=', 'task_status.task_assign_id')
            ->where(['task_status.status_id' => 3])
            ->whereRaw('FIND_IN_SET("'.session('LoggedUser')->id.'",admin_group)')
            ->count();

            $completedTaskCount = DB::table('task_status')
            ->join('task_assign', 'task_assign.id', '=', 'task_status.task_assign_id')
            ->where(['task_status.status_id' => 4])
            ->whereRaw('FIND_IN_SET("'.session('LoggedUser')->id.'",admin_group)')
            ->count();
            
        // $taskAssigns = TaskAssign::whereRaw('FIND_IN_SET("'.session('LoggedUser')->id.'",admin_group)')->orderBy('id', 'DESC')->get();
        
                    
        $pendingTaskList = DB::table('task_status')
            
            ->join('task_assign', 'task_assign.id', '=', 'task_status.task_assign_id')
            
            // ->join('admins', 'admins.id', '=', session('LoggedUser')->id)

            ->join('tasks', 'tasks.id', '=', 'task_assign.task_id')
            ->where(['task_status.status_id' => 1])
            ->whereRaw('FIND_IN_SET("'.session('LoggedUser')->id.'",task_assign.admin_group)')
            ->orderBy('task_assign.id', 'DESC')
            ->get();
            

            // $pendingTaskList = DB::table('task_status')
            // ->join('task_assign', 'task_assign.id', '=', 'task_status.task_assign_id')
            // ->join('admins', 'admins.id', '=', 'task_assign.admin_id')
            // ->join('tasks', 'tasks.id', '=', 'task_assign.task_id')
            // ->join('clients', 'clients.id', '=', 'tasks.client_id')

            // ->where(['task_status.status_id' => 1])
            // ->whereRaw('FIND_IN_SET("'.session('LoggedUser')->id.'",task_assign.admin_group)')
            
            // ->orderBy('task_assign.id', 'DESC')

            // ->select('task_assign.id as task_assign_id', 'task_assign.description as task_description',
            // 'admins.name as admin_name', 'admins.id as admin_id', 'admins.image as admin_image',
            // 'task_assign.created_at as task_created_at','tasks.name as task_name',
            // 'clients.image as client_image','clients.name as client_name'
            // )
            // ->limit(10)
            // ->get();
            // dd($pendingTaskList);

            $recentActivityLists = DB::table('task_assign')
            ->join('task_comments', 'task_comments.task_assign_id', '=', 'task_assign.id')
            ->join('admins', 'admins.id', '=', 'task_assign.admin_id')
            ->join('tasks', 'tasks.id', '=', 'task_assign.task_id')
            ->join('task_status', 'task_status.id', '=', 'task_assign.id')
            ->join('status', 'status.id', '=', 'task_comments.comment')
            ->join('clients', 'clients.id', '=', 'tasks.client_id')


            ->where(['task_comments.type'=>  'status',  'task_assign.admin_id' => session('LoggedUser')->id ])
            
            ->orderBy('task_comments.id', 'DESC')

            ->select('task_assign.id as task_assign_id', 'task_assign.description as task_description',
            'admins.name as admin_name', 'admins.id as admin_id', 'admins.image as admin_image',
            'task_assign.created_at as task_created_at','tasks.name as task_name',
            'task_comments.comment', 'task_comments.type' ,'status.name as status_name',
            )

            ->limit(10)
            ->get();


            $data = ['pendingTaskCount' =>  $pendingTaskCount, 'processingTaskCount' =>  $processingTaskCount,
            'completedTaskCount' =>  $completedTaskCount, 'canceledTaskCount' =>  $canceledTaskCount,
        'pendingTaskLists' => $pendingTaskList, 'recentActivityLists' => $recentActivityLists
        ];
        // dd($recentActivityLists);
        

        $data = ['pendingTaskCount' =>  $pendingTaskCount, 'processingTaskCount' =>  $processingTaskCount,
                 'completedTaskCount' =>  $completedTaskCount, 'canceledTaskCount' =>  $canceledTaskCount,
                'pendingTaskLists' => $pendingTaskList, 'recentActivityLists' => $recentActivityLists
                ];

        }
        
        return view('adm.index-employee', $data);

    }

    public function dashboard2()
    { 
        return view('adm.dashboard2');
    }

}
