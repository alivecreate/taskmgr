@extends('adm.layout.admin-index')
@section('title','Dashboard - Charotar Corporation')

@section('toast')
  @include('adm.widget.toast')
@endsection

@section('custom-js')
    <script>
        
$(".task-assign").addClass( "menu-is-opening menu-open");
$(".task-assign a").addClass( "active-menu");

    </script>
@endsection


@section('content')

<div class="content-wrapper">
    <section class="content-header">
      <div class="container-fluid text-muted">
        <div class="row mb-2">
          <div class="col-sm-6">
          <h1>Task Details / ટાસ્કની વિગત</h1>
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
                        <span class="bg-dark">ટાસ્ક આપ્યાની તારીખ:- {{dateFormat($taskAssign->created_at, 'm-d-Y')}} ({{dateFormatGujDay($taskAssign->created_at, 'l')}}) 
                        </span>
        
                        <span class=""><u>નોંધ નં:- {{$taskAssign->note_no}} </u></span>&nbsp;
                        
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
                            @foreach($taskAssign->getComments($taskAssign->id) as $task_comment)
                            

                                @if($task_comment->admin_id !== session('LoggedUser')->id)

                                <div class="direct-chat-msg">
                                    <div class="direct-chat-success clearfix">
                                    <span class="direct-chat-name float-left text-secondary text-sm">{{$taskAssign->getCommentUser($task_comment->admin_id)->name}}</span>
                                    <span class="direct-chat-timestamp float-right text-sm">{{dateFormat($task_comment->created_at, 'm-d-y')}} {{dateFormatGujDay($task_comment->created_at, 'l')}}
                                        
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
                                        @else
                                            {{$task_comment->comment}}
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
                                        @else
                                            {{$task_comment->comment}}
                                        @endif

                                        
                                    @if($task_comment->admin_id == session('LoggedUser')->id)
                                        <span class="float-right text-xs pt-2 text-light">
                                            @if($task_comment->seen == 0)
                                                Not Seen
                                            @else
                                            <i class="far fa-calendar-alt"></i>&nbsp;{{dateFormat($task_comment->created_at, 'm-d-Y')}} &nbsp;<i class="fas fa-clock"></i>&nbsp; {{dateFormat($task_comment->created_at, 'h:i A')}} ({{dateFormatGujDay($task_comment->created_at, 'l')}})
                                            @endif
                                        </span>
                                    @else
                                        <span>test</span>
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
                                <textarea type="text" placeholder="Comment Here..." name="comment" class="form-control" autocomplete="off"></textarea>
                                <span class="input-group-append">
                                    <button type="submit" class="btn btn-dark">Send</button>
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

                            <div class="container-fluid text-muted p-1">
                                <label class="text-md text-white bg-primary label-style1 pl-2 pr-2">કામગીરી વ્યક્તિ:</label>
                                    <p class="mb-2">
                                    @if($taskAssign->getEmployee($taskAssign->admin_id)->image)
                                        <img  class="img-circle elevation-2 object-fit" height="30" width="30"
                                    src="{{asset('web')}}/media/xs/{{$taskAssign->getEmployee($taskAssign->admin_id)->image}}" alt=""> 
                                    @else
                                        <img class="img-circle elevation-2"  height="20" width="20" src="{{url('adm')}}/img/no-user.jpeg">
                                    @endif
                                    <span class="text-dark text-md mb-0">{{$taskAssign->getEmployee($taskAssign->admin_id)->name}}</span>
                                    </p>
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
                                



                        <h5 class="mt-5 text-muted">Project files</h5>
                        <ul class="list-unstyled">
                        <li>
                            <a href="" class="btn-link text-primary label-style1"><i class="far fa-fw fa-file-word"></i> Functional-requirements.docx</a>
                        </li>
                        <li>
                            <a href="" class="btn-link text-primary label-style1"><i class="far fa-fw fa-file-pdf"></i> UAT.pdf</a>
                        </li>
                        <li>
                            <a href="" class="btn-link text-primary label-style1"><i class="far fa-fw fa-envelope"></i> Email-from-flatbal.mln</a>
                        </li>
                        <li>
                            <a href="" class="btn-link text-primary label-style1"><i class="far fa-fw fa-image "></i> Logo.png</a>
                        </li>
                        <li>
                            <a href="" class="btn-link text-primary label-style1"><i class="far fa-fw fa-file-word"></i> Contract-10_12_2014.docx</a>
                        </li>
                        </ul>
                        <div class="text-center mt-5 mb-3">
                        <a href="#" class="btn btn-sm btn-primary">Add files</a>
                        <a href="#" class="btn btn-sm btn-warning">Report contact</a>
                        </div>
                    </div>
                    </div>
                </div>
            </div>

    </section>
  </div>
  
  
  <div class="modal fade" id="modal-default">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Delete task</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
            <form class="delete-form" action="{{route('admin.task.update.status')}}" method="POST">
            
            @csrf
            <input type="hidden" name="task_assign_id" value="{{$taskAssign->id}}">
            <label>હાલ કામની સ્ટેટ્સ</label>
                <h5 class="modal-title delete-title">Delete Category</h5>


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
              <button type="submit" class="btn btn-danger float-right" title="Delete Record"><i class="fas fa-trash-alt"></i> Save Status</button>
              
            </form>
            </div>
          </div>
        </div>
      </div>

  @endsection

  