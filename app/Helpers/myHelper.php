<?php

use App\Models\admin\Category;
use App\Models\admin\TaskStatus;
use App\Models\admin\Status;
use App\Models\admin\Admin;

    // dd($task);
function uploadAnyFile($request){
    if($request->file('file')){
        $file = $request->file('file');
        // dd($file);
        $input['fileName'] = time().'_'.rand(111,999).'.'.$file->getClientOriginalExtension();
        //original image 
        $destinationPath = public_path('/web/files');
        $file->move($destinationPath, $input['fileName']);
        $fileName = $input['fileName'];

    }else{
        $fileName = null;
    }
    return $fileName;


}

function getTaskData($id){
    return DB::table('tasks')->where('id', $id)->first();
}
function getClientData($id){
    return DB::table('clients')->where('id', $id)->first();
}
function getStatusData($id){
    return DB::table('clients')->where('id', $id)->first();
}
function getCommentName($id){
    return DB::table('clients')->where('id', $id)->first();
}

function getTaskDetailFrom($taskAssignId){
    // dd($taskAssignId);
}

function uploadImageThumb($request){
    // return $image;
    if($request->file('image')){
        $image = $request->file('image');
        // dd($image);
        $input['imagename'] = time().'_'.rand(111,999).'.'.$image->extension();

        //icon image resize
        $destinationPath = public_path('/web/media/icon');
        $img_icon = Image::make($image->path());
        $img_icon->resize(60, 60, function ($constraint) {
            $constraint->aspectRatio();
        })->save($destinationPath.'/'.$input['imagename']);
        
        //xs image resize
        $destinationPath = public_path('/web/media/xs');
        $img_xs = Image::make($image->path());
        $img_xs->resize(150, 150, function ($constraint) {
            $constraint->aspectRatio();
        })->save($destinationPath.'/'.$input['imagename']);
        
        //sm image resize
        $destinationPath = public_path('/web/media/sm');
        $img_sm = Image::make($image->path());
        $img_sm->resize(300, 300, function ($constraint) {
            $constraint->aspectRatio();
        })->save($destinationPath.'/'.$input['imagename']);
        
        //md image resize
        $destinationPath = public_path('/web/media/md');
        $img_md = Image::make($image->path());
        $img_md->resize(600, 600, function ($constraint) {
            $constraint->aspectRatio();
        })->save($destinationPath.'/'.$input['imagename']);

        //original image 
        $destinationPath = public_path('/web/media/lg');
        $image->move($destinationPath, $input['imagename']);
        $image_name = $input['imagename'];
    }else{
        $image_name = null;
    }
    return $image_name;


}

function today_date(){
    return date("d/m/Y");
}


function dateToDay($date){
    $now = \Carbon\Carbon::now()->format('Y-m-d H:s:i');
    
    $fromFormat = \Carbon\Carbon::parse($date)->format('Y-m-d H:s:i');

    $to = \Carbon\Carbon::createFromFormat('Y-m-d H:s:i', $now);
    $from = \Carbon\Carbon::createFromFormat('Y-m-d H:s:i', $fromFormat);

    $diff_in_minutes = $from->diffInMinutes($to);
    return $diff_in_minutes;
}

function dateToDayCalculate($date){

    $now = \Carbon\Carbon::now()->format('Y-m-d H:s:i');
    $fromFormat = \Carbon\Carbon::parse($date)->format('Y-m-d H:s:i');

    $to = \Carbon\Carbon::createFromFormat('Y-m-d H:s:i', $now);
    $from = \Carbon\Carbon::createFromFormat('Y-m-d H:s:i', $fromFormat);

    $diff_in_minutes = $from->diffInMinutes($to);
    
    if($diff_in_minutes == 0){
        return $diff_in_minutes. ' Minute Ago';
    }
    elseif($diff_in_minutes > 0 && $diff_in_minutes <= 59)
    {
        return $diff_in_minutes. ' Minutes Ago';
    }elseif($diff_in_minutes > 60){
        $hours = floor($diff_in_minutes / 60);

        if($hours <= 24){
            return $hours = floor($diff_in_minutes / 60).':'.($diff_in_minutes -   floor($diff_in_minutes / 60) * 60). ' Hours Ago';
        }else{
            return $days = floor($hours / 24). ' Days Ago';
        }

    }

}

function dateFormat($date, $format){
    return \Carbon\Carbon::parse($date)->format($format);
}

function dateFormatGujDay($date, $format){
    $day = \Carbon\Carbon::parse($date)->format($format);
    if($day == 'Monday'){
        return 'સોમવાર';
    }elseif($day == 'Tuesday'){
        return 'મંગળવાર';
    }elseif($day == 'Wednesday'){
        return 'બુધવાર';
    }elseif($day == 'Thursday'){
        return 'ગુરુવાર';
    }elseif($day == 'Friday'){
        return 'શુક્રવાર';
    }elseif($day == 'Saturday'){
        return 'શનિવાર';
    }else{
        return 'રવિવાર';
    }
}

function getStatusBgColor($status){
    if($status == 'pending'){
        return 'bg-warning';
    }elseif($status == 'processing'){
        return 'bg-info';
    }elseif($status == 'cancelled'){
        return 'bg-danger';
    }elseif($status == 'completed'){
        return 'bg-success';
    }else{
        return 'bg-default';
    }
}

function getStatusBadgeColor($status){
    if($status == 'pending'){
        return 'badge bg-warning';
    }elseif($status == 'processing'){
        return 'badge bg-info';
    }elseif($status == 'cancelled'){
        return 'badge bg-danger';
    }elseif($status == 'completed'){
        return 'badge bg-success';
    }else{
        return 'badge bg-default';
    }
}

function getStatusTextColor($status){
    if($status == 'pending'){
        return 'text-warning';
    }elseif($status == 'processing'){
        return 'text-info';
    }elseif($status == 'cancelled'){
        return 'text-danger';
    }elseif($status == 'completed'){
        return 'text-success';
    }else{
        return 'text-default';
    }
}


function getParents($id){
        
    $category = Category::find($id);
    if(isset($category)){
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
        return (['category'=>null, 'subcategory' => null, 'subcategory2' => null]);
    }
}

function getTaskAssigns($taskId){
    
    $taskAssign = DB::table('task_assign')
    ->join('admins', 'admins.id', '=', 'task_assign.admin_id')
    ->join('tasks', 'tasks.id', '=', 'task_assign.task_id')
    ->join('categories', 'categories.id', '=', 'tasks.category_id')
    ->join('task_status', 'task_status.task_assign_id', '=', 'task_assign.id')
    ->join('status', 'status.id', '=', 'task_status.status_id')
    ->join('clients', 'clients.id', '=', 'tasks.client_id')
    ->where('tasks.id' , $taskId)
    ->select('task_assign.id as task_assign_id', 'task_assign.description as task_description',
    'admins.name as admin_name', 'admins.id as admin_id', 'admins.image as admin_image',
    'tasks.created_at as task_created_at',
    'tasks.name as task_name', 'tasks.name as task_id', 
    'tasks.id as task_id', 'task_assign.created_at as task_assign_date',  'tasks.category_id as category_id', 
    'status.name as status_name', 'clients.name as client_name', 'clients.image as client_image'
    )
    ->get();
    return $taskAssign;
}

function getTaskAssignFromCategory($categoryId){
    // dd($categoryId);

    $taskAssign = DB::table('tasks')
    ->join('task_assign', 'task_assign.task_id', '=', 'tasks.id')
    ->join('categories', 'categories.id', '=', 'tasks.category_id')
    ->join('task_status', 'task_status.task_assign_id', '=', 'task_assign.id')
    ->join('status', 'status.id', '=', 'task_status.status_id')
    ->join('clients', 'clients.id', '=', 'tasks.client_id')
    ->where('tasks.category_id' , $categoryId)

    ->select('task_assign.id as task_assign_id', 'task_assign.description as task_description',
    'task_assign.admin_group as admin_group',
    'tasks.created_at as task_created_at',
    'tasks.name as task_name', 'tasks.name as task_id', 
    'tasks.id as task_id', 'task_assign.created_at as task_assign_date',  'tasks.category_id as category_id', 
    'status.name as status_name', 'clients.name as client_name', 'clients.image as client_image'
    )

    ->get();
    return $taskAssign;


}

function getCategoriesTree($id)
{
    $categories = Category::where('parent_id',$id)->get();
    if($categories->count())
    {
        foreach ($categories as $category) 
        {
            $categories_tree[$category->id] = getChildCategories($category);
        }
    }
    return response()->json(['categories' => $categories_tree]);
}

function getChildCategories($category)
{
    $sub_categories = [];
    $childs = Category::where('parent_id', $category->id)->orderBy('name')->get();
    $sub_categories = $category;
    $sub_categories['sub_categories'] = [];
    if($childs->count())
    {
        $sub_categories['sub_categories'] = $childs;
    }
    return $sub_categories;
}


function getCategoryTreeData($parent_id){
        // dd($parent_id);
        $catArray = [];
        $cat =  DB::table('categories')->where('id', $parent_id)->orderBy('name', 'DESC')->first();
        $catArray[] = $cat;
        $cats1 =  DB::table('categories')->where('parent_id', $parent_id)->orderBy('name', 'DESC')->get();
        foreach($cats1 as $cat1){
      
          $catArray[] = $cat1;
          
          $cats2 =  DB::table('categories')->where('parent_id', $cat1->id)->orderBy('name', 'DESC')->get();
          if(isset($cats2)){
            foreach($cats2 as $cat2){
              $catArray[] = $cat2;
            }
          }
        }
        return $catArray;
}


function getChildArr($id){

    $catArry = [];
    if(isset(getParents($id)['subcategory2'])){
        $subcategory2 = getParents($id)['subcategory2'];
    }
    elseif(isset(getParents($id)['subcategory'])){
        $subcategory = getParents($id)['subcategory'];
    }else{

        $mainCategory = getParents($id)['category'];
    }

    // dd($mainCategory);

    if(isset($mainCategory)){
        $categories = DB::table('tasks')
        
        ->join('categories', 'categories.id', '=', 'tasks.category_id')
        ->join('clients', 'clients.id', '=', 'tasks.client_id')

        ->where('categories.id' , $id)
        
        ->select(
        'tasks.created_at as task_created_at',
        'tasks.name as task_name', 'tasks.name as task_id', 
        'tasks.id as task_id', 'tasks.category_id as category_id', 
        'clients.name as client_name', 'clients.image as client_image'
        )
        ->get();
        
    }else{
        $categories =null;
    }

    if(isset($subcategories)){
        $subcategories = DB::table('task_assign')
        ->join('admins', 'admins.id', '=', 'task_assign.admin_id')
        ->join('tasks', 'tasks.id', '=', 'task_assign.task_id')
        ->join('categories', 'categories.id', '=', 'tasks.category_id')
        ->join('task_status', 'task_status.task_assign_id', '=', 'task_assign.id')
        ->join('status', 'status.id', '=', 'task_status.status_id')
        ->join('clients', 'clients.id', '=', 'tasks.client_id')
        ->where('tasks.category_id' , $subcategories->id)
        ->select('task_assign.id as task_assign_id', 'task_assign.description as task_description',
        'admins.name as admin_name', 'admins.id as admin_id', 'admins.image as admin_image',
        'tasks.created_at as task_created_at',
        'tasks.name as task_name', 'tasks.name as task_id', 
        'tasks.id as task_id', 'task_assign.created_at as task_assign_date',  'tasks.category_id as category_id', 
        'status.name as status_name', 'clients.name as client_name', 'clients.image as client_image'
        )
        ->get();
    }else{
        $subcategories =null;
    }

    if(isset($subcategory2)){
        
        $subcategories2 = DB::table('task_assign')
        ->join('admins', 'admins.id', '=', 'task_assign.admin_id')
        ->join('tasks', 'tasks.id', '=', 'task_assign.task_id')
        ->join('categories', 'categories.id', '=', 'tasks.category_id')
        ->join('task_status', 'task_status.task_assign_id', '=', 'task_assign.id')
        ->join('status', 'status.id', '=', 'task_status.status_id')
        ->join('clients', 'clients.id', '=', 'tasks.client_id')
        ->where('tasks.category_id' , $mainCategory->id)
        
        ->select('task_assign.id as task_assign_id', 'task_assign.description as task_description',
        'admins.name as admin_name', 'admins.id as admin_id', 'admins.image as admin_image',
        'tasks.created_at as task_created_at',
        'tasks.name as task_name', 'tasks.name as task_id', 
        'tasks.id as task_id', 'task_assign.created_at as task_assign_date',  'tasks.category_id as category_id', 
        'status.name as status_name', 'clients.name as client_name', 'clients.image as client_image'
        )
        ->get();
    }else{
        $subcategories2 =null;
    }

    return [ 'mainCategories' => Category::where('parent_id', 0)->get(),
        'categories' => $categories, 'subcategories' => $subcategories, 'subcategorie2' => $subcategories];

        
}

function getChildCategoryId($id){

    $parent = Category::where('id', $id)->get();

    $arrList = [];
    $catArr = array();
    foreach ($parents as $parent) {
        $childs = Category::where('parent_id', $parent->id)->get();
        if (count($childs) > 0) {
            $subCat = array();
            $players = array();
            $catArr = array();
            $catList[$parent->id] = $catArr;
            
            $roster[$parent->id] = $players;
                    foreach ($childs as $i => $child) {
                        $subchilds = Category::where('parent_id', $child->id)->get();
                        if (count($subchilds) > 0) {
                            $arrList[] = $catArr;

                            $roster[$parent->id][$child->id] = $subCat;
                            foreach ($subchilds as $subchild) {

                                $arrList[] = $catArr;

                                $roster[$parent->id][$child->id][$subchild->id] = $subchild->id;
                            }

                        }else{
                            $arrList[] = $players;
                        }
                    }

        }
    }
    return $roster;
}


function getEmployees($list){
    if($list == null){
        return null;
    }
    else{
        $categoryArrs = explode(',', $list);
        $arr = array();
        foreach($categoryArrs as $categoryArr){
            if(DB::table('admins')->where('id', $categoryArr)->first()){
                $arr[] = DB::table('admins')->where('id', $categoryArr)->first();
            }
        }
        return $arr;
    }
}



function getTaskDetail($id){

    $taskWiseData = DB::table('tasks')
    ->join('task_assign', 'task_assign.task_id', '=', 'tasks.id')
    ->join('task_status', 'task_status.task_assign_id', '=', 'task_assign.id')
    ->join('status', 'status.id', '=', 'task_status.status_id')
    ->join('clients', 'clients.id', '=', 'tasks.client_id')

    ->where('tasks.id',$id)
    
    ->select('task_assign.id as task_assign_id', 'task_assign.description as task_description',
    'task_assign.admin_group',
    'task_assign.created_at as task_created_at','tasks.name as task_name', 'tasks.name as task_id', 
    'tasks.id as task_id', 'task_assign.created_at as task_assign_date',  'tasks.category_id as category_id', 
    'status.name as status_name', 'clients.name as client_name', 'clients.image as client_image'
    )->first();
 return $taskWiseData;
// dd($taskWiseData);



}



function statusWise($id){

    $statusWiseData = DB::table('task_assign')
    ->join('admins', 'admins.id', '=', 'task_assign.admin_id')
    ->join('tasks', 'tasks.id', '=', 'task_assign.task_id')
    ->join('task_status', 'task_status.task_assign_id', '=', 'task_assign.id')
    ->join('status', 'status.id', '=', 'task_status.status_id')
    ->join('clients', 'clients.id', '=', 'tasks.client_id')

    ->whereRaw('task_assign.admin_group',[$admin_id])

    ->select('task_assign.id as task_assign_id', 'task_assign.description as task_description',
    'admins.name as admin_name', 'admins.id as admin_id', 'admins.image as admin_image',
    'task_assign.admin_group',
    'task_assign.created_at as task_created_at','tasks.name as task_name', 'tasks.name as task_id', 
    'tasks.id as task_id', 'task_assign.created_at as task_assign_date',  'tasks.category_id as category_id', 
    'status.name as status_name', 'clients.name as client_name', 'clients.image as client_image'
);

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

function getCategoryTree(){
    $parents = Category::where('parent_id', 0)->get();
    foreach ($parents as $parent) {
        $childs = Category::where('parent_id', $parent->id)->orderBy('name')->get();

        $subCat = array();
        $players = array();

        $roster[$parent->id] = $players;
        if (count($childs) > 0) {

                    foreach ($childs as $i => $child) {
                        $subchilds = Category::where('parent_id', $child->id)->orderBy('name')->get();
                        if (count($subchilds) > 0) {

                            $roster[$parent->id][$child->id] = $subCat;
                            foreach ($subchilds as $subchild) {

                                $roster[$parent->id][$child->id][$subchild->id] = $subchild->id;
                            }

                        }else{
                            $roster[$parent->id][$child->id] = $players;
                        }
                    }
        }
    }
    return $roster;

    // dd($roster);
}
// old version tree view

// function getCategoryTree(){
//     $parents = Category::where('parent_id', 0)->get();
//     foreach ($parents as $parent) {
//         $childs = Category::where('parent_id', $parent->id)->get();
//         if (count($childs) > 0) {
//             $subCat = array();
//             $players = array();

//             $roster[$parent->id] = $players;
//                     foreach ($childs as $i => $child) {
//                         $subchilds = Category::where('parent_id', $child->id)->get();
//                         if (count($subchilds) > 0) {

//                             $roster[$parent->id][$child->id] = $subCat;
//                             foreach ($subchilds as $subchild) {

//                                 $roster[$parent->id][$child->id][$subchild->id] = $subchild->id;
//                             }

//                         }else{
//                             $roster[$parent->id][$child->id] = $players;
//                         }
//                     }
//         }
//     }
//     return $roster;
//     dd($roster);
// }

function categoryData($id){
    return DB::table('categories')->where('id', $id)->first();
}

function getChilds($id){
        
    $category = Category::find($id);
    if(isset($category)){

        if($category->parent_id == 0){
            return (['category'=>$category, 'subcategory' => null, 'subcategory2' => null]);
           
        }else{
            $subcategory = Category::where('parent_id',$category->id)->get();
            if(isset($subcategory) && $category->parent_id == 0){
                
                    return (['category'=>$category, 'subcategory' => $subcategory, 'subcategory2' => null]);
                
            }else{
                $subcategory2 = Category::where('parent_id',$subcategory->id)->get();
                if(isset($subcategory2)){
                    return (['category'=>$category, 'subcategory' => $subcategory, 'subcategory2' => $subcategory2]);
                }

            }

        }
    }else{

    }

}