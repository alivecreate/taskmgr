<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\admin\Admin;
use App\Models\admin\Client;
use Illuminate\Support\Facades\Hash;
use File;
use Image;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    
    public function __construct(){
        $this->clients = Client::orderBy('id', 'DESC')->get();
    }
    

    public function index()
    {
        $data = ['clients' =>  $this->clients];
        return view('adm.pages.client.index', $data);
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('adm.pages.client.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request->file('image'));
        $request->validate([
            'name' => 'required|max:255',
            'phone1' => 'required|unique:clients',
        ]);

        $image_name = uploadImageThumb($request);
        $client = new Client;
        $client->name = $request->name;
        $client->ref_name  = $request->ref_name ;
        $client->phone1  = $request->phone1;
        $client->phone2  = $request->phone2;
        $client->ref_phone  = $request->ref_phone;
        $client->email  = $request->email;
        $client->ref_email  = $request->ref_email;
        $client->address  = $request->address;
        $client->image = $image_name;        
        $client->note = $request->note;
        $client->admin_id = session('LoggedUser')->id;
               
        $save = $client->save();

        if($save){
            return back()->with('success', 'Client Added...');
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
        
        $data = ['client' =>  Client::find($id)];
        return view('adm.pages.client.edit', $data);
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
            'phone1' => 'required',
        ]);

        
        if($request->file('image')){
            $image_name = uploadImageThumb($request);
        }else{
            $image_name = $request->old_image;
        }
        $client = Client::find($id);
        $client->name = $request->name;
        $client->ref_name  = $request->ref_name ;
        $client->phone1  = $request->phone1;
        $client->phone2  = $request->phone2;
        $client->ref_phone  = $request->ref_phone;
        $client->email  = $request->email;
        $client->ref_email  = $request->ref_email;
        $client->address  = $request->address;
        $client->image = $image_name;        
        $client->note = $request->note;       
        $save = $client->save();

        if($save){
            return back()->with('success', 'Client Updated...');
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

    public function destroy(Client $client)
    {
        
        $delete = $client->delete();
        if($delete){
            return back()->with('success', 'Client Deleted...');
        }else{
            return back()->with('fail', 'Something went wrong, try again later...');
        }

    }
}
