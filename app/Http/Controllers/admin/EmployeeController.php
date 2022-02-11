<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\admin\Employee;
use App\Models\admin\Admin;
use Illuminate\Support\Facades\Hash;
use File;
use Image;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    
    public function __construct(){
        $this->employees = Admin::orderBy('id', 'DESC')->get();
    }
    

    public function index()
    {
        $data = ['employees' =>  $this->employees];
        return view('adm.pages.employee.index', $data);
        
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
        return view('adm.pages.employee.create');
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
            'email' => 'required|email|unique:admins',
            'password' => 'required|min:5|max:255',
        ]);

        $image_name = uploadImageThumb($request);
        $employee = new Admin;
        $employee->name = $request->name;
        $employee->image = $image_name;        
        $employee->phone  = $request->phone;
        $employee->email  = $request->email;
        $employee->password = Hash::make($request->password);
        $employee->address  = $request->address ;
        $employee->code  = $request->code;
        $employee->post  = $request->post;
        $save = $employee->save();

        if($save){
            return back()->with('success', 'Employee Added...');
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
        $data = ['employee' =>  Admin::find($id)];
        return view('adm.pages.employee.edit', $data);

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
        ]);

        if($request->file('image')){
            $image_name = uploadImageThumb($request);
        }else{
            $image_name = $request->old_image;
        }
        
        if($request->password)
            { 
                $password = Hash::make($request->password);
            }
            else{
                $password = $request->old_password;
            }
        $employee = Admin::find($id);
        $employee->name = $request->name;
        $employee->image = $image_name;        
        $employee->phone  = $request->phone ;
        $employee->password  = $password;
        $employee->address  = $request->address ;
        $employee->code  = $request->code;
        $employee->post  = $request->post;
        $save = $employee->save();

        if($save){
            return back()->with('success', 'Employee Updated...');
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
    
    public function destroy(Admin $employee)
    {
        
        $delete = $employee->delete();
        
        if($delete){
            return back()->with('success', 'Employee Deleted...');
        }else{
            return back()->with('fail', 'Something went wrong, try again later...');
        }

    }
}
