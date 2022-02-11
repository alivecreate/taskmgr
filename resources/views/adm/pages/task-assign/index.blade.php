@extends('adm.layout.admin-index')
@section('title','Dashboard - Task Manager')

@section('toast')
  @include('adm.widget.toast')
@endsection

@section('custom-js')
<script src="{{url('adm')}}/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="{{url('adm')}}/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>

<script src="{{url('adm')}}/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="{{url('adm')}}/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>

<script src="{{url('adm')}}/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>

<script src="{{url('adm')}}/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="{{url('adm')}}/plugins/jszip/jszip.min.js"></script>
<script src="{{url('adm')}}/plugins/pdfmake/pdfmake.min.js"></script>
<script src="{{url('adm')}}/plugins/pdfmake/vfs_fonts.js"></script>
<script src="{{url('adm')}}/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="{{url('adm')}}/plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script src="{{url('adm')}}/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>

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
<script>
  $(function () {
    $("#example1").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": true,
      "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');

  });
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
                <table id="example1" class="table table-hover">
                  <thead>
                    <tr>
                      <th>ID</th>
                      <th>Status</th>
                      
                        <th >કામગીરી વ્યક્તિ</th>
                        <th>વિગત</th>

                      <th>અરજદારનું નામ</th>
                      <th>કચેરીનું નામ</th>
                      <th width="120">Action</th>
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
                        
                      

                          <td>
                      @if(getEmployees($taskAssign->admin_group))
                        @foreach(getEmployees($taskAssign->admin_group) as $key => $admin_group)
                        <a href="{{route('task-assign.show',$taskAssign->id)}}?employee={{$taskAssign->getEmployee($admin_group->id)->id}}">
                        
                        <div class="d-flex flex-row">

                                @if(isset($admin_group->image))
                                        
                                  <p class="pull-left mr-2 text-strong text-danger">
                                      <img class="img-circle elevation-2 object-fit"  height="40" width="40"
                                    src="{{asset('web')}}/media/icon/{{$taskAssign->getEmployee($admin_group->id)->image}}">
                                    
                                      <strong class="pl-1">({{++$key}}) 
                                      <span class="">{{$admin_group->name}}</span></strong></p>
                                    </a>

                                  @else
                                        <p class="pull-left mr-2 text-strong text-danger">
                                    <img class="img-circle elevation-2"   height="40" width="40"
                                      src="{{asset('adm')}}/img/no-user.jpeg">
                                        <strong class="pl-1">({{++$key}})
                                        <span>{{$admin_group->name}}</span> </strong></p>
                                @endif
                                
                              </div>
                            </a>
                          @endforeach
                          
                        @endif

                          </td>
                          <td>{{$taskAssign->description}}</td>

                          <td>
                          
                       <a href="{{route('client.edit',$taskAssign->getClient($taskAssign->task_id)->id)}}">
                          @if(isset($taskAssign->getClient($taskAssign->task_id)->image))
                            <img class="img-circle elevation-2 object-fit"  height="40" width="40"
                                  src="{{asset('web')}}/media/icon/{{$taskAssign->getClient($taskAssign->task_id)->image}}">
                            @else
                            <img class="img-circle elevation-2"  height="40" width="40"
                                src="{{asset('adm')}}/img/no-user.jpeg">
                            @endif
                                  <strong class="pl-1">
                            <span class="">{{$taskAssign->getClient($taskAssign->task_id)->name}}</span></span></strong>
                            </a>
                               
                        </td>
                        <td class="">
                        @if($taskAssign->getParent($taskAssign->task_id)['kacheri'])
                          <h1 class='badge badge-primary p-1'>{{$taskAssign->getParent($taskAssign->task_id)['kacheri']->name}}</h1>
                        @endif

                        
                        @if($taskAssign->getParent($taskAssign->task_id)['petaKacheri'])
                          <h1 class='badge badge-danger p-1'>{{$taskAssign->getParent($taskAssign->task_id)['petaKacheri']->name}}</h1>
                        @endif

                        
                        @if($taskAssign->getParent($taskAssign->task_id)['department'])
                          <h1 class='badge badge-warning p-1'>{{$taskAssign->getParent($taskAssign->task_id)['department']->name}}</h1>
                        @endif
                        </td>
                        
                        <td>
                        
                      @if(session('LoggedUser')->id == 1)
                        <a href="{{route('task-assign.show',$taskAssign->id)}}" class="btn btn-xs btn-warning float-left mr-2"  title="Task Details"><i class="fa fa-eye"></i></a>
                        
                        <a href="{{route('task-assign.edit',$taskAssign->id)}}" class="btn btn-xs btn-info float-left mr-2"  title="Edit task"><i class="far fa-edit"></i></a>
                        <button class="btn btn-xs btn-danger del-modal float-left"  title="Delete task"  data-id="{{$taskAssign->id}}" data-title="{{$taskAssign->description}}"  data-toggle="modal" data-target="#modal-default"><i class="fas fa-trash-alt"></i>
                          </button>
                        @else
                        <a href="{{route('task-assign.show',$taskAssign->id)}}" class="btn btn-xs btn-warning float-left mr-2"  title="Task Details"><i class="fa fa-eye"></i></a>
                        @endif
                      
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

  