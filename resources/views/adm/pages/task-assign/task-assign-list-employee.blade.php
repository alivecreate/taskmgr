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
    $('.delete-form').attr('action','/admin/task-assign/'+ delete_id);
    $('.delete-title').html(data_title);
  });  
});

$(".task-assign").addClass( "menu-is-opening menu-open");
$(".task-assign a").addClass( "active-menu");

$(function () {
    //Initialize Select2 Elements
    $('.select2').select2()

    //Initialize Select2 Elements
    $('.select2bs4').select2({
      theme: 'bootstrap4'
    })
    })

</script>
@endsection


@section('content')

<div class="content-wrapper">
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>List: કામગીરી વ્યક્તિ / ટાસ્કનું લિસ્ટ</h1>
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
                      
                        <th>અરજદારનું<br>ફોટોગ્રાફ</th>
                      <th>અરજદારનું નામ</th>
                        <th>વિગત</th>
                      <th>કચેરીનું નામ</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($taskAssigns as $i => $taskAssign)
                      <tr>
                        <td>{{++$i}}</td>
                        <td>
                        <span class="{{getStatusBadgeColor(taskStatus($taskAssign->id)->name)}}">
                        
                          <span class="text-captalize">{{taskStatus($taskAssign->id)->name}}</span>
                          </span>
                          
                          </td>

                          @if(isset($taskAssign->getClient($taskAssign->task_id)->image))
                              <td><img class="img-circle elevation-2 object-fit"  height="30" width="30"
                                    src="{{asset('web')}}/media/icon/{{$taskAssign->getClient($taskAssign->task_id)->image}}"></td>
                                    @else

                                  <td><img class="img-circle elevation-2"  height="30" width="30"
                                    src="{{asset('adm')}}/img/no-user.jpeg"></td>
                          @endif
                          <td>{{$taskAssign->getClient($taskAssign->task_id)->name}}</td>
                      

                        <td>{{$taskAssign->getTask($taskAssign->task_id)->name}}<br>
                        ({{$taskAssign->getClient($taskAssign->task_id)->name}})</td>
                         

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
                        
                        <a href="{{route('admin.task.assign.show.employee',$taskAssign->id)}}" class="btn btn-xs btn-warning float-left mr-2"  title="Task Details"><i class="fa fa-eye"></i></a>
                       
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

  