<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\admin\Category;
use DB;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct(){
        $this->parent_categories = category::where(['parent_id'=>0])->whereNotIn('id', [0])->orderBy('id','DESC')->get();
    }
    

    public function index()
    {
        
        $data = ['parent_categories' =>  $this->parent_categories];
        return view('adm.pages.category.index', $data);
        
    }

    public function viewAll()
    {
        
        $data = ['parent_categories' =>  $this->parent_categories, 'treeCategories' => getCategoryTree()];
        return view('adm.pages.category.index-old', $data);
        
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
        // dd($request->input());
        $request->validate([
            'name' => 'required',
        ]);

        
        $category = new Category;
        $category->name = $request->name;
        $category->address  = $request->address ;
        $category->parent_id  = $request->parent_id ;
        
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
        $category->address  = $request->petaKacheri_description ;
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
        $category->address  = $request->department_description ;
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
        

        $category = Category::where('id', $id)->first();
        
        $data = ['type'=> $request->type, 
                'categories' =>  category::where(['parent_id'=>0])->whereNotIn('id',[$id])
                                ->orderBy('id','DESC')->get(),
                
                 'data'=> $category ];


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

        // dd($request->input());

        $category = Category::find($id);
        $category->name = $request->name;
        $category->address = $request->address;

        $category->parent_id  = $request->parent_id;
        $save = $category->save();

        if($save){
            return back()->with('success', 'Data Updated...');
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
    public function destroy(Category $category)
    {
        dd($request->input());
        $category->delete();
    }
    public function deleteCategory($id)
    {
        // dd('testing del');
        // dd(getParents($id));

        // dd($id);
        // $category->delete();
        
        $checkCurrent = DB::table('categories')->where('id', $id)->first();
        // dd($checkCurrent);
        checkProductIsEXist($checkCurrent->id);
        $checkSubCategories = DB::table('categories')->where('parent_id', $checkCurrent->id)->get();
        //del main
        DB::table('categories')->where('id', $id)->delete();
        if($checkSubCategories->count() > 0){
            foreach($checkSubCategories as $checkSubCategory){
                checkProductIsEXist($checkSubCategory->id);
                //del sub cateogry
                DB::table('categories')->where('id', $checkSubCategory->id)->delete();
                $checkSubCategories2 = DB::table('categories')->where('parent_id', $checkSubCategory->id)->get();
                if($checkSubCategories2->count() > 0){
                    foreach($checkSubCategories2 as $checkSubCategories22){
                        //del sub cateogry2
                        DB::table('categories')->where('id', $checkSubCategories22->id)->delete();
                        checkProductIsEXist($checkSubCategories22->id);
                    }
                }
            }
        }
        
        return back()->with('success', 'category Deleted...');
      
        
    }

}
