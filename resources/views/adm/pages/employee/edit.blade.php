@extends('adm.layout.admin-index')
@section('title','Dashboard - Task Manager')

@section('toast')
  @include('adm.widget.toast')
@endsection

@section('custom-js')
<script>
  
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
            <h1>Edit: કર્મચારીને એડિટ કરો  </h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{url('admin')}}">Home</a></li>
              <li class="breadcrumb-item active">Employee</li>
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
                action="{{route('employee.update', $employee->id)}}">
                @csrf
                @method('PUT')
                  <div class="form-group row">
                    <div class="col-sm-6">
                      <label for="name"><span class="text-danger">*</span> કર્મચારીનું નામ</label>
                      <input type="text" class="form-control" name="name" 
                         placeholder="કર્મચારીનું નામ"  
                         value="@if(old('name')){{old('name')}}@else{{$employee->name}}@endif">

                    <span class="text-danger">@error('name') {{$message}} @enderror</span>
                    </div>
                    <div class="col-sm-6">
                      <label for="phone">ફોન નં</label>
                      <input type="text" class="form-control" name="phone" 
                         placeholder="ફોન નં" 
                         value="@if(old('phone')){{old('phone')}}@else{{$employee->phone}}@endif">

                    <span class="text-danger">@error('phone') {{$message}} @enderror</span>
                    </div>
                  </div>

                  
                  <div class="form-group row">
                    <div class="col-sm-6">
                      <label for="address"> ઇમેઇલ</label>
                        <input type="text" class="form-control" name="email"
                          placeholder="ઇમેઇલ" disabled
                          value="@if(old('email')){{old('email')}}@else{{$employee->email}}@endif">

                      <span class="text-danger">@error('email') {{$message}} @enderror</span>
                    </div>
                    
                    <div class="col-sm-6">
                      <label for="password"> પાસવર્ડ</label>
                        <input type="password" class="form-control" name="password" 
                          placeholder="******" 
                          value="@if(old('password')){{old('password')}}@endif">
                          <input type="hidden" name="old_password" value="{{$employee->password}}">

                      <span class="text-danger">@error('password') {{$message}} @enderror</span>
                    </div>
                  </div>
                  
                  <div class="form-group row">
                    <div class="col-sm-6">
                      <label for="address">સરનામું</label>
                        <input type="text" class="form-control" name="address" 
                          placeholder="સરનામું" 
                          value="@if(old('address')){{old('address')}}@else{{$employee->address}}@endif">

                      <span class="text-danger">@error('address') {{$message}} @enderror</span>
                    </div>
                    
                    <div class="col-sm-6">
                      <label for="code">કર્મચારી કોડ</label>
                        <input type="text" class="form-control" name="code" 
                          placeholder="કર્મચારી કોડ" disabled
                          value="@if(old('code')){{old('code')}}@else{{$employee->code}}@endif">

                      <span class="text-danger">@error('code') {{$message}} @enderror</span>
                    </div>
                  </div>

                  <div class="form-group row">
                    <div class="col-sm-6">
                      <label for="post">પોસ્ટ</label>
                        <input type="text" class="form-control" name="post" 
                          placeholder="પોસ્ટ"
                          value="@if(old('post')){{old('post')}}@else{{$employee->post}}@endif">

                      <span class="text-danger">@error('post') {{$message}} @enderror</span>
                    </div>
                    
                    <div class="col-sm-6">
                      <label for="image">ફોટો</label>
                      <br>
                        <input type="file" name="image" 
                          placeholder="ફોટો" value="{{old('image')}}">
                          <input type="hidden" name="old_image" value="{{$employee->image}}">
                          <br>
                        @if($employee->image)
                          <img class="img-circle elevation-2 object-fit-sm" 
                            src="{{asset('web')}}/media/lg/{{$employee->image}}">
                            @else
                            
                        <img class="img-circle elevation-2 object-fit-sm" 
                            src="{{asset('adm')}}/img/no-user.jpeg">
                        @endif

                      <span class="text-danger">@error('image') {{$message}} @enderror</span>
                    </div>
                  </div>

                  <div class="card-footer">
                  <button type="submit" class="btn btn-info">કર્મચારી સેવ કરો</button>
                </div>
                  </div>

              </form>



          </div>
        </div>


      </div>
    </section>
  </div>

  @endsection
