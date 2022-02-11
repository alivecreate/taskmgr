@extends('adm.layout.admin-index')
@section('title','Dashboard - Task Manager')

@section('toast')
  @include('adm.widget.toast')
@endsection

@section('custom-js')
    <script>

        $( document ).ready(function() {
  $(".del-modal").click(function(){
    var delete_id = $(this).attr('data-id');
    var data_title = $(this).attr('data-title');
    
    $('.delete-form').attr('action', delete_id);
    $('.delete-title').html(data_title);
  });  
});


$(".task-assign").addClass( "menu-is-opening menu-open");
$(".task-assign a").addClass( "active-menu");

$('.selectEmployee').on('change', function() {
        var id = $(this).find(':selected').val();
        location.href = '?employee='+id;


});


$(document).ready(function () {
    $('html, body').animate({
        scrollTop: $('.content-header').offset().top
    }, 'slow');
});

$(document).ready(function () {
    $('.chat-box').animate({
        scrollTop: $('.last-msg-block').offset().top
    }, 'slow');
});


    </script>
@endsection

@section('content')
<?php

    $employeeArrs = explode(',', $taskAssign->admin_group);
    $chatEmployee = Request::get('employee');

    ?>

<div class="content-wrapper">
    <section class="content-header">
      <div class="container-fluid text-muted">
        <div class="row mb-2">
          <div class="col-sm-6">
          <h1>Detail: કામગીરી વ્યક્તિ / ટાસ્કની વિગત</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{url('admin')}}">Home</a></li>
              <li class="breadcrumb-item active">task</li>
            </ol>
          </div>
          
        </div>
      </div>
      
    </section>

    <section class="content">

            <div class="card">
            <div class="card-header">
                <h3 class="card-title">
                
              @if($taskAssign->getClient($taskAssign->task_id)->image)
                <img class="img-circle elevation-2 object-fit" height="30" width="30" 
                src="{{asset('web')}}/media/xs/{{$taskAssign->getClient($taskAssign->task_id)->image}}" alt=""> &nbsp;&nbsp;
              @else
                <img class="img-circle elevation-2"  height="30" width="30" src="{{url('adm')}}/img/no-user.jpeg">&nbsp;&nbsp;
              @endif
                {{$taskAssign->task($taskAssign->task_id)->name}} <span class="text-muted">({{$taskAssign->getClient($taskAssign->task_id)->name}})</span>
              
                </h3>
                
                <select class="col-sm-4 form-control selectEmployee ml-4 float-left">
                @if($taskAssign->admin_group)
                    <option value="0">કામગીરી વ્યક્તિ સિલેક્ટ કરો</option>
                @else
                    <option value="0">કામગીરી વ્યક્તિ એડ કરેલ નથી</option>
                @endif
                    @if($taskAssign->admin_group)
                        @foreach(getEmployees($taskAssign->admin_group) as $admin_group)
                            <option 
                                @if($chatEmployee == $admin_group->id)
                                    selected
                                @endif
                            value="{{$admin_group->id}}">{{$admin_group->name}}</option> 
                        
                        @endforeach
                    @endif
                
                </select>

                <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                    <i class="fas fa-minus"></i>
                </button>
                <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
                    <i class="fas fa-times"></i>
                </button>
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <!-- if not selected employee -->
                    

                <div class="col-12 col-md-12 col-lg-8 order-2 order-md-1">
                    
                    <div class="timeline no-before">
                        <div class="time-label">
                            <span class="bg-dark">ટાસ્ક આપ્યાની તારીખ:- {{dateFormat($taskAssign->created_at, 'd-M-Y')}} 
                                ({{dateFormatGujDay($taskAssign->created_at, 'l')}} - {{dateFormat($taskAssign->created_at, 'h:i A')}}) 
                            </span>
            
                            
                            <span class="float-right {{getStatusBgColor($taskAssign->taskStatus($taskAssign->id)->name)}}
                                                    
                                ">  સ્ટેટ્સ:- <span class="text-captalize">{{$taskAssign->taskStatus($taskAssign->id)->name}}</span>
                                &nbsp;

                                <button class="btn btn-xs btn-dark del-modal float-right"  title="Update task"  
                                    data-status="{{$taskAssign->name}}"
                                    data-toggle="modal" data-target="#modal-default"><i class="far fa-edit"></i>
                                </button>

                            </span>

                        </div>
                        <?php
                            
                        ?>

                        @if(Request::get('employee'))
                                <div>
                                    <div class="timeline-item m-0">
                    
                                        <div class="container chat-box">
                                            <div class="card card-outline direct-chat direct-chat-dark shadow-none">
                                                    
                                                    @foreach($taskAssign->getComments($taskAssign->id, $chatEmployee) as $key => $task_comment)
                                                        @if($task_comment->admin_id == session('LoggedUser')->id  && $task_comment->admin_to == $_REQUEST['employee'])
                           
                                                        <div class="direct-chat-msg @if($taskAssign->getComments($taskAssign->id, $chatEmployee)->count() == $key + 1) last-msg-block @endif ">
                                                            <div class="direct-chat-success clearfix">
                                                            <span class="direct-chat-name float-left text-secondary text-sm">{{$taskAssign->getCommentUser($task_comment->admin_id)->name}}</span>
                                                               
                                                                @if($task_comment->admin_id == session('LoggedUser')->id)
                                                                    <form class="float-right" action="{{route('admin.taskComment.delete',$task_comment->id)}}" method="post">
                                                                        @csrf
                                                                        <button class="mr-2 btn btn-tool"><i class="fas fa-trash-alt"></i></button>
                                                                    </form>
                                                                @endif

                                                            </span>
                                                            
                                                            </div>
                                
                                                            @if($taskAssign->getCommentUser($task_comment->admin_id)->image)
                                                            <img class="direct-chat-img" 
                                                            src="{{url('web')}}/media/icon/{{$taskAssign->getCommentUser($task_comment->admin_id)->image}}" alt="Message User Image">
                                                            @else
                                                            <img class="direct-chat-img img-circle elevation-2"  height="30" width="30" src="{{url('adm')}}/img/no-user.jpeg">  
                                                            @endif
                                
                                                            <div class="direct-chat-text p-2">
                                                                @if($task_comment->type == 'status')
                                                                    <span class="text-capitalize p-2 {{getStatusBgColor($task_comment->taskStatus($task_comment->comment)->name)}}">
                                                                        Status Updated: {{$task_comment->taskStatus($task_comment->comment)->name}}</span>
                                                                
                                                                @elseif($task_comment->type == 'file_upload')                                        
                                                                    <strong><i class="fa fa-file" aria-hidden="true"></i> File Uploaded:- </strong> {{$task_comment->comment}}<br>
                                                                @else
                                                                    {{$task_comment->comment}}
                                                                @endif

                                                                                           
                                                            @if($task_comment->admin_id == session('LoggedUser')->id)
                                                                <span class="float-right text-xs pt-2 text-dark">
                                                                    @if($task_comment->seen == 0)
                                                                        Not Seen
                                                                    @else
                                                                    <i class="far fa-calendar-alt"></i>&nbsp;{{dateFormat($task_comment->created_at, 'm-d-Y')}} &nbsp;<i class="fas fa-clock"></i>&nbsp; {{dateFormat($task_comment->created_at, 'h:i A')}} ({{dateFormatGujDay($task_comment->created_at, 'l')}})
                                                                    @endif
                                                                </span>
                                                            @endif
                                                            </div>
                                                        </div>
                                
                                                    @else
                                                        <div class="direct-chat-msg right comment-right">
                                                            <div class="direct-chat-infos clearfix">
                                                                <span class="direct-chat-timestamp float-left">{{dateFormat($task_comment->created_at, 'm-d-Y')}} {{dateFormatGujDay($task_comment->created_at, 'l')}}</span>
                                                                <span class="direct-chat-name  text-secondary float-right">{{$taskAssign->getCommentUser($task_comment->admin_id)->name}}</span>
                                                            
                                                            </div>
                                
                                                            @if($taskAssign->getCommentUser($task_comment->admin_id)->image)
                                                            <img class="direct-chat-img" 
                                                            src="{{url('web')}}/media/icon/{{$taskAssign->getCommentUser($task_comment->admin_id)->image}}" alt="Message User Image">
                                                            @else
                                                            <img class="direct-chat-img img-circle elevation-2"  height="30" width="30" src="{{url('adm')}}/img/no-user.jpeg">  
                                                            @endif
                                
                                                            <div class="direct-chat-text p-2">
                                                            <p class="col-md-12 mb-0">
                                                                @if($task_comment->type == 'status')                                            
                                                                <span class="text-capitalize p-2 {{getStatusBgColor($task_comment->taskStatus($task_comment->comment)->name)}}">
                                                                    Status Updated: {{$task_comment->taskStatus($task_comment->comment)->name}}</span>
                                                            
                                                                @elseif($task_comment->type == 'file_upload')                                        
                                                                    <strong><i class="fa fa-file" aria-hidden="true"></i> File Uploaded:- </strong> {{$task_comment->comment}}<br>
                                                                @else
                                                                    {{$task_comment->comment}}
                                                                @endif

                                                                
                                                            @if($task_comment->admin_id == session('LoggedUser')->id)
                                                                <span class="float-right text-xs pt-2 text-dark">
                                                                    @if($task_comment->seen == 0)
                                                                        Not Seen
                                                                    @else
                                                                    <span><i class="far fa-calendar-alt"></i>&nbsp;{{dateFormat($task_comment->created_at, 'm-d-Y')}} &nbsp;<i class="fas fa-clock"></i>&nbsp; {{dateFormat($task_comment->created_at, 'h:i A')}} ({{dateFormatGujDay($task_comment->created_at, 'l')}})</span>
                                                                    @endif
                                                                </span>
                                                            @endif

                                                            </p>

                                                            </div>
                                                        </div>
                                                    @endif
                                
                                                    @endforeach
                        
                                            </div>
                                        </div>

                                        
                                        <div class="timeline-body" background: #343a40;padding: 2px;margin-bottom: 7px;margin-top: 20px;>
                                        <form action="{{route('admin.taskComment.store')}}" method="post">
                                                @csrf
                                                <div class="input-group">
                                                <input type="hidden" name="admin_id" value="{{session('LoggedUser')->id}}">
                                                <input type="hidden" name="task_assign_id" value="{{$taskAssign->id}}">
                                                <input type="hidden" name="admin_to" value="{{$chatEmployee}}">
                                                <input type="hidden" name="admin_email" value="{{getEmployee(Request::get('employee'))->email}}">
                                                
                                                <input type="hidden" name="client_name"
                                                 value="{{$taskAssign->getClient($taskAssign->task_id)->name}}">

                                                <input type="hidden" name="client_photo"
                                                 value="{{asset('web')}}/media/xs/{{$taskAssign->getClient($taskAssign->task_id)->image}}">

                                                <textarea type="text" placeholder="Comment Here..." name="comment" class="form-control"
                                                 autocomplete="off"></textarea>
                                                <span class="input-group-append">
                                                    <button type="submit" class="btn btn-dark on-click-disable">Send</button>
                                                    <button type="button" class="btn btn-dark btn-processing" style="display:none" disabled>Send</button>
                                                </span>
                                                </div>
                                            </form>
                                        
                                        </div>


                                    </div>
                                </div>


                                @else

                                    @if($taskAssign->admin_group)
                                    
                                        <div>
                                        <hr class="my-4">
                                            <h4 class="text-danger text-center mt-4">કોમેન્ટ જોવા કામગીરી વ્યક્તિ  સિલેક્ટ કરો </h4 class="text-danger text-center mt-4">
                                        </div>
                                    @else

                                        <div class="text-center">
                                            <hr class="my-4">
                                            <h4 class="text-danger text-center mt-4">
                                            <i class="fa fa-exclamation-triangle" aria-hidden="true"></i>
                                            કામગીરી વ્યક્તિ એડ કરેલ નથી </h4 class="text-danger text-center mt-4">
                                       
                                        <a href="{{route('task-assign.edit',$taskAssign->id)}}" class="mt-4 btn btn-sm btn-info">
                                            <i class="far fa-edit"></i>&nbsp;&nbsp;&nbsp; <strong>કામગીરી વ્યક્તિ એડ કરો</strong></a>
                                        </div>
                                        
                                    @endif
                                @endif
                            
                        <div>
                        </div>
                        
                        
                        <div>
                        </div>
                        
                    </div>
        
                    </div> 


                        <div class="col-12 col-md-12 col-lg-4 order-1 order-md-2 timeline-right-block">
                                

                                <div class="container-fluid text-muted p-1">
                                    <label class="text-sm text-white bg-primary label-style1 pl-2 pr-2">વિગત: </label>
                                        <p class="mb-2">
                                            <span class="text-dark text-md">{{$taskAssign->description}}</span>
                                        </p>
                                </div>
                                <?php
$employeeArrs = explode(',', $taskAssign->admin_group);
$arrEmployeeData = [];

foreach($employeeArrs as $employeeArr){
    $getEmp = DB::table('admins')->where('id', $employeeArr)->first();

    $arrEmployeeData[] = $getEmp->name;
}

// dd($arrEmployeeData);

?>

                                <div class="container-fluid text-muted p-1">
                                    <label class="text-md text-white bg-primary label-style1 pl-2 pr-2">કામગીરી વ્યક્તિ:</label>
                                      
                                    @if($taskAssign->admin_group)
                                        @foreach($employeeArrs as $employeeArr)
                                            <a target="_blank" href="{{route('employee.edit', $taskAssign->getEmployee($employeeArr)->id)}}">
                                                <p class="mb-2">
                                                    @if(isset($taskAssign->getEmployee($employeeArr)->image))
                                                    <img  class="img-circle elevation-2 object-fit" height="30" width="30"
                                                    src="{{asset('web')}}/media/xs/{{$taskAssign->getEmployee($employeeArr)->image}}" alt=""> 
                                                    @else
                                                        <img class="img-circle elevation-2"  height="20" width="20" src="{{url('adm')}}/img/no-user.jpeg">
                                                    @endif

                                                <span class="text-dark text-md mb-0">{{$taskAssign->getEmployee($employeeArr)->name}}</span>
                                                </p>
                                            </a>
                                        @endforeach

                                    @endif

                                </div>


                                <div class="container-fluid text-muted p-1">
                                    <label class="text-sm text-white bg-primary label-style1 pl-2 pr-2">પ્રકાર: </label>
                                        <p class="mb-2">
                                            <span class="text-dark text-md">{{$taskAssign->type}}</span>
                                        </p>
                                </div>



                                <div class="row p-1">  
                                    <div class="col">
                                    <label class="text-sm text-white bg-primary label-style1 pl-2 pr-2 mb-0">ઇન્વર્ડ તારીખ:</label>  
                                        <p class="mb-2">
                                        <span class="text-dark text-md">{{$taskAssign->date_inward}}</span>
                                        </p>
                                    </div>

                                    <div class="col">
                                    <label class="text-sm text-white bg-primary label-style1 pl-2 pr-2 mb-0">તપાસ તારીખ:</label>
                                        <p class="mb-2">
                                        <span class="text-dark text-md">{{$taskAssign->date_check}}</span>
                                        </p>
                                    </div>
                                </div>

                                <div class="container-fluid text-muted p-1">                        
                                    <label class="text-sm text-white bg-primary label-style1 pl-2 pr-2 mb-0">ફાઇલ લાઇવ સ્ટેટસ:</label>
                                        <p class="mb-2">
                                            <span class="text-dark text-md">{{$taskAssign->file_live_status}}</span>
                                        </p>         
                                </div>

                                <div class="container-fluid text-muted p-1"> 
                                    <label class="text-sm text-white bg-primary label-style1 pl-2 pr-2">કોમ્પ્યૂટર ફાઇલ સ્ટેટસ:</label>
                                        <p class="mb-2">
                                            <span class="text-dark text-md">{{$taskAssign->computer_file_status}}</span>
                                        </p>
                                </div>

                                <div class="container-fluid text-muted p-1"> 
                                    <label class="text-sm text-white bg-primary label-style1 pl-2 pr-2">કબાટ ફાઇલ સ્ટેટસ:</label>
                                        <p class="mb-2">
                                            <span class="text-dark text-md">{{$taskAssign->cupboard_file_status}}</span>
                                        </p>
                                </div>
                                    


                                <label class="text-sm text-white bg-primary label-style1 pl-2 pr-2 mb-0">ફાઇલ:</label>
                                    
                            <ul class="list-unstyled">
                            @foreach($medias as $media)
                                <li class="row m-2">

                                    <a href="{{route('download.file')}}/{{($media->image)}}" class="btn-link text-primary label-style1">
                                    <i class="far fa-fw fa-file-word"></i>{{$media->image}} - <span class="text-dark">({{$media->note}})</span></a>
                                    &nbsp;&nbsp;&nbsp;<button class="btn btn-xs btn-danger del-modal float-left"  title="Delete File"  data-id="{{url('admin')}}/media/{{$media->id}}" data-title="{{$media->image}}"  
                                    data-toggle="modal" data-target="#modal-delete-file"><i class="fas fa-trash-alt"></i>
                                    </button>
                                </li>
                            @endforeach
                    
                            </ul>

                            <form action="{{route('media.store')}}"  enctype="multipart/form-data" method="post" 
                                class="form-horizontal" >
                                
                                @csrf
                                <input type="hidden" name="task_assign_id" value="{{$taskAssign->id}}">

                                <input type="hidden" name="admin_to" value="{{$chatEmployee}}">
                                
                                 <div class=" mb-3 mt-3">
                                    <div class="col-12 p-0 ">
                                        <input type="file" name="file" class="float-left mb-3 mt-3" required/>

                                        <textarea type="text" placeholder="File Details" name="note" class="form-control mb-3 mt-3"></textarea>
                                        
                                    
                                    </div>       
                                    <button type="submit" class="btn btn-sm btn-primary pull-right">
                                        <i class="fas fa-save"></i>&nbsp;&nbsp;&nbsp; ફાઈલ અપલોડ કરો</button>                         
                            </form>
                            <div class="col-12 mt-3 row" style="display: flex;justify-content: space-between;">

                          

                                    <a href="{{route('task-assign.edit',$taskAssign->id)}}" class="btn btn-info">
                                            <i class="far fa-edit"></i>&nbsp;&nbsp;&nbsp; એડિટ</a>

                                            <button type="button" class="btn btn-danger del-modal float-left"  title="Delete task"  data-id="{{$taskAssign->id}}"
                                                 data-title="{{$taskAssign->description}}"  data-toggle="modal" data-target="#delete-task">
                                                 
                                            <i class="fas fa-trash-alt"></i>&nbsp;&nbsp;&nbsp; ડિલીટ</a> </button>

                                        </div>
                                </div>
                        </div>
                   

                    </div>
                </div>
            </div>

    </section>
  </div>
  
  
  <div class="modal fade" id="modal-delete-file">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">ફાઈલ ડિલીટ કરો</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
            <form class="delete-form" action="" method="POST">
            
            @method('DELETE')
            @csrf
            <input type="hidden" name="id" value="{{$taskAssign->id}}">
            <label>ફાઈલ ડિલીટ કરો...</label>
                <h5 class="modal-title delete-title">Delete File</h5>
            </div>
            <div class="modal-footer justify-content-between mb-2 ">
              <button type="button" class="btn btn-default mr-4" data-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-danger float-right" title="Delete Record"><i class="fas fa-trash-alt"></i> Delete File</button>
              
            </form>
            </div>
          </div>
        </div>
      </div>


  <div class="modal fade" id="modal-default">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">ટાસ્ક સ્ટેટસ અપડેટ કરો</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
            <form class="delete-form" action="{{route('admin.task.update.status')}}" method="POST">
            
            @csrf
            <input type="hidden" name="task_assign_id" value="{{$taskAssign->id}}">
            <input type="hidden" name="admin_to" value="{{$chatEmployee}}">

            <label>હાલ કામની સ્ટેટ્સ</label>

                <select name="status_id" class="form-control">
                    @foreach($statuses as $status)
                        <option value="{{$status->id}}"
                            @if($status->id == $taskAssign->taskStatus($taskAssign->id)->id)
                                selected
                            @endif
                        >{{$status->name}}</option>
                    @endforeach
                </select>

            </div>
            <div class="modal-footer justify-content-between mb-2 ">
              <button type="button" class="btn btn-default mr-4" data-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-danger float-right" title="Delete Record"><i class="fas fa-trash-alt"></i> ટાસ્ક સ્ટેટસ અપડેટ કરો</button>
              
            </form>
            </div>
          </div>
        </div>
      </div>

      <div class="modal fade" id="delete-task">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Delete task</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
            <label>ટાસ્કનું નામ</label>
            <h5 class="modal-title delete-title">Delete Category</h5>
            </div>
            <div class="modal-footer justify-content-between d-block ">
              
            <form class="delete-form float-right" action="" method="POST">
                    @method('DELETE')
                    @csrf
              <button type="button" class="btn btn-default mr-4" data-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-danger float-right" title="Delete Record"><i class="fas fa-trash-alt"></i> Delete</button>
              

            </form>
            </div>
          </div>
        </div>
      </div>
  @endsection

  