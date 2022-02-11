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
    $('.category_id').val(parent);

    
       
    });


    $('.petaKacheri_parent_id').on('change', function() {
        var parent = $(this).find(':selected').val();
    // alert(parent);

        $.get( `{{url('api')}}/get/getDepartment/`+parent, { petaKacheri_parent_id: parent })
        .done(function( data ) {
          // alert(JSON.stringify(data));

        if(JSON.stringify(data.length) == 0){
            $('.department_id').html('<option>ડિપાર્ટમેન્ટ સિલેક્ટ કરો</option>');
        }
        else{
                $('.department_id').empty();     
            $('.department_id').html('<option value="">ડિપાર્ટમેન્ટ સિલેક્ટ કરો</option>');
            for(var i = 0 ; i < JSON.stringify(data.length); i++){  
                $('.department_id').append('<option value='+JSON.stringify(data[i].id)+'>'+ data[i].name +'</option>')
            }
        }
    });
    
    $('.category_id').val(parent);
       
    });
    
    $('.department_id').on('change', function() {
        var parent = $(this).find(':selected').val();
        $('.category_id').val(parent);
       
    });

    
$(".task-assign").addClass( "menu-is-opening menu-open");
$(".task-assign a").addClass( "active-menu");



</script>
@endsection
@section('content')


<div class="content-wrapper">
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Edit: કામગીરી પત્રક / ટાસ્કને એડિટ કરો </h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{url('admin')}}">Home</a></li>
              <li class="breadcrumb-item active">કામગીરી પત્રક</li>
              <li class="breadcrumb-item active">
              <a href="{{route('task-assign.show',$taskAssign->id)}}"></a></li>

              
                        
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

                  <h3 class="alert-primary text-center">કામગીરી પત્રક</h3>
              
                  <form enctype="multipart/form-data" method="post" class="form-horizontal" 
                        action="{{route('task-assign.update', $taskAssign->id)}}">
                        <input type="hidden" name="task_id" value="{{$taskAssign->task_id}}">
                      @csrf
                @method('PUT')
                  <div class="form-group row">    
                      
                      <div class="col-sm-7">
                          <label for="text">ટાસ્ક</label>
                          <input type="text"  class="form-control"  
                          value="{{$taskAssign->description}} ({{$taskAssign->task($taskAssign->task_id)->name}})" disabled>

                          <span class="text-danger">@error('date') {{$message}} @enderror</span>
                      </div>

                      <input type="hidden" name="admin_id" value="{{session('LoggedUser')->id}}">
                     

                      <div class="col-sm-3">
                        <label for="text">આજની તારીખ</label>
                        <input type="text" class="form-control" name="type" disabled
                          placeholder="આજની તારીખ" 
                          value="{{$taskAssign->created_at}}">
                      </div>

                    </div>

                        <div class="form-group row">
                          
                    <div class="col-sm-12">
                      <div class="select2-purple">
                                <label for="text">કામગીરી વ્યક્તિ</label>
                            <select name="employee_id[]" class="select2" multiple="multiple" 
                              data-placeholder="Select a categories" 
                              data-dropdown-css-class="select2-purple" style="width: 100%;">
                              
                              
                                  <option value="">કામગીરી વ્યક્તિ સિલેક્ટ કરો</option>

                                  @if($employees)
                                      @foreach($employees as $employee)`
                                          <option value="{{$employee->id}}"
                                              
                                            <?php
                                              $employeeArrs = explode(',', $taskAssign->admin_group);
                                              foreach($employeeArrs as $employeeArr){
                                                if($employeeArr == $employee->id)
                                                echo 'selected';
                                              }
                                            ?>
                                          >{{$employee->name}}</option>
                                      @endforeach
                                  @endif

                              </select>
                          
                        </div>
                        </div>
                        </div>

                            <div class="col-sm-12">
                              <label for="type">પ્રકાર</label>
                                <input type="text" class="form-control" name="type" 
                                  placeholder="પ્રકાર" 
                                  
                               value="@if(old('type')){{old('type')}}@else{{$taskAssign->type}}@endif">
                         
                              <span class="text-danger">@error('type') {{$message}} @enderror</span>
                            </div>

                        <div class="form-group row">
                          <div class="col-sm-6">
                            <label for="description">વિગત</label>
                              <input type="text" class="form-control" name="description" 
                                placeholder="વિગત" 
                                value="@if(old('description')){{old('description')}}@else{{$taskAssign->description}}@endif">
                            <span class="text-danger">@error('description') {{$message}} @enderror</span>
                         </div>


                      <div class="col-sm-3">
                        <label for="date_inward">ઇન્વર્ડ તારીખ</label>
                          <input type="date" class="form-control" name="date_inward" 
                            placeholder="તારીખ" 
                            value="@if(old('date_inward')){{old('date_inward')}}@else{{$taskAssign->date_inward}}@endif">
                        <span class="text-danger">@error('date_inward') {{$message}} @enderror</span>
                      </div>
                    
                      <div class="col-sm-3">
                        <label for="date_check">તપાસ તારીખ</label>
                          <input type="date" class="form-control" name="date_check" 
                            placeholder="તારીખ" 
                            value="@if(old('date_check')){{old('date_check')}}@else{{$taskAssign->date_check}}@endif">
                        <span class="text-danger">@error('date_check') {{$message}} @enderror</span>
                      </div>
                  </div>




                  <div class="form-group row">
                    <div class="col-sm-6">
                      <label for="file_live_status">ફાઇલ લાઇવ સ્ટેટસ</label>
                        <input type="text" class="form-control" name="file_live_status" 
                          placeholder="ફાઇલ લાઇવ સ્ટેટસ" 
                            value="@if(old('file_live_status')){{old('file_live_status')}}@else{{$taskAssign->file_live_status}}@endif">
                      <span class="text-danger">@error('file_live_status') {{$message}} @enderror</span>
                    </div>
                    
                    <div class="col-sm-6">
                      <label for="computer_file_status">કોમ્પ્યૂટર ફાઇલ સ્ટેટસ</label>
                        <input type="text" class="form-control" name="computer_file_status" 
                          placeholder="કોમ્પ્યૂટર ફાઇલ સ્ટેટસ" 
                            value="@if(old('computer_file_status')){{old('computer_file_status')}}@else{{$taskAssign->computer_file_status}}@endif">
                      <span class="text-danger">@error('computer_file_status') {{$message}} @enderror</span>
                    </div>


                    <div class="col-sm-6">
                      <label for="cupboard_file_status">કબાટ ફાઇલ સ્ટેટસ</label>
                        <input type="cupboard_file_status" class="form-control" name="cupboard_file_status" 
                          placeholder="કબાટ ફાઇલ સ્ટેટસ" 
                            value="@if(old('cupboard_file_status')){{old('cupboard_file_status')}}@else{{$taskAssign->cupboard_file_status}}@endif">
                      <span class="text-danger">@error('cupboard_file_status') {{$message}} @enderror</span>
                    </div>
                    
                  </div>



                  <div class="card-footer container">
                  <a href="{{route('task-assign.show',$taskAssign->id)}}" class="btn btn-warning float-right ml-2"><i class="fa fa-eye"></i>&nbsp;&nbsp;ચેટ ઓપન કરો</a>
                  
                    <button type="submit" class="btn btn-info float-right  ml-2"><i class="fas fa-save"></i>&nbsp;&nbsp;ટાસ્ક સેવ કરો</button>
                    </div>
                  </form>
                  </div>



          </div>
        </div>


      </div>
    </section>
  </div>

  @endsection
