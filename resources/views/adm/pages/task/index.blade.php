@extends('adm.layout.admin-index')
@section('title','List:- Task')

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
    
    $('.delete-form').attr('action','/admin/task/'+ delete_id);
    $('.delete-title').html(data_title);
  });  
});


$(".task").addClass( "menu-is-opening menu-open");
$(".task a").addClass( "active-menu");

</script>
<script>
  $(function () {
    $("#example1").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": true,
      "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');

    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
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
            <h1>List: ટાસ્ક / કામગીરીનું લિસ્ટ</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{url('admin')}}">Home</a></li>
              <li class="breadcrumb-item active">ટાસ્ક - કામગીરીનું લિસ્ટ</li>
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
                <table id="example1" class="table table-hover" p-1>
                  <thead>
                    <tr>
                      <th>ID</th>
                      <th>ટાસ્કનું નામ</th>
                      <th>અરજદારનું નામ</th>
                      <th>અરજદારનું ફોટો</th>
                      <th>કચેરીનું નામ</th>
                      <th width="100">Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($tasks as $i => $task)
                      <tr>
                        <td>{{++$i}}</td>

                        <td>{{$task->name}}</td>
                        <td>{{$task->client->name}}</td>
                        @if($task->client->image)
                        <td><img class="img-circle elevation-2 object-fit"  height="40" width="40"
                            src="{{asset('web')}}/media/lg/{{$task->client->image}}"></td>
                            @else
                            
                        <td><img class="img-circle elevation-2 object-fit-sm" 
                            src="{{asset('adm')}}/img/no-user.jpeg"></td>
                        @endif
                        
                        <td>
                        @if($task->getParent($task->category_id)['kacheri'])
                          <span class='bg-primary p-1'>{{$task->getParent($task->category_id)['kacheri']->name}}</span>
                        @endif

                        
                        @if($task->getParent($task->category_id)['petaKacheri'])
                          <span class='bg-danger p-1'>{{$task->getParent($task->category_id)['petaKacheri']->name}}</span>
                        @endif

                        
                        @if($task->getParent($task->category_id)['department'])
                          <span class='bg-warning p-1'>{{$task->getParent($task->category_id)['department']->name}}</span>
                        @endif
                        
                        
                        
                        </td>
                        
                        <td>
                        
                        <a href="{{route('task.edit',$task->id)}}" class="btn btn-xs btn-info float-left mr-2"  title="Edit task"><i class="far fa-edit"></i></a>
                          <button class="btn btn-xs btn-danger del-modal float-left"  title="Delete task"  data-id="{{ $task->id}}" data-title="{{ $task->name}}"  data-toggle="modal" data-target="#modal-default"><i class="fas fa-trash-alt"></i>
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

  