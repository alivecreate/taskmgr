<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\admin\Category;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct(){
        $this->parent_categories = category::where(['parent_id'=>0])->orderBy('id','DESC')->get();
    }
    

    public function index()
    {
        
        $data = ['parent_categories' =>  $this->parent_categories];
        return view('adm.pages.category.index', $data);
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = ['parent_categories' =>  $this->parent_categories];
        return view('adm.pages.category.create',$data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $request->validate([
            'kacheri_name' => 'required|max:255',
            'kacheri_description' => 'required|max:255',
        ]);

        $category = new Category;
        $category->name = $request->kacheri_name;
        $category->description  = $request->kacheri_description ;
        $category->address  = $request->kacheri_address ;
        $category->parent_id  = 0;
        $save = $category->save();

        if($save){
            return back()->with('success', 'New Kacheri Added...');
        }else{
            return back()->with('fail', 'Something went wrong, try again later...');
        }
    }

    public function petaKacheriStore(Request $request)
    {
        // dd($request->input());
        $request->validate([
            'petaKacheri_name' => 'required|max:255',
            'petaKacheri_description' => 'required|max:255',
            'kacheri_parent_id1' => 'required',
            
        ]);

        $category = new Category;
        $category->name = $request->petaKacheri_name;
        $category->description  = $request->petaKacheri_description ;
        $category->address  = $request->petaKacheri_address ;
        $category->parent_id  = $request->kacheri_parent_id1;
        $save = $category->save();

        if($save){
            return back()->with('success', 'New Peta Kacheri Added...');
        }else{
            return back()->with('fail', 'Something went wrong, try again later...');
        }
    }


    public function departmentStore(Request $request)
    {
        // dd($request->input());
        $request->validate([
            'department_name' => 'required|max:255',
            'department_description' => 'required|max:255',
            'kacheri_parent_id' => 'required',
            'petaKacheri_parent_id' => 'required',
            
        ]);

        $category = new Category;
        $category->name = $request->department_name;
        $category->description  = $request->department_description ;
        $category->address  = $request->department_address ;
        $category->parent_id  = $request->petaKacheri_parent_id;
        $save = $category->save();

        if($save){
            return back()->with('success', 'New Department Added...');
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
    public function edit(Request $request, $id)
    {
        $data = ['type'=> $request->type, 'parent_categories' =>  $this->parent_categories,
                 'data'=> Category::where('id', $id)->first()];

        // dd(Category::where('id', $id)->first());
        return view('adm.pages.category.edit',$data);
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
        // dd($request->input());

        if($request->type == 'kacheri'){
            $request->validate([
                'kacheri_name' => 'required|max:255',
                'kacheri_description' => 'required|max:255',
            ]);
            $category = Category::find($id);
            $category->name = $request->kacheri_name;
            $category->description  = $request->kacheri_description ;
            $category->address  = $request->kacheri_address ;
            $category->parent_id  = 0;
            $save = $category->save();

            if($save){
                return back()->with('success', 'Kacheri Updated...');
            }else{
                return back()->with('fail', 'Something went wrong, try again later...');
            }
        }

        if($request->type == 'peta_kacheri'){
            $request->validate([
                'petaKacheri_name' => 'required|max:255',
                'petaKacheri_description' => 'required|max:255',
                'kacheri_parent_id1' => 'required',
                
            ]);

            $category = Category::find($id);
            $category->name = $request->petaKacheri_name;
            $category->description  = $request->petaKacheri_description ;
            $category->address  = $request->petaKacheri_address ;
            $category->parent_id  = $request->kacheri_parent_id1;
            $save = $category->save();

            if($save){
                return back()->with('success', 'New Peta Kacheri Added...');
            }else{
                return back()->with('fail', 'Something went wrong, try again later...');
            }
        }


        if($request->type == 'department'){

            $request->validate([
                'department_name' => 'required|max:255',
                'department_description' => 'required|max:255',
                'kacheri_parent_id' => 'required',
                'petaKacheri_parent_id' => 'required',
                
            ]);

            $category = Category::find($id);
            $category->name = $request->department_name;
            $category->description  = $request->department_description ;
            $category->address  = $request->department_address ;
            $category->parent_id  = $request->petaKacheri_parent_id;
            $save = $category->save();

            if($save){
                return back()->with('success', 'New Department Added...');
            }else{
                return back()->with('fail', 'Something went wrong, try again later...');
            }
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category->delete();
    }
}
