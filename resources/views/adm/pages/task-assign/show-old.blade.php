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
    $('.delete-form').attr('action','/admin/task/'+ delete_id);
    $('.delete-title').html(data_title);
  });  
});
</script>
@endsection


@section('content')

<div class="content-wrapper">
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="text-danger">
              @if($taskAssign->getClient($taskAssign->task_id)->image)
                <img class="img-circle elevation-2 object-fit" height="30" width="30" 
                src="{{asset('web')}}/media/xs/{{$taskAssign->getClient($taskAssign->task_id)->image}}" alt="">
              @else
                <img class="img-circle elevation-2"  height="30" width="30" src="{{url('adm')}}/img/no-user.jpeg">
              @endif
                {{$taskAssign->task($taskAssign->id)->name}} <span class="text-muted">({{$taskAssign->getClient($taskAssign->task_id)->name}})</span></h1> 
              
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
      <div class="container-fluid">
      
        <div class="row">
          <div class="col-12">
            <div class="card">
                
            <div class="timeline">
                
              <div class="time-label">
                <span class="bg-primary">ટાસ્ક આપ્યાની તારીખ:- {{dateFormat($taskAssign->created_at, 'm/d/Y')}} ({{dateFormatGujDay($taskAssign->created_at, 'l')}}) 
                </span>

                <span class=""><u>નોંધ નં:- {{$taskAssign->note_no}} </u></span>
                <span class="bg-warning  float-right">  સ્ટેટ્સ:- <span class="bg-warning">Pending</span> </span>
                  
                <span class="time text-muted float-right"><i class="fas fa-clock"></i> {{dateFormat($taskAssign->created_at, 'H:i')}}</span>
                  
              </div>
              <div>
                <i class="fa fa-plus-square nav-icon bg-blue"></i>
                <div class="timeline-item">
                  <span class="time"><i class="fas fa-clock"></i> {{dateFormat($taskAssign->created_at, 'H:i')}}</span>
                  <h3 class="timeline-header">

                      <a href="#">
                      @if($taskAssign->getEmployee($taskAssign->task_id)->image)
                        <img  class="img-circle elevation-2 object-fit" height="30" width="30"
                       src="{{asset('web')}}/media/xs/{{$taskAssign->getEmployee($taskAssign->task_id)->image}}" alt=""> 
                       @else
                        <img class="img-circle elevation-2"  height="30" width="30" src="{{url('adm')}}/img/no-user.jpeg">
                      @endif

                      &nbsp;&nbsp;{{$taskAssign->getEmployee($taskAssign->task_id)->name}} &nbsp;&nbsp;</a> 
                      <!-- sent you an email -->
                      <small>ઇન્વર્ડ તારીખ: <span class="text-muted">{{dateFormat($taskAssign->date_inward, 'm/d/Y')}}</span></small> &nbsp;&nbsp;
                      <small>તપાસ તારીખ: <span class="text-muted">{{dateFormat($taskAssign->date_check, 'm/d/Y')}}</span></small>
                    </h3>

                  <div class="timeline-body">
                    {{$taskAssign->description}}
                  </div>
                  <div class="container">
                    <div class="card card-outline direct-chat direct-chat-primary shadow-none">
                    @foreach($taskAssign->getComments($taskAssign->id) as $task_comment)
                      @if($taskAssign->admin_id == $taskAssign->getCommentUser($task_comment->admin_id)->id)
                      <div class="direct-chat-msg">
                          <div class="direct-chat-infos clearfix">
                            <span class="direct-chat-name float-left">{{$taskAssign->getCommentUser($task_comment->admin_id)->name}}</span>
                            <span class="direct-chat-timestamp float-right">{{dateFormat($task_comment->created_at, 'm/d/Y')}} {{dateFormatGujDay($task_comment->created_at, 'l')}}</span>
                          </div>

                          @if($taskAssign->getCommentUser($task_comment->admin_id)->image)
                            <img class="direct-chat-img" 
                            src="{{url('web')}}/media/icon/{{$taskAssign->getCommentUser($task_comment->admin_id)->image}}" alt="Message User Image">
                          @else
                            <img class="direct-chat-img img-circle elevation-2"  height="30" width="30" src="{{url('adm')}}/img/no-user.jpeg">  
                          @endif

                          <div class="direct-chat-text">
                            {{$task_comment->comment}}
                          </div>
                      </div>

                    @else
                      <div class="direct-chat-msg right comment-right">
                          <div class="direct-chat-infos clearfix">
                              <span class="direct-chat-timestamp float-left">{{dateFormat($task_comment->created_at, 'm/d/Y')}} {{dateFormatGujDay($task_comment->created_at, 'l')}}</span>
                              <span class="direct-chat-name float-right">{{$taskAssign->getCommentUser($task_comment->admin_id)->name}}</span>
                            </div>

                          @if($taskAssign->getCommentUser($task_comment->admin_id)->image)
                            <img class="direct-chat-img" 
                            src="{{url('web')}}/media/icon/{{$taskAssign->getCommentUser($task_comment->admin_id)->image}}" alt="Message User Image">
                          @else
                            <img class="direct-chat-img img-circle elevation-2"  height="30" width="30" src="{{url('adm')}}/img/no-user.jpeg">  
                          @endif

                          <div class="direct-chat-text">
                            {{$task_comment->comment}}
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
                        <input type="text" placeholder="Comment Here..." name="comment" class="form-control" autocomplete="off">
                        <span class="input-group-append">
                          <button type="submit" class="btn btn-primary">Send</button>
                        </span>
                      </div>
                    </form>
                  </div>
                  
                </div>
              </div>
              
              <div>
              </div>
              
              <div class="time-label">
                <span class="bg-green">3 Jan. 2014</span>
              </div>
              <div>
                <i class="fa fa-camera bg-purple"></i>
                <div class="timeline-item">
                  <span class="time"><i class="fas fa-clock"></i> 2 days ago</span>
                  <h3 class="timeline-header"><a href="#">Mina Lee</a> uploaded new photos</h3>
                  <div class="timeline-body">
                    <img src="https://placehold.it/150x100" alt="...">
                    <img src="https://placehold.it/150x100" alt="...">
                    <img src="https://placehold.it/150x100" alt="...">
                    <img src="https://placehold.it/150x100" alt="...">
                    <img src="https://placehold.it/150x100" alt="...">
                  </div>
                </div>
              </div>
              
              <div>
              </div>
              
              <div>
                <i class="fas fa-clock bg-gray"></i>
              </div>
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
            <label>કર્મચારીનું નામ</label>
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

  