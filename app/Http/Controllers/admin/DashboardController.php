<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\admin\AdminAuthController;
use App\Models\admin\Admin;


class DashboardController extends Controller
{
    //
    
    public function index()
    { 
        return view('adm.index');

    }

    public function dashboard2()
    { 
        return view('adm.dashboard2');
    }

}
