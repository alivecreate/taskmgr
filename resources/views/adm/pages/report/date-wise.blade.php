@extends('adm.layout.admin-index')
@section('title','Report:- '. $title )

@section('toast')
  @include('adm.widget.toast')
@endsection

@section('custom-js')

<!-- DataTables  & Plugins -->
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

$(".report").addClass( "menu-is-opening menu-open");
$(".report a").addClass( "active-menu");

</script>


<!-- Page specific script -->
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
            <h2 class="text-danger">Report: <span class="text-dark">તારીખનું રિપોર્ટ</span></h2>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{url('admin')}}">Home</a></li>
              <li class="breadcrumb-item active">Report</li>
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
                <table  id="example2" class="table table-bordered table-striped" p-1>
                  <thead>

                    <tr>
                      <th colspan="9" class="text-primary">
                      Search By :- 
                        <form action="" class="float-right">
                          <input type="date" id="bdaymonth" name="start" value="{{@$_REQUEST['start']}}" required>&nbsp;&nbsp;
                          <input type="date" id="bdaymonth" name="end" value="{{@$_REQUEST['end']}}" required>
                          <input type="submit" name="type" value="date-range">
                        </form>

                        <form action="" class="float-right">
                        <input type="month" id="bdaymonth" name="month" value="{{@$_REQUEST['month']}}" required> 
                        <input type="submit" name="type" value="monthly" >
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                      </form>
                      
                      </th>
                    </tr>
                    <tr>
                      <th>ID</th>
                      <th>તારીખ</th>
                      <th>Status</th>
                      <th>કામગીરી વ્યક્તિ</th>
                      <th>અરજદાર</th>
                      <th>વિગત</th>
                      <th>કચેરીનું નામ</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                  
                    @foreach($dateWises as $i => $dateWise)
                      <tr>
                        <td>{{++$i}}</td>
                        <td>{{dateFormat($dateWise->task_assign_date, 'd-M-Y')}}</td>
                        <td>
                        <span class="{{getStatusBadgeColor($dateWise->status_name)}}">
                        
                          <span class="text-captalize">{{$dateWise->status_name}}</span>
                          </span>
                          
                        </td>
                        
                          <td>

                          @foreach(getEmployees($dateWise->admin_group) as $key => $admin_group)
                        <a href="{{route('task-assign.show',$dateWise->task_assign_id)}}?employee={{getEmployee($admin_group->id)->id}}">
                        
                        <div class="d-flex flex-row">

                                @if(isset($admin_group->image))
                                        
                                  <p class="pull-left mr-2 text-strong text-danger">
                                      <img class="img-circle elevation-2 object-fit"  height="40" width="40"
                                    src="{{asset('web')}}/media/icon/{{getEmployee($admin_group->id)->image}}">
                                    
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
                          </td>

                          <td>

                          <a href="{{route('client.edit',getClient($dateWise->task_id)->id)}}">
                            @if(isset(getClient($dateWise->task_id)->image))
                              <img class="img-circle elevation-2 object-fit"  height="40" width="40"
                                    src="{{asset('web')}}/media/icon/{{getClient($dateWise->task_id)->image}}">
                              @else
                              <img class="img-circle elevation-2"  height="40" width="40"
                                  src="{{asset('adm')}}/img/no-user.jpeg">
                              @endif
                                    <strong class="pl-1">
                              <span class="">{{getClient($dateWise->task_id)->name}}</span></span></strong>
                            </a>

                          </td>
                        
                          <td>{{$dateWise->task_description}}</td>


                        <td class="">
                        @if(getParents($dateWise->category_id)['category'])
                          <span class='badge badge-primary p-1'>{{getParents($dateWise->category_id)['category']->name}}</span>
                        @endif

                        @if(getParents($dateWise->category_id)['subcategory'])
                          <span class='badge badge-danger p-1'>{{getParents($dateWise->category_id)['subcategory']->name}}</span>
                        @endif
                        
                        @if(getParents($dateWise->category_id)['subcategory2'])
                          <span class='badge badge-warning p-1'>{{getParents($dateWise->category_id)['subcategory2']->name}}</span>
                        @endif
                        </td>
                        
                        <td>
                        
                        <a href="{{route('task-assign.show',$dateWise->task_assign_id)}}" class="btn btn-xs btn-warning float-left mr-2"  title="Task Details"><i class="fa fa-eye"></i></a>
                        
                      @if(session('LoggedUser')->id == 1)
                        <a href="{{route('task-assign.edit',$dateWise->task_assign_id)}}" class="btn btn-xs btn-info float-left mr-2"  title="Edit task"><i class="far fa-edit"></i></a>
                        <button class="btn btn-xs btn-danger del-modal float-left"  title="Delete task"  data-id="{{$dateWise->task_assign_id}}"
                         data-title="{{$dateWise->task_description}}"  data-toggle="modal" data-target="#modal-default"><i class="fas fa-trash-alt"></i>
                          </button>
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

  