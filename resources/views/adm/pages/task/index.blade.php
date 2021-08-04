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
    
    $('.delete-form').attr('action','/admin/task/'+ delete_id);
    $('.delete-title').html(data_title);
  });  
});


$(".task").addClass( "menu-is-opening menu-open");
$(".task a").addClass( "active-menu");

</script>
@endsection


@section('content')

<div class="content-wrapper">
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>task List: કર્મચારી</h1>
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
                      <th>ટાસ્કનું નામ</th>
                      <th>અરજદારનું નામ</th>
                      <th>અરજદારનું ફોટો</th>
                      <th>કચેરીનું નામ</th>
                      <th>Action</th>
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

  