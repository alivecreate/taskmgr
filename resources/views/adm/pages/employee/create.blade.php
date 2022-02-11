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
$(".employee").addClass( "menu-is-opening menu-open");
$(".employee a").addClass( "active-menu");
</script>
@endsection
@section('content')


<div class="content-wrapper">
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>ADD: કર્મચારીને એડ કરો</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{url('admin')}}">Home</a></li>
              <li class="breadcrumb-item active">User</li>
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
            
            <div class="col-md-12">
                 
              <form enctype="multipart/form-data" method="post" class="form-horizontal" 
                action="{{route('employee.store')}}">
                @csrf
                  <div class="form-group row">
                    <div class="col-sm-6">
                      <label for="name"><span class="text-danger">*</span> કર્મચારીનું નામ</label>
                      <input type="text" class="form-control" name="name" 
                         placeholder="કર્મચારીનું નામ" value="{{old('name')}}">
                         
                    <span class="text-danger">@error('name') {{$message}} @enderror</span>
                    </div>
                    <div class="col-sm-6">
                      <label for="phone">ફોન નં</label>
                      <input type="text" class="form-control" name="phone" 
                         placeholder="ફોન નં" value="{{old('phone')}}">
                    <span class="text-danger">@error('phone') {{$message}} @enderror</span>
                    </div>
                  </div>
                  
                  <div class="form-group row">
                    <div class="col-sm-6">
                      <label for="address"><span class="text-danger">*</span> ઇમેઇલ</label>
                        <input type="text" class="form-control" name="email" 
                          placeholder="ઇમેઇલ" value="{{old('email')}}">
                      <span class="text-danger">@error('email') {{$message}} @enderror</span>
                    </div>
                    
                    <div class="col-sm-6">
                      <label for="password"><span class="text-danger">*</span> પાસવર્ડ</label>
                        <input type="text" class="form-control" name="password" 
                          placeholder="પાસવર્ડ" value="{{old('password')}}">
                      <span class="text-danger">@error('password') {{$message}} @enderror</span>
                    </div>
                  </div>

                  
                  <div class="form-group row">
                    <div class="col-sm-6">
                      <label for="address">સરનામું</label>
                        <input type="text" class="form-control" name="address" 
                          placeholder="સરનામું" value="{{old('address')}}">
                      <span class="text-danger">@error('address') {{$message}} @enderror</span>
                    </div>
                    
                    <div class="col-sm-6">
                      <label for="code">કર્મચારી કોડ</label>
                        <input type="text" class="form-control" name="code" 
                          placeholder="કર્મચારી કોડ" value="{{old('code')}}">
                      <span class="text-danger">@error('code') {{$message}} @enderror</span>
                    </div>
                  </div>

                  <div class="form-group row">
                    <div class="col-sm-6">
                      <label for="post">પોસ્ટ</label>
                        <input type="text" class="form-control" name="post" 
                          placeholder="પોસ્ટ" value="{{old('post')}}">
                      <span class="text-danger">@error('post') {{$message}} @enderror</span>
                    </div>
                    
                    <div class="col-sm-6">
                      <label for="image">ફોટો</label>
                      <br>
                        <input type="file" name="image" 
                          placeholder="ફોટો" value="{{old('image')}}">
                      <span class="text-danger">@error('image') {{$message}} @enderror</span>
                    </div>
                  </div>

                  <div class="card-footer">
                  <button type="submit" class="btn btn-info">કર્મચારીને એડ કરો</button>
                </div>
                  </div>

              </form>



          </div>
        </div>


      </div>
    </section>
  </div>

  @endsection
