<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\admin\Media;
use App\Models\admin\TaskComment;

class MediaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $image_name = uploadAnyFile($request);
        $media = new Media;
        $media->task_assign_id = $request->task_assign_id;         
        $media->note = $request->note;       
        $media->image = $image_name;
        $media->admin_id = session('LoggedUser')->id;  
        $save = $media->save();

        $task = new TaskComment;
        $task->task_assign_id = $request->task_assign_id;   
        $task->type = 'file_upload';             
        $task->comment = $request->note;             
        $task->admin_id = session('LoggedUser')->id;   
        $task->admin_to = $request->admin_to;       
        $save = $task->save();


        if($save){
            return back()->with('success', 'File Updated...');
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
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
    public function destroy($id)
    {
        // dd($id);

        $delete = Media::find($id)->delete();

        if($delete){
            return back()->with('success', 'File Deleted...');
        }else{
            return back()->with('fail', 'Something went wrong, try again later...');
        }
    }
}
