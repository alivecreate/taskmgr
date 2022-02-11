@extends('adm.layout.admin-index')
@section('title','Edit - Category')

@section('toast')
  @include('adm.widget.toast')
@endsection

@section('custom-js')

<?php
$cat_type = '';
$cat_level = [];
  $parent_id = $data->parent_id;


if($parent_id == 0){
  $cat_type = 'category';
  $cat_level = ['category_name' => null, 'category' => null, 'subcategory' => null, 'subcategory2' => null, 'parent_id' =>0];
 
}
else{
  if($mainCategory = getParent($parent_id)->parent_id == 0){
    $cat_type = 'subcategory';
    $cat_level = ['category_name' => getParent($parent_id)->name, 'category' => getParent($parent_id)->id, 'subcategory' => null, 'subcategory2' => null, 'parent_id' =>getParent($parent_id)->id];
  }
  else{
      $cat_type = 'subcategory2';
      if($subCategory = (getParent(getParent($parent_id)->parent_id)->parent_id) == 0){
      $cat_level = ['category_name' => getParent(getParent($parent_id)->parent_id)->name, 'category' => getParent(getParent($parent_id)->parent_id)->id, 'subcategory' => getParent($parent_id)->id, 'subcategory_name' => getParent($parent_id)->name, 'subcategory2' => null, 'parent_id' => getParent($parent_id)->id];
      }

  }
}

// dd($cat_level['parent_id']);

// checkParent($parent_id){
//   if(getParent($parent_id)->parent_id == 0){
//     dd('main category');
//   }
//   else{
  
//     dd(getParent($parent_id));
//   }
// }



  // if(getParent($parent_id)->parent_id == 0 || getParent($parent_id)->parent_id == null){

  //   dd('main category');
  // }
 
  
// if($data->parent_id == 0){
//   $mainCategory = 0;
//   $subCategory = null;
//   dd($mainCategory);

// }else{
//   $sel1 = DB::table('categories')->where('id', $parent_id)->first();

//   // dd($sel1);

//   if($sel1->parent_id == 0){
//     $mainCategory = $sel1;
//     $subCategory = null;
//     dd($mainCategory);
//   }else{

//     $sel2 = DB::table('categories')->where('id', $sel1->parent_id)->first();
//     dd($sel2);

//     if($sel2->parent_id == 0){
//       $mainCategory = $sel2;
//     }else{
//       $sel3 = DB::table('categories')->where('id', $sel2->parent_id)->first();
//       if($sel3->parent_id == 0){
//         $mainCategory = $sel2;
//       }
//     }
//     dd($mainCategory);
//   }
// }
//   $subCategory = DB::where('parent_id', '!=', 0)->where('id', $id)->first();
  
//   if($subCategory){
//     $subCategory = DB::where('parent_id', $subCategory->id )->first();
//   }else{
//     $subCategory = null;
//   }
  
//   if($subCategory){

//     $subCategory = DB::where('parent_id', $subCategory->id )->first();
//     if($subCategory2){
//       $subCategory = DB::where('parent_id', $subCategory->id )->first();
//     }else{
//       $subCategory = null;
//     }
// }

?>

<script>
$('.category_parent_id').on('change', function() {
        var parent = $(this).find(':selected').val();
        
        $('.parent_id').val(parent);

        $.get( `{{url('api')}}/get/getPetaKacheri/`+parent, { category_parent_id: parent })
        .done(function( data ) {
        if(JSON.stringify(data.length) == 0){
            $('.subcategory_parent_id').html('<option>પેટાકચેરી સિલેક્ટ કરો</option>');
        }
        else{
                $('.subcategory_parent_id').empty();     
            $('.subcategory_parent_id').html('<option value="">પેટાકચેરી સિલેક્ટ કરો</option>');
            for(var i = 0 ; i < JSON.stringify(data.length); i++){  
                $('.subcategory_parent_id').append('<option value='+JSON.stringify(data[i].id)+'>'+ data[i].name +'</option>')
            }
        }
    });
  });

  $('.subcategory_parent_id').on('change', function() {
        var parent = $(this).find(':selected').val();
        if(parent == ''){
          var mainCat = $('.category_parent_id').find(':selected').val();
          
          $('.parent_id').val(mainCat);

        }else{
          $('.parent_id').val(parent);
        }

    });

    
$(".category").addClass( "menu-is-opening menu-open");
$(".category a").addClass( "active-menu");

</script>
@endsection
@section('content')


<div class="content-wrapper">
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-8">
            <h1>Edit Category: 
            

                @if(getParentCategory($data->id)['category']->parent_id == 0)
                  <span class='badge badge-primary p-1'>{{getParentCategory($data->id)['category']->name}}</span>
                  <?php $category = 0; ?>
                @else
                  <span class='badge badge-primary p-1'>{{getParentCategory($data->id)['category']->name}}</span>
                  <?php $category = getParentCategory($data->id)['category']->parent_id; ?>
                @endif

                
                @if(getParentCategory($data->id)['subcategory'])
                  <span class='badge badge-danger p-1'>{{getParentCategory($data->id)['subcategory']->name}}</span>
                @endif

                
                @if(getParentCategory($data->id)['subcategory2'])
                  <span class='badge badge-warning p-1'>{{getParentCategory($data->id)['subcategory2']->name}}</span>
                @endif

             </h1>
          </div>
          <div class="col-sm-4">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{url('admin')}}">Home</a></li>
              <li class="breadcrumb-item active">
                Category / Edit
              </li>
            </ol>
          </div>
        </div>
      </div>
    </section>

    <section class="content">
      <div class="container-fluid">
        <div class="card card-default">
        
          <div class="card-body">
            <div class="form-horizontal row">
            
            <div class="col-md-12 card card-info">
                 
              <div class="card card-info">
              <div class="card-header">
                <h3 class="card-title">Category Details</h3>
              </div>
             
              <form method="post" enctype="multipart/form-data" class="form-horizontal" 
              action="{{route('admin.category.update', $data->id)}}">
                @csrf
                <div class="card-body p-2 pt-4">
                  <div class="form-group row">
                    <div class="col-sm-6 pull-left">
                    <label for="client_id">નામ</label>
                      <input type="hidden" name="type" value="name">
                      <input type="text" class="form-control" name="name" 
                         placeholder="નામ" 
                          value="@if(old('name')){{old('name')}}@else{{$data->name}}@endif">
                         
                    <span class="text-danger">@error('category') {{$message}} @enderror</span>
                    </div>
                    <div class="col-sm-6 pull-left">
                    <label for="client_id">વિસ્તારનું નામ</label>
                      <input class="form-control" name="address"
                         placeholder="વિસ્તાર" value="@if(old('address')){{old('address')}}@else{{$data->address}}@endif">
                    <span class="text-danger">@error('address') {{$message}} @enderror</span>
                    </div>
                  </div>
                  
                  <div class="form-group row">
                    <div class="col-sm-6">
                    <label for="client_id">કચેરી</label>
                    
                      <select name="category_parent_id" class="form-control category_parent_id">

                        <option value="0">કચેરી સિલેક્ટ કરો</option>

                          @foreach($categories as $parent_category)
                              <option value="{{$parent_category->id}}"
                      
                                @if($cat_level['category'] == $parent_category->id )
                                  selected
                                @endif
                              

                              >{{$parent_category->name}}</option>
                          @endforeach

                      </select>
                      <span class="text-danger">@error('category_parent_id') {{$message}} @enderror</span>
                    </div>

                    <div class="col-sm-6">
                    <label for="client_id">પેટાકચેરી</label>
                      <select name="subcategory_parent_id"  class="form-control subcategory_parent_id">
                        
                        @if($cat_level['subcategory'])
                          <option value="{{$cat_level['subcategory']}}">{{$cat_level['subcategory_name']}}</option>
                        @else
                          <option value="0">પેટાકચેરી સિલેક્ટ કરો</option>
                        @endif
                        

                      </select>
                      <span class="text-danger">@error('subcategory_parent_id') {{$message}} @enderror</span>
                    </div>
                  </div>

                  <input type="hidden" name="parent_id" class="parent_id"value="{{$cat_level['parent_id']}}">
                 


                <div class="card-footer">
                  <button type="submit" class="float-right btn btn-info">
                  <i class="fas fa-save"></i>&nbsp;&nbsp;
                    કેટેગરીને એડ કરો</button>
                </div>
              </form>
            </div>

          </div>
        </div>


      </div>
    </section>
  </div>

  @endsection
