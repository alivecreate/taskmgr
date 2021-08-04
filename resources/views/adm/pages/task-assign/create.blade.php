@extends('adm.layout.admin-index')
@section('title','Dashboard - Charotar Corporation')

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
            <h1>ADD Task: કામગીરી / ટાસ્ક </h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{url('admin')}}">Home</a></li>
              <li class="breadcrumb-item active">Task</li>
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
                          action="{{route('task-assign.store')}}">
                          
                        @csrf
                    <div class="form-group row">
                    
                        <div class="col-sm-4">
                            <label for="text">ટાસ્ક</label>
                            <select name="task_id" class="form-control task_id">
                              <option value="">ટાસ્ક સિલેક્ટ કરો</option>
                                @foreach($tasks as $task)
                                    <option value="{{$task->id}}">{{$task->id}}). {{$task->name}} ({{$task->client->name}})</option> 
                                @endforeach

                            </select>
                            <span class="text-danger">@error('date') {{$message}} @enderror</span>
                        </div>

                        <input type="hidden" name="admin_id" value="{{session('LoggedUser')->id}}">
                        <input type="hidden" name="status_id" value="1">

                        <div class="col-sm-3">
                          <label for="text">નોંધ નં</label>
                          <input type="text" class="form-control" name="note_no"
                            placeholder="નોંધ નં" value="{{old('note_no')}}">
                        </div>

                        <div class="col-sm-3">
                          <label for="text">આજની તારીખ</label>
                          <input type="text" class="form-control" name="type" disabled
                            placeholder="આજની તારીખ" value="{{today_date()}}">
                        </div>

                      </div>

                          <div class="form-group row">
                            
                              <div class="col-sm-6">
                                <label for="text">કામગીરી વ્યક્તિ</label>
                                <select name="employee_id" class="form-control employee_id">
                                  <option value="">કચેરી સિલેક્ટ કરો</option>
                                    @foreach($employees as $employee)
                                        <option value="{{$employee->id}}">{{$employee->name}}</option>
                                    @endforeach
                                </select>
                                <span class="text-danger">@error('date') {{$message}} @enderror</span>
                              </div>
                              
                              <div class="col-sm-6">
                                <label for="type">પ્રકાર</label>
                                  <input type="text" class="form-control" name="type" 
                                    placeholder="પ્રકાર" value="{{old('type')}}">
                                <span class="text-danger">@error('type') {{$message}} @enderror</span>
                              </div>
                            
                          </div>

                          <div class="form-group row">
                            <div class="col-sm-6">
                              <label for="description">વિગત</label>
                                <input type="text" class="form-control" name="description" 
                                  placeholder="વિગત" value="{{old('description')}}">
                              <span class="text-danger">@error('description') {{$message}} @enderror</span>
                          </div>


                        <div class="col-sm-3">
                          <label for="date_inward">ઇન્વર્ડ તારીખ</label>
                            <input type="date" class="form-control" name="date_inward" 
                              placeholder="તારીખ" value="{{old('date_inward')}}">
                          <span class="text-danger">@error('date_inward') {{$message}} @enderror</span>
                        </div>
                      
                        <div class="col-sm-3">
                          <label for="date_check">તપાસ તારીખ</label>
                            <input type="date" class="form-control" name="date_check" 
                              placeholder="તારીખ" value="{{old('date_check')}}">
                          <span class="text-danger">@error('date_check') {{$message}} @enderror</span>
                        </div>
                    </div>




                    <div class="form-group row">
                      <div class="col-sm-6">
                        <label for="file_live_status">ફાઇલ લાઇવ સ્ટેટસ</label>
                          <input type="text" class="form-control" name="file_live_status" 
                            placeholder="ફાઇલ લાઇવ સ્ટેટસ" value="{{old('file_live_status')}}">
                        <span class="text-danger">@error('file_live_status') {{$message}} @enderror</span>
                      </div>
                      
                      <div class="col-sm-6">
                        <label for="computer_file_status">કોમ્પ્યૂટર ફાઇલ સ્ટેટસ</label>
                          <input type="text" class="form-control" name="computer_file_status" 
                            placeholder="કોમ્પ્યૂટર ફાઇલ સ્ટેટસ" value="{{old('computer_file_status')}}">
                        <span class="text-danger">@error('computer_file_status') {{$message}} @enderror</span>
                      </div>


                      <div class="col-sm-6">
                        <label for="cupboard_file_status">કબાટ ફાઇલ સ્ટેટસ</label>
                          <input type="cupboard_file_status" class="form-control" name="cupboard_file_status" 
                            placeholder="કબાટ ફાઇલ સ્ટેટસ" value="{{old('cupboard_file_status')}}">
                        <span class="text-danger">@error('cupboard_file_status') {{$message}} @enderror</span>
                      </div>
                      
                    </div>



                  <div class="card-footer container">
                    <button type="submit" class="btn btn-info float-right"><i class="fas fa-save"></i>&nbsp;&nbsp;ટાસ્ક સેવ કરો</button>
                  </div>
                  </form>
                  </div>



          </div>
        </div>


      </div>
    </section>
  </div>

  @endsection
