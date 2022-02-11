@extends('adm.layout.admin-index')
@section('title','ADD : કચેરી / પેટાકચેરી / ડિપાર્ટમેન્ટ')

@section('toast')
  @include('adm.widget.toast')
@endsection

@section('custom-js')

<script>
$('.category_parent_id').on('change', function() {
        var parent = $(this).find(':selected').val();
        
        // $('#sub-category label').text('પેટાકચેરી');
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

$('.category_option').on('change', function() {
  // alert('test');
        var category_option = $(this).find(':selected').val();

        if(category_option == 'main_category'){
        //   alert(category_option);
        

        $('#sub-category label').text('પેટાકચેરી');
       
          $('.name').text('કચેરીનું નામ');
          $('.sub-category').hide();
          $('.product-range').hide();
          $('.category-block').hide();
          
        }
        else if(category_option == 'sub_category'){
        //   alert(category_option);
        // $('.sub-category label span').text('પેટાકચેરી');

        $('.name').text('પેટાકચેરીનું નામ');
          $('.category-block').show();
          $('.sub-category').show();
          $('.product-range').hide();
        }
        else if(category_option == 'product_range'){
        //   alert(category_option);

          // $('.sub-category label span').text('પેટાકચેરી');
          // $('.product-range label span').text('ડિપાર્ટમેન્ટ');
          $('.name').text('ડિપાર્ટમેન્ટનું નામ');
          $('.category-block').show();
          $('.sub-category').show();
          $('.product-range').show();
        }

    });


</script>
@endsection
@section('content')
<?php



?>

<div class="content-wrapper">
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-8">
            <h1>ADD : કચેરી / પેટાકચેરી / ડિપાર્ટમેન્ટ</h1>
          </div>
          <div class="col-sm-4">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{url('admin')}}">Home</a></li>
              <li class="breadcrumb-item active">Category</li>
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
             
              <form method="post"  enctype="multipart/form-data" class="form-horizontal" 
              action="{{route('admin.category.store')}}">
              
                @csrf
                <div class="card-body p-2 pt-4">

                
                <div class="form-group row">

                <div class="col-sm-6">
                  <label  for="slug"><span class=""></span>કચેરી ઓપ્શન સિલેક્ટ કરો</label>
                        <select name="category_option" class="form-control category_option">
                          <option value="main_category">કચેરી એડ કરો</option>
                          <option value="sub_category">પેટાકચેરી એડ કરો</option>
                          <option value="product_range">ડિપાર્ટમેન્ટ એડ કરો</option>
                        </select>
                  </div>
                  </div>
                
                <div class="form-group row category-block" style="display:none">
                    <div class="col-sm-6 sub-category"  style="display:none">
                      <label  for="slug"><span class=""></span>કચેરી</label>
                      <select name="category_parent_id" class="form-control category_parent_id">
                        <option value="0">કચેરી સિલેક્ટ કરો</option>

                          @foreach($parent_categories as $parent_category)
                              <option value="{{$parent_category->id}}"
                              
                              @if(old('category_parent_id') == $parent_category->id) selected @endif 
                              >{{$parent_category->name}}</option>
                          @endforeach

                      </select>
                      <span class="text-danger">@error('category_parent_id') {{$message}} @enderror</span>
                    </div>
                
                    <input type="hidden" name="parent_id" class="parent_id" 
                    value="@if(old('parent_id')) {{old('parent_id')}} @else 0 @endif"> 
                    

                    <div class="col-sm-6 product-range"  style="display:none">
                      <label  for="sub category"><span class=""></span>પેટાકચેરી</label>
                      <select name="subcategory_parent_id"  class="form-control subcategory_parent_id">
                      @if(old('subcategory_parent_id'))
                        <?php 
                          $old_subcategory_parent_id = '';
                          $old_subcategory_parent_id = old('subcategory_parent_id');
                          $subcategory_parent = DB::table('categories')->where('id', $old_subcategory_parent_id)->first() ;
                          
                        ?>
                        <option value="{{old('subcategory_parent_id')}}">{{$subcategory_parent->name}}</option>
                      @else
                        <option value="">પેટાકચેરી સિલેક્ટ કરો</option>
                      @endif



                      </select>
                      <span class="text-danger">@error('subcategory_parent_id') {{$message}} @enderror</span>
                    </div>
                  </div>


                  <div class="form-group row">
                    <div class="col-sm-6">
                      <label  for="name"><span class="text-danger">*</span><span class="name">કચેરીનું નામ</span></label>
                      <input type="hidden" name="type" value="name">
                      <input type="text" class="form-control" name="name" 
                         placeholder="નામ" value="{{old('name')}}" required>
                         
                    <span class="text-danger">@error('name') {{$message}} @enderror</span>
                    </div>

                    <div class="col-sm-6">
                      <label for="address">વિસ્તારનું નામ</label>

                        <input class="form-control"             
                        name="address" placeholder="વિસ્તાર" value="{{old('address')}}"
                        >
                                  
                    <span class="text-danger">@error('address') {{$message}} @enderror</span>
                    </div>
                    </div>
                    
                  </div>
                </div>


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
