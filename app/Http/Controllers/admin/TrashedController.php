<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\admin\Client;

class TrashedController extends Controller
{
    
    public function __construct(){
        $this->clients = Client::onlyTrashed()->get();;
    }
    

    public function index($table)
    {
        if($table == 'client'){
            $data = ['records' =>  $this->clients, 'record_name' => 'client'];
        }
        return view('adm.pages.trashed.index', $data);
        
    }
    
    public function destroy($table,$id)
    {
        
        if($table == 'client'){
            $record = Client::onlyTrashed()->find($id);
            $delete = $record->forceDelete();

            if($delete){
                return back()->with('success', 'Client Deleted permanently...');
            }else{
                return back()->with('fail', 'Something went wrong, try again later...');
            }
        }
        
    }

    public function restore($table,$id)
    {
        
        if($table == 'client'){
            $record = Client::onlyTrashed()->find($id);
            $delete = $record->restore();

            if($delete){
                return back()->with('success', 'Client Restored permanently...');
            }else{
                return back()->with('fail', 'Something went wrong, try again later...');
            }
        }
        
    }
}
