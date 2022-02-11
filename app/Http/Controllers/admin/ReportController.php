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
use App\Models\admin\Media;
use DB;
use DateTime;

class ReportController extends Controller
{

    public function __construct(){

        $this->lastMonth = DB::table('task_status')
        ->join('task_assign', 'task_assign.id', '=', 'task_status.task_assign_id')
        ->join('admins', 'admins.id', '=', 'task_assign.admin_id')
        ->join('tasks', 'tasks.id', '=', 'task_assign.task_id')
        ->join('clients', 'clients.id', '=', 'tasks.client_id')

        ->where('task_status.status_id', 1)
        ->orderBy('task_assign.id', 'DESC')

        ->select('task_assign.id as task_assign_id', 'task_assign.description as task_description',
        'admins.name as admin_name', 'admins.id as admin_id', 'admins.image as admin_image',
        'task_assign.created_at as task_created_at','tasks.name as task_name',
        'clients.image as client_image','clients.name as client_name'
        )
        ->limit(10)
        ->get();

        // User::whereMonth('created_at', date('m'))
        // ->whereYear('created_at', date('Y'))
        // ->get(['name','created_at']);

        // dd($this->currentMonth);
    }

    

    public function date_wise_report(Request $request){

        // dd($request->input());
        
        if(session('LoggedUser')->id == 1){
            $admin_id = session('LoggedUser')->id;

            $this->currentMonth = DB::table('task_assign')
            ->join('tasks', 'tasks.id', '=', 'task_assign.task_id')
            ->join('task_status', 'task_status.task_assign_id', '=', 'task_assign.id')
            ->join('status', 'status.id', '=', 'task_status.status_id')
            ->join('clients', 'clients.id', '=', 'tasks.client_id')

            ->whereMonth('task_assign.created_at', date('m'))
            ->whereYear('task_assign.created_at', date('Y'))

            ->orderBy('task_assign.id', 'DESC')

            ->select('task_assign.id as task_assign_id', 'task_assign.description as task_description',
            
            'task_assign.created_at as task_created_at','tasks.name as task_name', 'tasks.name as task_id', 
            'task_assign.admin_group',
            'tasks.id as task_id', 'task_assign.created_at as task_assign_date',  'tasks.category_id as category_id', 
            'status.name as status_name', 'clients.name as client_name', 'clients.image as client_image'
            )
            ->get();
            
        }else{
            $admin_id = session('LoggedUser')->id;

            // $taskAssigns = TaskAssign::whereRaw('FIND_IN_SET("'.session('LoggedUser')->id.'",admin_group)')
            // ->orderBy('id', 'DESC')->get();
        

            $this->currentMonth = DB::table('task_assign')
            ->join('tasks', 'tasks.id', '=', 'task_assign.task_id')
            ->join('task_status', 'task_status.task_assign_id', '=', 'task_assign.id')
            ->join('status', 'status.id', '=', 'task_status.status_id')
            ->join('clients', 'clients.id', '=', 'tasks.client_id')

            ->whereMonth('task_assign.created_at', date('m'))
            ->whereYear('task_assign.created_at', date('Y'))
            
            ->whereRaw('FIND_IN_SET("'.session('LoggedUser')->id.'",admin_group)')

            ->orderBy('task_assign.id', 'DESC')

            ->select('task_assign.id as task_assign_id', 'task_assign.description as task_description',
            'task_assign.created_at as task_created_at','tasks.name as task_name', 'tasks.name as task_id', 
            'task_assign.admin_group',
            'tasks.id as task_id', 'task_assign.created_at as task_assign_date',  'tasks.category_id as category_id', 
            'status.name as status_name', 'clients.name as client_name', 'clients.image as client_image'
            )
            ->get();

        }
        
        if($request->type == ''){
            $data = ['dateWises' =>  $this->currentMonth, 'title' => 'Current Month Data'];
        }    
        elseif($request->type == 'monthly' && $request->month != ''){

        if(session('LoggedUser')->id == 1){
            $monthWise = DB::table('task_assign')
            ->join('tasks', 'tasks.id', '=', 'task_assign.task_id')
            ->join('task_status', 'task_status.task_assign_id', '=', 'task_assign.id')
            ->join('status', 'status.id', '=', 'task_status.status_id')
            ->join('clients', 'clients.id', '=', 'tasks.client_id')
    
            ->whereMonth('task_assign.created_at', date(explode('-',$request->month)[1]))
            ->whereYear('task_assign.created_at', date(explode('-',$request->month)[0]))
            
    
            ->orderBy('task_assign.id', 'DESC')
    
            ->select('task_assign.id as task_assign_id', 'task_assign.description as task_description',
            'task_assign.created_at as task_created_at','tasks.name as task_name', 'tasks.name as task_id', 
            'task_assign.admin_group',
            'tasks.id as task_id', 'task_assign.created_at as task_assign_date',  'tasks.category_id as category_id', 
            'status.name as status_name', 'clients.name as client_name', 'clients.image as client_image'
            )
    
            ->get();
            // dd($monthWise);
        }else{

            $monthWise = DB::table('task_assign')
            ->join('tasks', 'tasks.id', '=', 'task_assign.task_id')
            ->join('task_status', 'task_status.task_assign_id', '=', 'task_assign.id')
            ->join('status', 'status.id', '=', 'task_status.status_id')
            ->join('clients', 'clients.id', '=', 'tasks.client_id')
    
            ->whereMonth('task_assign.created_at', date(explode('-',$request->month)[1]))
            ->whereYear('task_assign.created_at', date(explode('-',$request->month)[0]))
    
            ->whereRaw('FIND_IN_SET("'.session('LoggedUser')->id.'",admin_group)')

            ->orderBy('task_assign.id', 'DESC')
    
            ->select('task_assign.id as task_assign_id', 'task_assign.description as task_description',
            'task_assign.admin_group',
            'task_assign.created_at as task_created_at','tasks.name as task_name', 'tasks.name as task_id', 
            'tasks.id as task_id', 'task_assign.created_at as task_assign_date',  'tasks.category_id as category_id', 
            'status.name as status_name', 'clients.name as client_name', 'clients.image as client_image'
            )
    
            ->get();
        }
            // dd($monthWise);
            $dateObj   = DateTime::createFromFormat('!m', explode('-',$request->month)[1]);
            $monthName = $dateObj->format('F');

            $data = ['dateWises' =>  $monthWise, 'title' => 'Month ( '. $monthName. ' - ' . explode('-',$request->month)[0] .' ) ' ];

        }elseif($request->type == 'date-range'){
            // dd($request->all());

            if(session('LoggedUser')->id == 1){
                $dateBetween = DB::table('task_assign')
                ->join('tasks', 'tasks.id', '=', 'task_assign.task_id')
                ->join('task_status', 'task_status.task_assign_id', '=', 'task_assign.id')
                ->join('status', 'status.id', '=', 'task_status.status_id')
                ->join('clients', 'clients.id', '=', 'tasks.client_id')
        
                ->whereBetween('task_assign.created_at', [$request->start, $request->end])
                ->orderBy('task_assign.id', 'DESC')
        
                ->select('task_assign.id as task_assign_id', 'task_assign.description as task_description',
                'task_assign.admin_group',
                'task_assign.created_at as task_created_at','tasks.name as task_name', 'tasks.name as task_id', 
                'tasks.id as task_id', 'task_assign.created_at as task_assign_date',  'tasks.category_id as category_id', 
                'status.name as status_name', 'clients.name as client_name', 'clients.image as client_image'
                )
                ->get();
            }else{

                $dateBetween = DB::table('task_assign')
                ->join('tasks', 'tasks.id', '=', 'task_assign.task_id')
                ->join('task_status', 'task_status.task_assign_id', '=', 'task_assign.id')
                ->join('status', 'status.id', '=', 'task_status.status_id')
                ->join('clients', 'clients.id', '=', 'tasks.client_id')
                ->where('task_assign.created_at', '>=', $request->start)
                ->where('task_assign.created_at', '<=', $request->end)

                // ->whereBetween('task_assign.created_at', [$request->start, $request->end])
            ->whereRaw('FIND_IN_SET("'.session('LoggedUser')->id.'",admin_group)')
                ->orderBy('task_assign.id', 'DESC')
        
                ->select('task_assign.id as task_assign_id', 'task_assign.description as task_description',
                'task_assign.admin_group',
                'task_assign.created_at as task_created_at','tasks.name as task_name', 'tasks.name as task_id', 
                'tasks.id as task_id', 'task_assign.created_at as task_assign_date',  'tasks.category_id as category_id', 
                'status.name as status_name', 'clients.name as client_name', 'clients.image as client_image'
                )
                ->get();
            }
            // dd($dateBetween);

            $data = ['dateWises' =>  $dateBetween, 'title' => $request->start .' to ' . $request->end];
            
        }
        else{
            // dd('current month');

            $data = ['dateWises' =>  $this->currentMonth, 'title' => 'Current Month'. '( '.date("F Y") .' )'];

        }

        return view('adm.pages.report.date-wise', $data);

    }

    public function status_wise_report(Request $request){

        if(session('LoggedUser')->id == 1){

            if(isset($request->status)){
                $status_id = $request->status;
                 $statusWiseData = DB::table('task_assign')
                ->join('tasks', 'tasks.id', '=', 'task_assign.task_id')
                ->join('task_status', 'task_status.task_assign_id', '=', 'task_assign.id')
                ->join('status', 'status.id', '=', 'task_status.status_id')
                ->join('clients', 'clients.id', '=', 'tasks.client_id')
                ->where('task_status.status_id', $status_id)
                ->orderBy('task_assign.id', 'DESC')
        
                ->select('task_assign.id as task_assign_id', 'task_assign.description as task_description',
                'task_assign.created_at as task_created_at','tasks.name as task_name', 'tasks.name as task_id', 
                'task_assign.admin_group',
                'tasks.id as task_id', 'task_assign.created_at as task_assign_date',  'tasks.category_id as category_id', 
                'status.name as status_name', 'clients.name as client_name', 'clients.image as client_image'
                )
                ->get();

            $data = ['title' => 'Status Wise Data', 'statusWiseData' => $statusWiseData];
            return view('adm.pages.report.status-wise', $data);
            }else{
                $statusWiseData = DB::table('task_assign')
                
                ->join('tasks', 'tasks.id', '=', 'task_assign.task_id')
                ->join('task_status', 'task_status.task_assign_id', '=', 'task_assign.id')
                ->join('status', 'status.id', '=', 'task_status.status_id')
                ->join('clients', 'clients.id', '=', 'tasks.client_id')

                ->orderBy('task_assign.id', 'DESC')
        
                ->select('task_assign.id as task_assign_id', 'task_assign.description as task_description',
                'task_assign.admin_group',
                'task_assign.created_at as task_created_at','tasks.name as task_name', 'tasks.name as task_id', 
                'tasks.id as task_id', 'task_assign.created_at as task_assign_date',  'tasks.category_id as category_id', 
                'status.name as status_name', 'clients.name as client_name', 'clients.image as client_image'
                )

                ->get();

            $data = ['title' => 'Status Wise Data', 'statusWiseData' => $statusWiseData];
            return view('adm.pages.report.status-wise', $data);
            }

           
        }else{
            $admin_id = session('LoggedUser')->id;

            if(isset($request->status)){
                $status_id = $request->status;
                 $statusWiseData = DB::table('task_assign')
                ->join('tasks', 'tasks.id', '=', 'task_assign.task_id')
                ->join('task_status', 'task_status.task_assign_id', '=', 'task_assign.id')
                ->join('status', 'status.id', '=', 'task_status.status_id')
                ->join('clients', 'clients.id', '=', 'tasks.client_id')
                ->where('task_status.status_id', $status_id)
                
                ->whereRaw('FIND_IN_SET("'.session('LoggedUser')->id.'",admin_group)')
                ->orderBy('task_assign.id', 'DESC')
        
                ->select('task_assign.id as task_assign_id', 'task_assign.description as task_description',
                'task_assign.admin_group',
                'task_assign.created_at as task_created_at','tasks.name as task_name', 'tasks.name as task_id', 
                'tasks.id as task_id', 'task_assign.created_at as task_assign_date',  'tasks.category_id as category_id', 
                'status.name as status_name', 'clients.name as client_name', 'clients.image as client_image'
                )
                ->get();

            $data = ['title' => 'Status Wise Data', 'statusWiseData' => $statusWiseData];
            return view('adm.pages.report.status-wise', $data);
            }
            else{
                $statusWiseData = DB::table('task_assign')

                ->join('tasks', 'tasks.id', '=', 'task_assign.task_id')
                ->join('task_status', 'task_status.task_assign_id', '=', 'task_assign.id')
                ->join('status', 'status.id', '=', 'task_status.status_id')
                ->join('clients', 'clients.id', '=', 'tasks.client_id')
                


                ->orderBy('task_assign.id', 'DESC')
        
                ->select('task_assign.id as task_assign_id', 'task_assign.description as task_description',
                'task_assign.admin_group',
                'task_assign.created_at as task_created_at','tasks.name as task_name', 'tasks.name as task_id', 
                'tasks.id as task_id', 'task_assign.created_at as task_assign_date',  'tasks.category_id as category_id', 
                'status.name as status_name', 'clients.name as client_name', 'clients.image as client_image'
                )

                ->get();

            $data = ['title' => 'Status Wise Data', 'statusWiseData' => $statusWiseData];
            return view('adm.pages.report.status-wise', $data);
            }
        }

            


    

    }


    public function employee_wise_report(Request $request){
        
        $employees = Admin::whereNotIn('id', [1])->get();
        if(isset($request->employee)){
            $admin_id = $request->employee;
             $statusWiseData = DB::table('task_assign')
            ->join('admins', 'admins.id', '=', 'task_assign.admin_id')
            ->join('tasks', 'tasks.id', '=', 'task_assign.task_id')
            ->join('task_status', 'task_status.task_assign_id', '=', 'task_assign.id')
            ->join('status', 'status.id', '=', 'task_status.status_id')
            ->join('clients', 'clients.id', '=', 'tasks.client_id')

            // ->whereRaw('task_assign.admin_group',[$admin_id])

            ->whereRaw('FIND_IN_SET("'.$admin_id.'",admin_group)')

            ->orderBy('task_assign.id', 'DESC')
    
            ->select('task_assign.id as task_assign_id', 'task_assign.description as task_description',
            'admins.name as admin_name', 'admins.id as admin_id', 'admins.image as admin_image',
            'task_assign.admin_group',
            'task_assign.created_at as task_created_at','tasks.name as task_name', 'tasks.name as task_id', 
            'tasks.id as task_id', 'task_assign.created_at as task_assign_date',  'tasks.category_id as category_id', 
            'status.name as status_name', 'clients.name as client_name', 'clients.image as client_image'
            )
            ->get();

            $statusWiseData = DB::table('task_assign')
            ->whereRaw('FIND_IN_SET("'.$admin_id.'",admin_group)')->get();
        $data = ['employees' => $employees, 'title' => 'Status Wise Data', 'statusWiseData' => $statusWiseData];
        return view('adm.pages.report.employee-wise-all', $data);

        }
        else{
          
            $statusWiseData = DB::table('task_assign')
            
            ->join('tasks', 'tasks.id', '=', 'task_assign.task_id')
            ->join('task_status', 'task_status.task_assign_id', '=', 'task_assign.id')
            ->join('status', 'status.id', '=', 'task_status.status_id')
            ->join('clients', 'clients.id', '=', 'tasks.client_id')

            ->orderBy('task_assign.id', 'DESC')
    
            ->select('task_assign.id as task_assign_id', 'task_assign.description as task_description',
            'task_assign.created_at as created_at', 'task_assign.admin_group as admin_group',
            'task_assign.created_at as task_created_at','tasks.name as task_name', 'tasks.name as task_id', 
            'tasks.id as task_id', 'task_assign.created_at as task_assign_date',  'tasks.category_id as category_id', 
            'status.name as status_name', 'clients.name as client_name', 'clients.image as client_image'
            )

            ->get();
        }

        $statusWiseData = DB::table('task_assign')->get();
        $data = ['employees' => $employees, 'title' => 'Status Wise Data', 'statusWiseData' => $statusWiseData];
    return view('adm.pages.report.employee-wise-all', $data);
}

public function client_wise_report(Request $request){


    $clients = Client::all();
    // dd($request->client);
    if(isset($request->client)){
            $admin_id = $request->client;
             $clientWise = DB::table('task_assign')
            // ->join('admins', 'admins.id', '=', 'task_assign.admin_id')
            ->join('tasks', 'tasks.id', '=', 'task_assign.task_id')
            ->join('task_status', 'task_status.task_assign_id', '=', 'task_assign.id')
            ->join('status', 'status.id', '=', 'task_status.status_id')
            ->join('clients', 'clients.id', '=', 'tasks.client_id')

            ->where('tasks.client_id', $admin_id)

            ->orderBy('task_assign.id', 'DESC')
    
            ->select('task_assign.id as task_assign_id', 'task_assign.description as task_description',
            'task_assign.admin_group', 'task_assign.created_at', 
            'task_assign.created_at as task_created_at','tasks.name as task_name', 'tasks.name as task_id', 
            'tasks.id as task_id', 'task_assign.created_at as task_assign_date',  'tasks.category_id as category_id', 
            'status.name as status_name', 'clients.name as client_name', 'clients.image as client_image'
            )
            ->get();
            
        $data = ['clients' => $clients, 'title' => 'Status Wise Data', 'clientWiseData' => $clientWise];
        return view('adm.pages.report.client-wise', $data);

    }
    else{
        // dd('all');
        $clients = Client::all();
        
        $statusWiseData = DB::table('task_assign')
            
        ->join('tasks', 'tasks.id', '=', 'task_assign.task_id')
        ->join('task_status', 'task_status.task_assign_id', '=', 'task_assign.id')
        ->join('status', 'status.id', '=', 'task_status.status_id')
        ->join('clients', 'clients.id', '=', 'tasks.client_id')

        ->orderBy('task_assign.id', 'DESC')

        ->select('task_assign.id as task_assign_id', 'task_assign.description as task_description',
        'task_assign.created_at as created_at', 'task_assign.admin_group as admin_group',
        'task_assign.created_at as task_created_at','tasks.name as task_name', 'tasks.name as task_id', 
        'tasks.id as task_id', 'task_assign.created_at as task_assign_date',  'tasks.category_id as category_id', 
        'status.name as status_name', 'clients.name as client_name', 'clients.image as client_image'
        )

        ->get();
        $statusWiseData = DB::table('task_assign')->get();
        $data = ['clients' => $clients, 'title' => 'Status Wise Data', 'statusWiseData' => $statusWiseData];
        // dd($data);
    }

return view('adm.pages.report.client-wise-all', $data);
}

public function category_wise_report(Request $request){
    
    // dd(getCategoriesTree($request->parent_id));
    
    // die();
    //     $statusWiseData = DB::table('task_assign')
//    ->join('admins', 'admins.id', '=', 'task_assign.admin_id')
//    ->join('tasks', 'tasks.id', '=', 'task_assign.task_id')
//    ->join('task_status', 'task_status.task_assign_id', '=', 'task_assign.id')
//    ->join('status', 'status.id', '=', 'task_status.status_id')
//    ->join('clients', 'clients.id', '=', 'tasks.client_id')

//    // ->whereRaw('FIND_IN_SET("'.$admin_id.'",task_assign.admin_group)')

//    ->whereRaw('task_assign.admin_group',[$admin_id])

//    ->orderBy('task_assign.id', 'DESC')

//    ->select('task_assign.id as task_assign_id', 'task_assign.description as task_description',
//    'admins.name as admin_name', 'admins.id as admin_id', 'admins.image as admin_image',
//    'task_assign.admin_group',
//    'task_assign.created_at as task_created_at','tasks.name as task_name', 'tasks.name as task_id', 
//    'tasks.id as task_id', 'task_assign.created_at as task_assign_date',  'tasks.category_id as category_id', 
//    'status.name as status_name', 'clients.name as client_name', 'clients.image as client_image'
//    )
//    ->get();


    // dd($mainCategories);

    // dd(getTaskAssignFromCategory(72));

    $categories = DB::table('task_assign')
    ->join('admins', 'admins.id', '=', 'task_assign.admin_id')
    ->join('tasks', 'tasks.id', '=', 'task_assign.task_id')
    ->join('categories', 'categories.id', '=', 'tasks.category_id')
    ->join('task_status', 'task_status.task_assign_id', '=', 'task_assign.id')
    ->join('status', 'status.id', '=', 'task_status.status_id')
    ->join('clients', 'clients.id', '=', 'tasks.client_id')
    
    ->select('task_assign.id as task_assign_id', 'task_assign.description as task_description',
    'admins.name as admin_name', 'admins.id as admin_id', 'admins.image as admin_image',
    
    'task_assign.created_at as task_created_at',
    'tasks.name as task_name', 'tasks.name as task_id', 
    'tasks.id as task_id', 'task_assign.created_at as task_assign_date',  'tasks.category_id as category_id', 
    'status.name as status_name', 'clients.name as client_name', 'clients.image as client_image'
    )->get(); 

    
$data = [ 
    'mainCategories' => Category::where('parent_id', 0)->get(),
    'categories' => $categories,
    'category_wises' => getCategoryTreeData($request->parent_id),

];

// dd($data);
return view('adm.pages.report.category-wise-all', $data);

if(isset($request->category)){
    $id = $request->category;

    // if(isset(getParents($id)['subcategory2'])){
    //     $mainCategory = getParents($id)['subcategory2'];
    // }
    // elseif(isset(getParents($id)['subcategory'])){
    //     $mainCategory = getParents($id)['subcategory'];
    // }else{

    //     $mainCategory = getParents($id)['category'];
    // }
    
    // echo getParents($id)['category']->id;

    // die();
    // dd($data);

    if(isset($mainCategory)){

    $categories = DB::table('task_assign')
    ->join('admins', 'admins.id', '=', 'task_assign.admin_id')
    ->join('tasks', 'tasks.id', '=', 'task_assign.task_id')
    ->join('categories', 'categories.id', '=', 'tasks.category_id')
    ->join('task_status', 'task_status.task_assign_id', '=', 'task_assign.id')
    ->join('status', 'status.id', '=', 'task_status.status_id')
    ->join('clients', 'clients.id', '=', 'tasks.client_id')
    ->where('tasks.id' , getParents($id)['category'])
    ->select('task_assign.id as task_assign_id', 'task_assign.description as task_description',
    'admins.name as admin_name', 'admins.id as admin_id', 'admins.image as admin_image',
    
    'task_assign.created_at as task_created_at',
    'tasks.name as task_name', 'tasks.name as task_id', 
    'tasks.id as task_id', 'task_assign.created_at as task_assign_date',  'tasks.category_id as category_id', 
    'status.name as status_name', 'clients.name as client_name', 'clients.image as client_image'
    )->get();

    }else{
        $categories = null;
    }

    
    if(isset($subcategory)){
        $subcategories = DB::table('tasks')
        
        ->join('categories', 'categories.id', '=', 'tasks.category_id')
        ->join('clients', 'clients.id', '=', 'tasks.client_id')

        ->where('categories.id' , $subcategory->id)
        
        ->select(
        
        'tasks.name as task_name', 'tasks.name as task_id', 
        'tasks.id as task_id', 'tasks.category_id as category_id', 
        'clients.name as client_name', 'clients.image as client_image'
        )
        ->get();
    }else{
        $subcategories = null;
    }

    if(isset($subcategory2)){
        $subcategories2 = DB::table('tasks')
        
        ->join('categories', 'categories.id', '=', 'tasks.category_id')
        ->join('clients', 'clients.id', '=', 'tasks.client_id')

        ->where('categories.id' , $subcategory2->id)
        
        ->select(
        
        'tasks.name as task_name', 'tasks.name as task_id', 
        'tasks.id as task_id', 'tasks.category_id as category_id', 
        'clients.name as client_name', 'clients.image as client_image'
        )
        ->get();
    }else{
        $subcategories2 = null;
    }

    
    $data = [ 'mainCategories' => Category::where('parent_id', 0)->get(),
        'categories' => $categories, 'subcategories' => $subcategories, 'subcategorie2' => $subcategories2];
    

    return view('adm.pages.report.category-wise', $data);
    }
    
    else{
        $mainCategories = Category::where('parent_id', 0)->get();
        $categories = DB::table('task_assign')
        ->join('admins', 'admins.id', '=', 'task_assign.admin_id')
        ->join('tasks', 'tasks.id', '=', 'task_assign.task_id')
        ->join('categories', 'categories.id', '=', 'tasks.category_id')
        ->join('task_status', 'task_status.task_assign_id', '=', 'task_assign.id')
        ->join('status', 'status.id', '=', 'task_status.status_id')
        ->join('clients', 'clients.id', '=', 'tasks.client_id')
        
        ->select('task_assign.id as task_assign_id', 'task_assign.description as task_description',
        'admins.name as admin_name', 'admins.id as admin_id', 'admins.image as admin_image',
        
        'task_assign.created_at as task_created_at',
        'tasks.name as task_name', 'tasks.name as task_id', 
        'tasks.id as task_id', 'task_assign.created_at as task_assign_date',  'tasks.category_id as category_id', 
        'status.name as status_name', 'clients.name as client_name', 'clients.image as client_image'
        )->get(); 

        dd('ni');
        
    $data = [ 'mainCategories' => Category::where('parent_id', 0)->get(),
    'categories' => $categories];

    return view('adm.pages.report.category-wise-all', $data);
    }
}
}
