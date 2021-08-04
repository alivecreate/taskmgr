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
    
    $('.delete-form').attr('action','/admin/trashed/{{$record_name}}/'+ delete_id);
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
            <h1><span class="text-danger">Trashed / Deleted:</span> {{$record_name}}</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{url('admin')}}">Home</a></li>
              <li class="breadcrumb-item active">Client</li>
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
                <table class="table table-hover text-nowrap">
                  <thead>
                    <tr>
                      <th>ID</th>
                      <th>Image</th>
                      <th>Name/ Title</th>
                      <th>DataBase</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($records as $i => $record)
                      <tr>
                        <td>{{++$i}}</td>
                        @if($record->image)
                        <td><img class="img-circle elevation-2 object-fit-sm" 
                            src="{{asset('web')}}/media/lg/{{$record->image}}"></td>
                        @endif

                        <td>{{$record->name}}</td>
                        <td>{{$record_name}}</td>
                        <td>
                        
                          <a href="{{url('admin/trashed/restore',$record_name)}}/{{$record->id}}" title="Restore {{$record_name}} Record" class="btn btn-xs btn-warning float-left mr-2"  title="Edit client"><i class="fas fa-recycle"></i></a>
                          <button class="btn btn-xs btn-danger del-modal float-left"  title="Permenant Delete {{$record_name}}"  data-id="{{ $record->id}}" data-title="{{ $record->name}}"  
                          data-toggle="modal" data-target="#modal-default"><i class="fas fa-trash-alt"></i>
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
              <h4 class="modal-title">Delete {{$record_name}}</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
            <label>Name</label>
            <h5 class="modal-title delete-title">Delete {{$record_name}}</h5>
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

  