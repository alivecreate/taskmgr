@extends('adm.layout.admin-index')
@section('title','Dashboard - Charotar Corporation')

@section('toast')
  @include('adm.widget.toast')
@endsection

@section('custom-js')
<script>
$( document ).ready(function() {
  $(".del-modal").click(function(){
    var delete_id = $(this).attr('data-id');
    var data_title = $(this).attr('data-title');
    $('.delete-form').attr('action','/admin/task-assign/'+ delete_id);
    $('.delete-title').html(data_title);
  });  
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
            <h1>Task Assigned: કામગીરી વ્યક્તિ / ટાસ્ક</h1>
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
              
              <div class="card-body table-responsive p-0">
                <table class="table table-hover bg-nowrap" p-1>
                  <thead>
                    <tr>
                      <th>ID</th>
                      <th>Status</th>
                      
                      @if(session('LoggedUser')->id == 1)
                        <th>ફોટો</th>
                        <th>કામગીરી વ્યક્તિ</th>
                        <th>વિગત</th>
                      @else
                        <th>અરજદારનું<br>ફોટોગ્રાફ</th>
                        <th>વિગત</th>
                      @endif

                      <th>ટાસ્ક / અરજદારનું નામ</th>
                      <th>કચેરીનું નામ</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($taskAssigns as $i => $taskAssign)
                      <tr>
                        <td>{{++$i}}</td>
                        <td>

                        <span class="{{getStatusBadgeColor($taskAssign->taskStatus($taskAssign->id)->name)}}">
                         <span class="text-captalize">{{$taskAssign->taskStatus($taskAssign->id)->name}}</span>
                         </span>
                        
                        </td>
                        
                      
                      @if(session('LoggedUser')->id == 1)
                      
                          @if(isset($taskAssign->getEmployee($taskAssign->admin_id)->image))
                            <td><img class="img-circle elevation-2 object-fit"  height="30" width="30"
                                src="{{asset('web')}}/media/icon/{{$taskAssign->getEmployee($taskAssign->admin_id)->image}}"></td>
                            @else
                              <td><img class="img-circle elevation-2"   height="30" width="30"
                                src="{{asset('adm')}}/img/no-user.jpeg"></td>
                          @endif

                          <td>{{$taskAssign->getEmployee($taskAssign->admin_id)->name}}</td>
                          <td>{{$taskAssign->description}}</td>
                      @else
                      
                          @if(isset($taskAssign->getClient($taskAssign->task_id)->image))
                              <td><img class="img-circle elevation-2 object-fit"  height="30" width="30"
                                    src="{{asset('web')}}/media/icon/{{$taskAssign->getClient($taskAssign->task_id)->image}}"></td>
                                    @else

                                  <td><img class="img-circle elevation-2"  height="30" width="30"
                                    src="{{asset('adm')}}/img/no-user.jpeg"></td>
                          @endif
                        
                        <td>{{$taskAssign->description}}</td>
                      @endif
                      

                        

                        <td>{{$taskAssign->getTask($taskAssign->task_id)->name}}<br>({{$taskAssign->getClient($taskAssign->task_id)->name}})</td>
                         

                        <td class="">
                        
                        @if($taskAssign->getParent($taskAssign->task_id)['kacheri'])
                          <span class='bg-primary p-1'>{{$taskAssign->getParent($taskAssign->task_id)['kacheri']->name}}</span>
                        @endif

                        
                        @if($taskAssign->getParent($taskAssign->task_id)['petaKacheri'])
                          <span class='bg-danger p-1'>{{$taskAssign->getParent($taskAssign->task_id)['petaKacheri']->name}}</span>
                        @endif

                        
                        @if($taskAssign->getParent($taskAssign->task_id)['department'])
                          <span class='bg-warning p-1'>{{$taskAssign->getParent($taskAssign->task_id)['department']->name}}</span>
                        @endif
                        


                        </td>
                        
                        <td>
                        
                        <a href="{{route('task-assign.edit',$taskAssign->id)}}" class="btn btn-xs btn-info float-left mr-2"  title="Edit task"><i class="far fa-edit"></i></a>
                        <a href="{{route('task-assign.show',$taskAssign->id)}}" class="btn btn-xs btn-warning float-left mr-2"  title="Task Details"><i class="far fa-edit"></i></a>
                          <button class="btn btn-xs btn-danger del-modal float-left"  title="Delete task"  data-id="{{$taskAssign->id}}" data-title="{{$taskAssign->name}}"  data-toggle="modal" data-target="#modal-default"><i class="fas fa-trash-alt"></i>
                          </button>
                      
                      </td>
                      </tr>
                    @endforeach

                  </tbody>
                </table>
                
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

  