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


$(document).ready(function () {
    $('html, body').animate({
        scrollTop: $('.content-header').offset().top
    }, 'slow');


    $('.chat-box').animate({
        scrollTop: $('.last-msg-block').offset().top
    }, 'slow');
});

    </script>
@endsection


@section('content')

<?php
$employeeArrs = explode(',', $taskAssign->admin_group);
$arrEmployeeData = [];

foreach($employeeArrs as $employeeArr){
    $getEmp = DB::table('admins')->where('id', $employeeArr)->first();

    $arrEmployeeData[] = $getEmp->email;

}
// dd($arrEmployeeData);

// dd(implode($arrEmployeeData, ','));
$adminEmails = implode(', ', $arrEmployeeData);
// $adminEmails = $arrEmployeeData;

// dd(implode($arrEmployeeData, ','));
// dd($arrEmployeeData);
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

            <!-- Default box -->
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
                <div class="col-12 col-md-12 col-lg-8 order-2 order-md-1">
                    
                    <div class="timeline no-before">
                        <div class="time-label">
                        <span class="bg-dark">ટાસ્ક આપ્યાની તારીખ:- {{dateFormat($taskAssign->created_at, 'd-M-Y')}} ({{dateFormatGujDay($taskAssign->created_at, 'l')}}) 
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
                        <div>
                        <div class="timeline-item m-0">
                            
                            <span class="time"><i class="fas fa-clock"></i> {{dateFormat($taskAssign->created_at, 'h:i A')}}</span>
        
                            <div class="timeline-body">
                            {{$taskAssign->description}}
                            </div>
                            <div class="container">
                            <div class="card card-outline direct-chat direct-chat-dark shadow-none">
                            @foreach($taskAssign->getAllComments($taskAssign->id, session('LoggedUser')->id) as $key =>  $task_comment)
                                @if($task_comment->admin_id == session('LoggedUser')->id)
                                <div class="direct-chat-msg @if($taskAssign->getComments($taskAssign->id, $task_comment)->count() == $key + 1) last-msg-block @endif ">
                                                        
                                    <div class="direct-chat-success clearfix">
                                    <span class="direct-chat-name float-left text-secondary text-sm">You</span>
                                   
                                    @if($task_comment->seen == 0)
                                        <span class="direct-chat-timestamp float-right text-sm">{{dateFormat($task_comment->created_at, 'm-d-y')}} {{dateFormatGujDay($task_comment->created_at, 'l')}}
                                    @endif
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

                                   

                                    </p>

                                    </div>
                                </div>
                            @endif
        
                            @endforeach
        
                            </div>
                            </div>
                            
                            <div class="card-footer">
                            <form action="{{route('admin.taskComment.store')}}" method="post">
                                @csrf
                                <div class="input-group">
                                <input type="hidden" name="admin_id" value="{{session('LoggedUser')->id}}">
                                <input type="hidden" name="task_assign_id" value="{{$taskAssign->id}}">
                                <input type="hidden" name="admin_to" value="1">
                                
                                <input type="hidden" name="admin_email" value="{{$adminEmails}}">
                                        
                                        <input type="hidden" name="client_name"
                                            value="{{$taskAssign->getClient($taskAssign->task_id)->name}}">

                                        <input type="hidden" name="client_photo"
                                            value="{{asset('web')}}/media/xs/{{$taskAssign->getClient($taskAssign->task_id)->image}}">

                                
                                <textarea type="text" placeholder="Comment Here..." name="comment" class="form-control" autocomplete="off"></textarea>
                                <span class="input-group-append">

                                    <button type="submit" class="btn btn-dark on-click-disable">Send</button>
                                    <button type="button" class="btn btn-dark btn-processing" style="display:none" disabled>Send</button>
                                </span>
                                </div>
                            </form>
                            
                            <span class="text-danger">@error('comment') {{$message}} @enderror</span>
                            </div>
                            
                        </div>
                        </div>
                        
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

?>
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
                                



                        <h5 class="mt-5 text-muted">Task Files</h5>
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
                            <input type="hidden" name="admin_to" value="1">
                            
                            <input type="hidden" name="task_assign_id" value="{{$taskAssign->id}}">
                            <input type="hidden" name="admin_to" value="0">
                            <input type="hidden" name="admin_email" value="{{$adminEmails}}">
                            
                            <input type="hidden" name="client_name"
                                value="{{$taskAssign->getClient($taskAssign->task_id)->name}}">

                            <input type="hidden" name="client_photo"
                                value="{{asset('web')}}/media/xs/{{$taskAssign->getClient($taskAssign->task_id)->image}}">

                                
                            <div class="text-center mt-5 mb-3">
                                <input type="file" name="file" class="float-left mb-3"/>
                                <input type="text" placeholder="File Details" name="note" class="form-control mb-3"/>
                                <input type="submit" class="btn btn-sm btn-primary" value="Save File"/>
                            </div>
                        </form>
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
              <h4 class="modal-title">Update Status</h4>
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
            <input type="hidden" name="admin_to" value="1">

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
              <button type="button" class="btn btn-default mr-4 " data-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-danger float-right" title="Delete Record"><i class="fas fa-trash-alt"></i> Save Status</button>
              
            </form>
            </div>
          </div>
        </div>
      </div>

  @endsection

  