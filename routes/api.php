<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\api\CategoryController;
use App\Http\Controllers\PhotoController;
use App\Http\Controllers\api\ApiCallController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
    
});
// Route::get('get/getPetaKacheri/{id}','api\CategoryApiController@getPetaKacheri');

Route::resource('photos.comments', PhotoController::class);

Route::get('get/getPetaKacheri/{id}',[CategoryController::class, 'getPetaKacheri']);
Route::get('get/getDepartment/{id}',[CategoryController::class, 'getDepartment']);

Route::get('getEmployees',[ApiCallController::class, 'getEmployees']);



// Route::post('/admin/category/departmentStore', [CategoryController::class, 'departmentStore'])->name('admin.category.departmentStore');



