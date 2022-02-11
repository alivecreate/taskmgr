@extends('adm.layout.admin-index')
@section('title','Report:- Category Wise' )

@section('toast')
  @include('adm.widget.toast')
@endsection

@section('custom-js')
{{dd('wise')}}
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
            <h2 class="text-danger">Report: <span class="text-dark">કચેરીનું રિપોર્ટ</span></h2>
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
                <table  id="example1" class="table table-bordered table-striped" p-1>
                  <thead>

                    <tr>
                      <th colspan="9" class="text-primary">
                      Search By :- 
                        <form action="" class="float-right">

                        <select name="category" id="">
                            <option value="">All Status</option>

                            @foreach($mainCategories as $mainCategory)
                                <option value="{{$mainCategory->id}}">{{$mainCategory->name}}</option>
                            @endforeach

                        </select>
                        
                          <input type="submit" name="type" value="category-wise">
                        </form>


                        <form action="" class="float-right">
                  <div class="form-group row">
                    <div class="col-sm-6">
                    <label for="client_id">કચેરી</label>
                    
                      <select name="category_parent_id" class="form-control category_parent_id">

                        <option value="0">કચેરી સિલેક્ટ કરો</option>

                          @foreach($categories as $parent_category)
                              <option value="{{$parent_category->id}}"
                      
                                @if($cat_level['category'] == $parent_category->id )
                                  selected
                                @endif
                              

                              >{{$parent_category->name}}</option>
                          @endforeach

                      </select>
                      <span class="text-danger">@error('category_parent_id') {{$message}} @enderror</span>
                    </div>

                    <div class="col-sm-6">
                    <label for="client_id">પેટાકચેરી</label>
                      <select name="subcategory_parent_id"  class="form-control subcategory_parent_id">
                        
                        @if($cat_level['subcategory'])
                          <option value="{{$cat_level['subcategory']}}">{{$cat_level['subcategory_name']}}</option>
                        @else
                          <option value="0">પેટાકચેરી સિલેક્ટ કરો</option>
                        @endif
                        

                      </select>
                      <span class="text-danger">@error('subcategory_parent_id') {{$message}} @enderror</span>
                    </div>
                  </div>

                  <input type="hidden" name="parent_id" class="parent_id"value="{{$cat_level['parent_id']}}">
                 </form>

                      
                      </th>
                    </tr>
                    <tr>
                      <th>ID</th>
                      <th>તારીખ</th>
                      <th>Status</th>
                      <th>ફોટો</th>
                      <th>કામગીરી વ્યક્તિ</th>
                      <th>અરજદારનું<br>ફોટો</th>
                      <th>વિગત</th>

                      <th>ટાસ્ક / અરજદારનું નામ</th>
                      <th>કચેરીનું નામ</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                  
                    @foreach($categories as $i => $category_wise)
                      <tr>
                        <td>{{++$i}}</td>
                        <td>{{dateFormat($category_wise->task_created_at, 'd-M-Y')}}</td>
                        <td>

                        <span class="{{getStatusBadgeColor($category_wise->status_name)}}">
                          <span class="text-captalize">{{$category_wise->status_name}}</span>
                        </span>
                          
                        </td>
                        
                          @if(isset($category_wise->admin_image))
                            <td><img class="img-circle elevation-2 object-fit"  height="30" width="30"
                                src="{{asset('web')}}/media/icon/{{$category_wise->admin_image}}"></td>
                            @else
                              <td><img class="img-circle elevation-2"   height="30" width="30"
                                src="{{asset('adm')}}/img/no-user.jpeg"></td>
                          @endif

                          <td>{{$category_wise->admin_name}}</td>
                      
                          @if(isset($category_wise->client_image))
                              <td><img class="img-circle elevation-2 object-fit"  height="30" width="30"
                                    src="{{asset('web')}}/media/icon/{{$category_wise->client_image}}"></td>
                                    @else

                                  <td><img class="img-circle elevation-2"  height="30" width="30"
                                    src="{{asset('adm')}}/img/no-user.jpeg"></td>
                          @endif
                        
                        
                          <td>{{$category_wise->task_description}}</td>

                        <td>{{$category_wise->task_name}}<br>({{$category_wise->client_name}})</td>
                         

                        <td class="">
                        
                        @if(getParents($category_wise->category_id)['category'])
                          <span class='badge badge-primary p-1'>{{getParents($category_wise->category_id)['category']->name}}</span>
                        @endif

                        
                        @if(getParents($category_wise->category_id)['subcategory'])
                          <span class='badge badge-danger p-1'>{{getParents($category_wise->category_id)['subcategory']->name}}</span>
                        @endif

                        
                        @if(getParents($category_wise->category_id)['subcategory2'])
                          <span class='badge badge-warning p-1'>{{getParents($category_wise->category_id)['subcategory2']->name}}</span>
                        @endif
                        

                        </td>
                        
                        <td>
                        {{--
                        <a href="{{route('task-assign.show',$category_wise->task_assign_id)}}" class="btn btn-xs btn-warning float-left mr-2"  title="Task Details"><i class="fa fa-eye"></i></a>
                        
                      @if(session('LoggedUser')->id == 1)
                        <a href="{{route('task-assign.edit',$category_wise->task_assign_id)}}" class="btn btn-xs btn-info float-left mr-2"  title="Edit task"><i class="far fa-edit"></i></a>
                        <button class="btn btn-xs btn-danger del-modal float-left"  title="Delete task"  data-id="{{$category_wise->task_assign_id}}"
                         data-title="{{$category_wise->task_description}}"  data-toggle="modal" data-target="#modal-default"><i class="fas fa-trash-alt"></i>
                          </button>
                      @endif
                      --}}
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

  