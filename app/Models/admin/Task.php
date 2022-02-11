<?php

namespace App\Models\admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;

class Task extends Model
{
    use HasFactory;

    function client(){
        return $this->belongsTo(Client::class);
    }
    function client1(){
        return $this->belongsTo(Client::class);
    }

    function category(){
        return $this->belongsTo(Category::class);
    }
    
    public function parentCategories1($id){
        $data = Category::find($id);
        $data2 = DB::table('categories')
        ->where('id',$data->parent_id)
        ->first();

        return $data2;
    }

    public function parentCategories2($id){
        $parentCategories1 = DB::table('categories')
        ->where('id',$id)
        ->first();

        $data = DB::table('categories')
        ->where('id',$parentCategories1->parent_id)
        ->get();
        return $data;
    }

    public function subCategories1($id){
        $data = Category::find($id);
        // dd($data->parent_id);
        return $data;
    }
    
    public function getChildCategory($id){
        $data2 = DB::table('categories')
        ->where('parent_id',$data->parent_id)
        ->get();

        return($data2);
    }

    public function subCategories2($id){

        $data = Category::find($id);
        

        $data2 = DB::table('categories')
        ->where('id',$data->parent_id)
        ->first();

        // dd($data2);

        $data3 = DB::table('categories')
        ->where('parent_id',$data2->id)
        ->first();
        
        // dd($data3);
        return $data3;
    }
    public function getKacheriCategory($id){

        $data = Category::find($id);
        if($data->parent_id != 0){
            $data2 = DB::table('categories')
            ->where('id',$data->parent_id)
            ->first();

            return $data2;
            
            if($data2->parent_id != 0){
                $data3 = DB::table('categories')
                ->where('id',$data->parent_id)
                ->first();
                return $data3;
                
            }else{
                return $data2;
            }
        }else{
            return $data;
        }
    }

    public function getPetaKacheriCategory($id){

        $data = Category::find($id);
        if($data->parent_id != 0){
            $data2 = DB::table('categories')
            ->where('parent_id',$data->parent_id)
            ->first();
            // dd($data2);
            return $data2;
        }else{
            return $data;
        }

    }
    

    function getParent($id){
        
        $kacheri = Category::find($id);

        if(isset($kacheri)){
            if($kacheri->parent_id == 0){
                return (['kacheri'=>$kacheri, 'petaKacheri' => null, 'department' => null]);
            }
            else{
                $petaKacheri = Category::find($kacheri->parent_id);
                
                if(isset($petaKacheri))
                    if($petaKacheri->parent_id == 0){
                        return (['kacheri'=>$petaKacheri, 'petaKacheri' => $kacheri, 'department' => null]);
                    }else{
                        $department = Category::find($petaKacheri->parent_id);
                        return(['kacheri'=>$department, 'petaKacheri' => $petaKacheri, 'department' => $kacheri]);
                }
            }
        }
    }


    // public function getParent($id, $category_type){
    //     // dd($category_type);

    //     $data = Category::find($id);

    //     if($category_type == 'kacheri'){
            
    //         $data2 = DB::table('categories')
    //         ->where('id',$data->parent_id)
    //         ->first();

    //         $data3 = DB::table('categories')
    //         ->where('id',$data2->parent_id)
    //         ->first();
    //         // dd($data3);

    //         return $data3;


    //     }
    //     elseif($data->parent_id != 0 && $category_type == 'peta_kacheri'){
    //         $data2 = DB::table('categories')
    //         ->where('id',$data->parent_id)
    //         ->first();
    //         return $data2;
    //     }
    //     elseif($data->parent_id != 0 && $category_type == 'department'){

    //         return $data;
    //     }

    // }
    
    

    function getParentCategory($id){

        $data = DB::table('categories')
        ->where('id',$id)
        ->first();
        // dd($data);
        return $data;
        
        // response()->json($data);
        // return response()->json($data[0]->name);
        // return response()->json($data);
         
    }
    
}
