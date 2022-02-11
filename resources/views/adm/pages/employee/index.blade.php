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
    
    $('.delete-form').attr('action',delete_id);
    $('.delete-title').html(data_title);
  });  
});

$(".employee").addClass( "menu-is-opening menu-open");
$(".employee a").addClass( "active-menu");
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
            <h1>List: કર્મચારીનું લિસ્ટ</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{url('admin')}}">Home</a></li>
              <li class="breadcrumb-item active">Employee</li>
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
                      <th>ફોટો</th>
                      <th>કર્મચારીનું નામ</th>
                      <th>ફોન નં</th>
                      <th>એડ્રેસ</th>
                      <th>કર્મચારી કોડ</th>
                      <th>પોસ્ટ</th>
                      <th width="100">Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($employees as $i => $employee)
                      <tr>
                        <td>{{++$i}}</td>
                        @if($employee->image)
                        <td><img class="img-circle elevation-2 object-fit-sm" 
                            src="{{asset('web')}}/media/lg/{{$employee->image}}"></td>
                            @else
                            
                        <td><img class="img-circle elevation-2 object-fit-sm" 
                            src="{{asset('adm')}}/img/no-user.jpeg"></td>
                        @endif

                        <td>{{$employee->name}}</td>
                        <td>{{$employee->phone}}</td>
                        <td>{{$employee->address}}</td>
                        <td>{{$employee->code}}</td>
                        <td>{{$employee->post}}</td>
                        <td>
                        
                        <a href="{{route('employee.edit',$employee->id)}}" class="btn btn-xs btn-info float-left mr-2"  title="Edit Employee"><i class="far fa-edit"></i></a>
                        @if($employee->id != 1)
                          <button class="btn btn-xs btn-danger del-modal float-left"  
                          title="Delete Employee"  data-id="{{route('employee.destroy',$employee->id)}}" 
                          data-title="{{ $employee->name}}"  data-toggle="modal" data-target="#modal-default"><i class="fas fa-trash-alt"></i>
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
              <h4 class="modal-title">Delete Employee</h4>
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

  