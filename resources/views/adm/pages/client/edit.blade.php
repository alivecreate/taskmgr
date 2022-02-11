@extends('adm.layout.admin-index')
@section('title','Dashboard - Task Manager')

@section('toast')
  @include('adm.widget.toast')
@endsection


@section('custom-js')

<script>

$(".client").addClass( "menu-is-opening menu-open");
$(".client a").addClass( "active-menu");

</script>
@endsection
@section('content')

<div class="content-wrapper">
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>ADD Client: અરજદાર  </h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{url('admin')}}">Home</a></li>
              <li class="breadcrumb-item active">Client</li>
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
                action="{{route('client.update', $client->id)}}">
                @csrf
                @method('PUT')
                  <div class="form-group row">
                    <div class="col-sm-6">
                      <label for="name"><span class="text-danger">*</span> અરજદારનું નામ</label>
                      <input type="text" class="form-control" name="name" 
                         placeholder="અરજદારનું નામ"                          
                         value="@if(old('name')){{old('name')}}@else{{$client->name}}@endif">

                         
                    <span class="text-danger">@error('name') {{$message}} @enderror</span>
                    </div>

                    <div class="col-sm-6">
                      <label for="ref_name">રેફરેન્સનું નામ</label>
                      <input type="text" class="form-control" name="ref_name" 
                         placeholder="રેફરેન્સનું નામ"                                               
                         value="@if(old('ref_name')){{old('ref_name')}}@else{{$client->ref_name}}@endif">

                         
                    <span class="text-danger">@error('ref_name') {{$message}} @enderror</span>
                    </div>

                  </div>
                  
                  <div class="form-group row">
                  <div class="col-sm-6 row">
                  
                    <div class="col-sm-6">
                        <label for="phone1"><span class="text-danger">*</span>  ફોન નં 1</label>
                        <input type="text" class="form-control" name="phone1" 
                          placeholder="અરજદારનું ફોન નં"                                                
                         value="@if(old('phone1')){{old('phone1')}}@else{{$client->phone1}}@endif">

                      <span class="text-danger">@error('phone1') {{$message}} @enderror</span>
                      </div>

                      <div class="col-sm-6">
                        <label for="phone2">ફોન નં 2</label>
                        <input type="text" class="form-control" name="phone2" 
                          placeholder="અરજદારનું ફોન નં"                                                
                         value="@if(old('phone2')){{old('phone2')}}@else{{$client->phone2}}@endif">

                      <span class="text-danger">@error('phone2') {{$message}} @enderror</span>
                      </div>
                    </div>
                    
                      <div class="col-sm-6">
                        <div class="col-sm-12">
                          <label for="ref_phone">રેફરેન્સ ફોન નં</label>
                          <input type="text" class="form-control" name="ref_phone" 
                            placeholder="રેફરેન્સ ફોન નં"                                                 
                            value="@if(old('ref_phone')){{old('ref_phone')}}@else{{$client->ref_phone}}@endif">

                        <span class="text-danger">@error('ref_phone') {{$message}} @enderror</span>
                        </div>
                      </div>

                  </div>

                  
                  <div class="form-group row">
                  

                  <div class="col-sm-6">
                      <label for="email">ઇમેઇલ</label>
                        <input type="text" class="form-control" name="email" 
                          placeholder="અરજદાર ઇમેઇલ"                                                  
                          value="@if(old('email')){{old('email')}}@else{{$client->email}}@endif">

                      <span class="text-danger">@error('email') {{$message}} @enderror</span>
                    </div>
                    
                  <div class="col-sm-6">
                      <label for="ref_email">રેફરેન્સ ઇમેઇલ</label>
                        <input type="text" class="form-control" name="ref_email" 
                          placeholder="રેફરેન્સ ઇમેઇલ"                                                   
                          value="@if(old('ref_email')){{old('ref_email')}}@else{{$client->ref_email}}@endif">

                      <span class="text-danger">@error('ref_email') {{$message}} @enderror</span>
                    </div>
                    
                  </div>

                  <div class="form-group row">
                    <div class="col-sm-4">
                      <label for="address">સરનામું</label>
                        <textarea type="text" class="form-control" name="address" 
                          placeholder="અરજદારનું સરનામું">@if(old('address')){{old('address')}}@else{{$client->address}}@endif</textarea>
                      <span class="text-danger">@error('address') {{$message}} @enderror</span>
                    </div>

                    <div class="col-sm-4">
                      <label for="note">નોંધ</label>
                        <textarea type="text" class="form-control" name="note" 
                          placeholder="નોંધ">@if(old('note')){{old('note')}}@else{{$client->note}}@endif</textarea>
                      <span class="text-danger">@error('note') {{$message}} @enderror</span>
                    </div>

                    <div class="col-sm-4">
                      <label for="image">ફોટોગ્રાફ</label>
                      <br>
                        <input type="file" name="image" value="{{old('image')}}">

                        <input type="hidden" name="old_image" value="{{$client->image}}">
                          @if($client->image)
                          <img class="img-circle elevation-2 object-fit-sm" 
                            src="{{asset('web')}}/media/lg/{{$client->image}}">
                            @else
                            
                        <img class="img-circle elevation-2 object-fit-sm" 
                            src="{{asset('adm')}}/img/no-user.jpeg">
                        @endif

                      <span class="text-danger">@error('image') {{$message}} @enderror</span>
                    </div>
                    
                  </div>

                  <div class="card-footer">
                  <button type="submit" class="btn btn-info">
                  <i class="fas fa-save"></i>
                  અરજદાર સેવ કરો</button>
                </div>
                  </div>

              </form>



          </div>
        </div>


      </div>
    </section>
  </div>

  @endsection
