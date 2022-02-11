<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\home\HomeController;
use App\Http\Controllers\admin\DashboardController;
use App\Http\Controllers\admin\SliderController;
use App\Http\Controllers\admin\CategoryController;
use App\Http\Controllers\admin\AdminAuthController;
use App\Http\Controllers\admin\EmployeeController;
use App\Http\Controllers\admin\ClientController;
use App\Http\Controllers\admin\TrashedController;
use App\Http\Controllers\admin\TaskController;
use App\Http\Controllers\admin\TaskAssignController;
use App\Http\Controllers\admin\TaskStatus;
use App\Http\Controllers\admin\MediaController;
use App\Http\Controllers\admin\ReportController;

use App\Http\Controllers\admin\DownloadImageController;

use App\Http\Controllers\admin\FullCalenderController;
use App\Http\Controllers\admin\EventController;





/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

Route::resources([
    '/' => HomeController::class,    
]);



//Admin

// Route::group(function(){

//     Route::resource('/admin',DashboardController::class);
// });

Route::post('/admin/register/save', [AdminAuthController::class, 'save'])->name('register.save');
Route::post('/admin/auth/check', [AdminAuthController::class, 'check'])->name('auth.check');

Route::get('/admin/auth/check', function () {
    return redirect('/admin');
});

Route::get('/admin/auth/logout', [AdminAuthController::class, 'logout'])->name('auth.logout');

Route::get('/download/{file?}', [DownloadImageController::class, 'download'])->name('download.file');

Route::group(['middleware'=> ['AuthCheck']], function(){
    Route::resources([
        '/admin/employee' => EmployeeController::class,
        '/admin/client' => ClientController::class,
        '/admin/task' => TaskController::class,
        '/admin/media' => MediaController::class,
        '/admin/task-assign' => TaskAssignController::class,
    ]);


    // Download Files

    Route::get('/admin/report/dete-wise',[ReportController::class, 'date_wise_report'])->name('admin.report.dete-wise');
    Route::get('/admin/report/status-wise',[ReportController::class, 'status_wise_report'])->name('admin.report.status-wise');
    Route::get('/admin/report/employee-wise',[ReportController::class, 'employee_wise_report'])->name('admin.report.employee-wise');
    Route::get('/admin/report/client-wise',[ReportController::class, 'client_wise_report'])->name('admin.report.client-wise');
    Route::get('/admin/report/category-wise',[ReportController::class, 'category_wise_report'])->name('admin.report.category-wise');


    Route::resource('/admin/slider',SliderController::class);
    Route::resource('/admin/slider',SliderController::class);
    // Route::resource('/admin/employee',EmployeeController::class);

    // Route::get('/admin/category/petaKacheriStore',[CategoryController::class, 'petaKacheriStore'])->name('admin.petaKacheriStore');
    Route::post('/admin/category/petaKacheriStore', [CategoryController::class, 'petaKacheriStore'])->name('admin.category.petaKacheriStore');
    Route::post('/admin/category/departmentStore', [CategoryController::class, 'departmentStore'])->name('admin.category.departmentStore');

    Route::get('/admin/category/delete/{id}',[CategoryController::class, 'deleteCategory'])->name('admin.category.delete');



    Route::get('/admin',[DashboardController::class, 'index'])->name('admin.index');
    
    Route::get('/admin/category',[CategoryController::class, 'index'])->name('admin.category');
    Route::get('/admin/category/create',[CategoryController::class, 'create'])->name('admin.category.create');
    Route::get('/admin/category/edit/{id}',[CategoryController::class, 'edit'])->name('admin.category.edit');
    Route::post('/admin/category/store',[CategoryController::class, 'store'])->name('admin.category.store');
    Route::post('/admin/category/update/{id}',[CategoryController::class, 'update'])->name('admin.category.update');
    
    Route::get('/admin/category/view',[CategoryController::class, 'viewAll'])->name('admin.category.viewAll');
    
    Route::get('/admin/task-assign-list',[TaskAssignController::class, 'task_assign_list_employee'])->name('admin.task.assign.list');
    Route::get('/admin/task-assign-show/{id}',[TaskAssignController::class, 'show_employee'])->name('admin.task.assign.show.employee');
    


    
    Route::post('/admin/task-comment/store',[TaskAssignController::class, 'task_comment_store'])->name('admin.taskComment.store');
   
    Route::get('/admin/task-comment/store', function () {
        return redirect(url('admin'));
    });

    Route::post('/admin/task-comment/delete/{id}',[TaskAssignController::class, 'task_comment_delete'])->name('admin.taskComment.delete');
    
    Route::post('/admin/task-status/update',[TaskAssignController::class, 'task_update_status'])->name('admin.task.update.status');

    Route::get('/admin/trashed/{table}',[TrashedController::class, 'index'])->name('admin.trashed');
    Route::delete('/admin/trashed/{table}/{id}',[TrashedController::class, 'destroy'])->name('admin.trashed.destroy');
    Route::get('/admin/trashed/restore/{table}/{id}',[TrashedController::class, 'restore'])->name('admin.trashed.restore');
    
    Route::get('/admin/dashboard2',[DashboardController::class, 'dashboard2'])->name('admin.dashboard2');
    Route::get('/admin/test',[DashboardController::class, 'test'])->name('admin.test');
    Route::get('/admin/login', [AdminAuthController::class, 'login'])->name('admin.login');
    Route::get('/admin/register', [AdminAuthController::class, 'register']);
    
    Route::get('/admin/dashboard', [AdminAuthController::class, 'dashboard'])->name('admin.dashboard');


    Route::post('/admin/event-store', [EventController::class, 'store'])->name('eventStore');

    Route::get('/admin/full-calender', [FullCalenderController::class, 'index'])->name('admin.full-calender');
    Route::get('/admin/full-calender1', [FullCalenderController::class, 'index1'])->name('admin.full-calender1');
    Route::get('/admin/full-calender2', [FullCalenderController::class, 'index2'])->name('admin.full-calender2');
    Route::get('/admin/full-calender3', [FullCalenderController::class, 'index3'])->name('admin.full-calender3');
    Route::get('/admin/full-calender-final', [FullCalenderController::class, 'final'])->name('admin.full-calender-final');
    
    Route::post('/admin/full-calender/action', [FullCalenderController::class, 'action'])->name('storeFullCalendar');
    Route::post('/admin/full-calender/store-action-final', [FullCalenderController::class, 'finalAction'])->name('store-action-final');
    
    Route::post('/admin/full-calender/action2', [FullCalenderController::class, 'action2'])->name('storeFullCalendar2');
    Route::post('/admin/full-calender/actionSave', [FullCalenderController::class, 'actionSave'])->name('actionSave');


});
