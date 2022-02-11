@extends('adm.layout.admin-index')
@section('title','Report:- Category Wise All' )

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

$('.category_parent_id').on('change', function() {

        var parent = $(this).find(':selected').val();
  // alert(parent);
        $('.parent_id').val(parent);

        $.get( `{{url('api')}}/get/getPetaKacheri/`+parent, { category_parent_id: parent })
        .done(function( data ) {
        if(JSON.stringify(data.length) == 0){
            $('.subcategory_parent_id').html('<option>પેટાકચેરી સિલેક્ટ કરો</option>');
        }
        else{
                $('.subcategory_parent_id').empty();     
            $('.subcategory_parent_id').html('<option value="">પેટાકચેરી સિલેક્ટ કરો</option>');
            for(var i = 0 ; i < JSON.stringify(data.length); i++){  
                $('.subcategory_parent_id').append('<option value='+JSON.stringify(data[i].id)+'>'+ data[i].name +'</option>')
            }
        }
    });
  });


$('.subcategory_parent_id').on('change', function() {
        var parent = $(this).find(':selected').val();
    // alert(parent);

        $.get( `{{url('api')}}/get/getDepartment/`+parent, { subcategory_parent_id: parent })
        .done(function( data ) {
          // alert(JSON.stringify(data));

        if(JSON.stringify(data.length) == 0){
            $('.department_id').html('<option>ડિપાર્ટમેન્ટ સિલેક્ટ કરો</option>');
        }
        else{
                $('.department_id').empty();     
            $('.department_id').html('<option value="">ડિપાર્ટમેન્ટ સિલેક્ટ કરો</option>');
            for(var i = 0 ; i < JSON.stringify(data.length); i++){  
                $('.department_id').append('<option value='+JSON.stringify(data[i].id)+'>'+ data[i].name +'</option>')
            }
        }
    });
    });


$('.department_id').on('change', function() {
      var parent = $(this).find(':selected').val();
      if(parent == ''){
        var mainCat = $('.department_id').find(':selected').val();
        $('.parent_id').val(mainCat);
      }else{
        $('.parent_id').val(parent);
      }
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

<?php
if(isset($_REQUEST['category_parent_id'])){
  $searchPetaCategories = DB::table('categories')->where('parent_id', $_REQUEST['category_parent_id'])->get();
}

if(isset($_REQUEST['subcategory_parent_id']) && $_REQUEST['subcategory_parent_id'] != ''){
  // dd($_REQUEST['subcategory_parent_id']);
  $searchDepartmentCategories = DB::table('categories')->where('parent_id', $_REQUEST['subcategory_parent_id'])->get();
  
  // dd($searchDepartmentCategories);
}else{
  $searchDepartmentCategories = null;
}



  // $searchPetaCategories = DB::table('categories')->where('parent_id', $_REQUEST['category_parent_id'])->get();



// }



?>

    
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
              
              <div class="card-body  p-0">
                <table  id="example1" class="table table-bordered table-striped" p-1>
                  <thead>

                    <tr>
                      <th colspan="9" class="text-primary">

                      <div class="form-group row">
                      <div class="col-sm-2">
                      
                      <p>Search By :- </p>
                      </div>
                    <div class="col-sm-10">
                        <form action="" class="row">
                    <div class="col-sm-3">
                      <select name="category_parent_id" class="form-control form-control-sm category_parent_id">

                        <option value="0">કચેરી સિલેક્ટ કરો</option>

                          @foreach($mainCategories as $parent_category)
                              <option value="{{$parent_category->id}}"
                              @if(isset($_REQUEST['category_parent_id']) && $_REQUEST['category_parent_id'] == $parent_category->id)
                              selected
                              @endif
                              >{{$parent_category->name}}</option>
                          @endforeach
                      </select>
                    </div>

                    <div class="col-sm-3">
                      <span class="text-danger">@error('category_parent_id') {{$message}} @enderror</span>

                      <select name="subcategory_parent_id"  class="form-control form-control-sm subcategory_parent_id"
                      > 
                          <option value="">પેટાકચેરી સિલેક્ટ કરો</option>
                      @if(isset($searchPetaCategories))
                        @foreach($searchPetaCategories as $searchPetaCategory)
                          <option value="{{$searchPetaCategory->id}}"
                          
                            @if(isset($_REQUEST['subcategory_parent_id']) && $_REQUEST['subcategory_parent_id'] == $searchPetaCategory->id)
                                selected
                            @endif
                            
                          >{{$searchPetaCategory->name}}</option>
                        @endforeach
                      @endif

                        
                      </select>
                      <span class="text-danger">@error('subcategory_parent_id') {{$message}} @enderror</span>
                    </div>

                    <div class="col-sm-3">
                      <span class="text-danger">@error('category_parent_id') {{$message}} @enderror</span>

                    <select name="department_id"  class="form-control form-control-sm department_id" >
                    
                    <option value="">ડિપાર્ટમેન્ટ સિલેક્ટ કરો</option>

                  @if(isset($searchDepartmentCategories))
                    @foreach($searchDepartmentCategories as $searchDepartmentCategory)
                        <option value="{{$searchDepartmentCategory->id}}"
                          @if(isset($_REQUEST['department_id']) && $_REQUEST['department_id'] == $searchDepartmentCategory->id)
                              selected
                          @endif

                        >{{$searchDepartmentCategory->name}}</option>
                      @endforeach
                  @endif

                      </select>

                      <span class="text-danger">@error('subcategory_parent_id') {{$message}} @enderror</span>


                    </div>

                      <div class="col-sm-3">
                      <input type="hidden" name="type" value="category_wise">
                          <input type="submit" class="btn btn-dark btn-sm" value="Search" >

                      </div>

                    

                  </div>

                  <input type="hidden" name="parent_id" class="parent_id" 
                    value="@if(isset($_REQUEST['parent_id'])){{$_REQUEST['parent_id']}}@endif">

                 </form>
                </div>
                      
                      </th>
                    </tr>
                    <tr>
                      <th>ID</th>
                      <th>કચેરીનું નામ</th>
                      <th>ટાસ્કનું નામ</th>
                      <th>અરજદારનું નામ</th>
                      <th>વિગત</th>
                      <th>Status</th>
                      <th>ફોટો</th>
                      <th>કામગીરી વ્યક્તિ</th>
                      <th>તારીખ</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                  <?php
                    $catIndex = 1;
                  ?>
                  @if(isset($_REQUEST['category_parent_id']))
                    @foreach($category_wises as $i => $category_wise)
                @if(isset($category_wise))
              @foreach(getTaskAssignFromCategory($category_wise->id) as $index => $category_wise_task)
                    

<tr>
  <td>{{$catIndex++}}</td>
  <td class="">
  
  @if(getParents($category_wise->id)['category'])
    <span class='badge badge-primary p-1'>{{getParents($category_wise->id)['category']->name}}</span>
  @endif

  
  @if(getParents($category_wise->id)['subcategory'])
    <span class='badge badge-danger p-1'>{{getParents($category_wise->id)['subcategory']->name}}</span>
  @endif

  
  @if(getParents($category_wise->id)['subcategory2'])
    <span class='badge badge-warning p-1'>{{getParents($category_wise->id)['subcategory2']->name}}</span>
  @endif
  

  </td>
  

  
  <td>{{$category_wise_task->task_description}}</td>
  
    @if(isset($category_wise_task->admin_image))
      <td><img class="img-circle elevation-2 object-fit"  height="30" width="30"
          src="{{asset('web')}}/media/icon/{{$category_wise_task->admin_image}}"></td>
      @else
        <td><img class="img-circle elevation-2"   height="30" width="30"
          src="{{asset('adm')}}/img/no-user.jpeg"></td>
    @endif


    <td>
@foreach(getEmployees($category_wise_task->admin_group) as $key => $admin_group)
<a href="{{route('task-assign.show',$category_wise_task->task_assign_id)}}?employee={{getEmployee($admin_group->id)->id}}">

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



  <td>{{dateFormat($category_wise_task->task_created_at, 'd-M-Y')}}</td>

<td class="">
  <span class="{{getStatusBadgeColor($category_wise_task->status_name)}}">
    <span class="text-captalize">{{$category_wise_task->status_name}}</span>
  </span>
    
  </td>

  <td>

    {{--
    <td>{{$category_wise_task->admin_name}}</td>

    @if(isset($category_wise_task->client_image))
        <td><img class="img-circle elevation-2 object-fit"  height="30" width="30"
              src="{{asset('web')}}/media/icon/{{$category_wise_task->client_image}}"></td>
              @else

            <td><img class="img-circle elevation-2"  height="30" width="30"
              src="{{asset('adm')}}/img/no-user.jpeg"></td>
    @endif
  --}}

  <td>{{$category_wise_task->task_name}}<br>({{$category_wise_task->client_name}})</td>
   

  <td>
  <a href="{{route('task-assign.show',$category_wise_task->task_assign_id)}}" class="btn btn-xs btn-warning float-left mr-2"  title="Task Details"><i class="fa fa-eye"></i></a>
  
  {{--
@if(session('LoggedUser')->id == 1)
  <a href="{{route('task-assign.edit',$category_wise_task->task_assign_id)}}" class="btn btn-xs btn-info float-left mr-2"  title="Edit task"><i class="far fa-edit"></i></a>
  <button class="btn btn-xs btn-danger del-modal float-left"  title="Delete task"  data-id="{{$category_wise_task->task_assign_id}}"
   data-title="{{$category_wise_task->task_description}}"  data-toggle="modal" data-target="#modal-default"><i class="fas fa-trash-alt"></i>
    </button>
@endif
--}}
</td>
</tr>
@endforeach
                      
@endif
                    @endforeach
@endif
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

  