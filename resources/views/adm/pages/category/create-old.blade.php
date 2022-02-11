@extends('adm.layout.admin-index')
@section('title','Dashboard - Task Manager')

@section('toast')
  @include('adm.widget.toast')
@endsection

@section('custom-js')

<script>
$('.kacheri_parent_id').on('change', function() {
        var parent = $(this).find(':selected').val();
    // alert(parent);

        $.get( `{{url('api')}}/get/getPetaKacheri/`+parent, { kacheri_parent_id: parent })
        .done(function( data ) {
          // alert(JSON.stringify(data));

        if(JSON.stringify(data.length) == 0){
            $('.petaKacheri_parent_id').html('<option>પેટાકચેરી સિલેક્ટ કરો</option>');
        }
        else{
                $('.petaKacheri_parent_id').empty();     
            $('.petaKacheri_parent_id').html('<option value="">પેટાકચેરી સિલેક્ટ કરો</option>');
            for(var i = 0 ; i < JSON.stringify(data.length); i++){  
                $('.petaKacheri_parent_id').append('<option value='+JSON.stringify(data[i].id)+'>'+ data[i].name +'</option>')
            }
        }
    });
        
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
          <div class="col-sm-6">
            <h1>ADD : કચેરી / પેટાકચેરી / ડિપાર્ટમેન્ટ  </h1>
          </div>
          <div class="col-sm-6">
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
            
            <div class="col-md-4 card card-info">
                 
              <div class="card card-info">
              <div class="card-header">
                <h3 class="card-title">કચેરી એડ કરો</h3>
              </div>
             
              <form method="post" class="form-horizontal" action="{{route('admin.category.store')}}">
                @csrf
                <div class="card-body p-2 pt-4">
                  <div class="form-group row">
                    <div class="col-sm-12">
                      <input type="hidden" name="type" value="kacheri">
                      <input type="text" class="form-control" name="kacheri_name" 
                         placeholder="કચેરીનું નામ" value="{{old('kacheri_name')}}">
                         
                    <span class="text-danger">@error('kacheri_name') {{$message}} @enderror</span>
                    </div>
                  </div>

                  <div class="form-group row">
                    <div class="col-sm-12">
                      <textarea class="form-control" name="kacheri_address"
                         placeholder="સરનામું">{{ old('kacheri_address') }}</textarea>
                    <span class="text-danger">@error('kacheri_address') {{$message}} @enderror</span>
                    </div>
                  </div>

                  </div>
                </div>

                <div class="card-footer">
                  <button type="submit" class="btn btn-info">પેટાકચેરી સેવ કરો</button>
                </div>
              </form>
            </div>


            <div class="col-md-4 card card-info">
       
              <div class="card card-danger">
              <div class="card-header">
                <h3 class="card-title">પેટાકચેરી એડ કરો</h3>
              </div>
             
              <form method="post" class="form-horizontal"  action="{{route('admin.category.petaKacheriStore')}}">
              
              <input type="hidden" name="type" value="peta_kacheri">
              @csrf
                <div class="card-body p-2 pt-4">
                  <div class="form-group row">
                    <div class="col-sm-12">
                      
                      <input type="text" class="form-control" name="petaKacheri_name"
                         placeholder="પેટાકચેરીનું નામ" value="{{@old(petaKacheri_name)}}">
                         <span class="text-danger">@error('petaKacheri_name') {{$message}} @enderror</span>
                    
                    </div>
                  </div>
                  
                  <div class="form-group row">
                    <div class="col-sm-12">
                      <select name="kacheri_parent_id1" class="form-control">
                        <option value="">કચેરી સિલેક્ટ કરો</option>
                          @foreach($parent_categories as $parent_category)
                              <option value="{{$parent_category->id}}">{{$parent_category->name}}</option>
                          @endforeach
                      </select>
                      <span class="text-danger">@error('kacheri_parent_id1') {{$message}} @enderror</span>
                    
                    </div>
                  </div>
                  
                  <div class="form-group row">
                    <div class="col-sm-12">
                      <textarea class="form-control" name="kacheri_address"
                         placeholder="સરનામું">{{ old('kacheri_address') }}</textarea>
                    <span class="text-danger">@error('kacheri_address') {{$message}} @enderror</span>
                    </div>
                  </div>

                  </div>
                </div>

                <div class="card-footer">
                  <button type="submit" class="btn btn-danger">કચેરી સેવ કરો</button>
                </div>
              </form>
            </div>

            <div class="col-md-4 card card-info">
              <div class="card card-warning">
              <div class="card-header">
                <h3 class="card-title">ડિપાર્ટમેન્ટ એડ કરો</h3>
              </div>
             
              <form method="post" class="form-horizontal" action="{{route('admin.category.departmentStore')}}">
              <input type="hidden" name="type" value="department">
              @csrf
                <div class="card-body p-2 pt-4">
                  <div class="form-group row">
                    <div class="col-sm-12">
                      
                      <input type="text" class="form-control" name="department_name"
                         placeholder="ડિપાર્ટમેન્ટનું નામ" value="{{@old('department_name')}}">
                         <span class="text-danger">@error('department_name') {{$message}} @enderror</span>
                    
                    </div>
                  </div>

                  <div class="form-group row">
                    <div class="col-sm-12">
                      <select name="kacheri_parent_id" class="form-control kacheri_parent_id">
                        <option value="">કચેરી સિલેક્ટ કરો</option>
                          @foreach($parent_categories as $parent_category)
                              <option value="{{$parent_category->id}}">{{$parent_category->name}}</option>
                          @endforeach
                      </select>
                      <span class="text-danger">@error('kacheri_parent_id') {{$message}} @enderror</span>
                    </div>
                  </div>
                  
                  <div class="form-group row">
                    <div class="col-sm-12">
                      <select name="petaKacheri_parent_id"  class="form-control petaKacheri_parent_id">
                        <option value="">પેટાકચેરી સિલેક્ટ કરો</option>
                      </select>
                      <span class="text-danger">@error('petaKacheri_parent_id') {{$message}} @enderror</span>
                    </div>
                  </div>
                  
                  <div class="form-group row">
                    <div class="col-sm-12">
                      <textarea class="form-control" name="kacheri_address"
                         placeholder="સરનામું">{{ old('kacheri_address') }}</textarea>
                    <span class="text-danger">@error('kacheri_address') {{$message}} @enderror</span>
                    </div>
                  </div>


                  </div>
                </div>

                <div class="card-footer">
                  <button type="submit" class="btn btn-warning">ડિપાર્ટમેન્ટ સેવ કરો</button>
                </div>
              </form>
            </div>


          </div>
        </div>


      </div>
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>

  @endsection
