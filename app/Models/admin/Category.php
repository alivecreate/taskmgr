<?php

namespace App\Models\admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;

class Category extends Model
{
    use HasFactory;


    public function subCategories1($id){
        $data = DB::table('categories')
        ->where('parent_id',$id)
        ->get();
        return $data;
    }

    public function subCategories2($id){
        $data = DB::table('categories')
        ->where('parent_id',$id)
        ->get();
        return $data;
    }

    // find parent category
    public function parentCategories1($id){
        $data = DB::table('categories')
        ->where('id',$id)
        ->get();
        dd($data);
        return $data;
        
    }

    public function parentCategories2($id){
        dd($id);
        $parentCategories1 = DB::table('categories')
        ->where('id',$id)
        ->first();

        $data = DB::table('categories')
        ->where('id',$parentCategories1->parent_id)
        ->get();
        return $data;
    }


    public function getParentCategories1($id){
        $data = DB::table('categories')
        ->where('id',$id)
        ->get();

        // $dataArray = array('data' => json_encode($data), true);
        
        // return response()->json(DB::table('categories')->where('id',$id)->first());
        
        return $data;

        // return json_decode(json_encode($data), true);
        // return json_decode(json_encode($nested_object), true);

        // return $dataArray;
        
    }
    

}
