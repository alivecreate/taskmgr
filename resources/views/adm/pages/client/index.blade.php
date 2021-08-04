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
    
    $('.delete-form').attr('action','/admin/client/'+ delete_id);
    $('.delete-title').html(data_title);
  });  
});
$(".client").addClass( "menu-is-opening menu-open");
$(".client a").addClass( "active-menu");
</script>
@endsection


@section('content')

<div class="content-wrapper">
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Client List: અરજદાર</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{url('admin')}}">Home</a></li>
              <li class="breadcrumb-item active">Client</li>
              <li class="breadcrumb-item active">
                <a class="btn btn-sm btn-danger" href="{{route('admin.trashed','client')}}">
                <i class="fas fa-trash-alt"></i>&nbsp;&nbsp;Trashed</a></li>
            
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
                      <th>ફોટો</th>
                      <th>અરજદારનું નામ</th>
                      <th>રેફરેન્સનું નામ</th>
                      <th>ફોન નં 1</th>
                      <th>ફોન નં 2</th>
                      <th>સરનામું</th>
                      <th>નોંધ</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($clients as $i => $client)
                      <tr>
                        <td>{{++$i}}</td>
                        @if($client->image)
                        <td><img class="img-circle elevation-2 object-fit-sm" 
                            src="{{asset('web')}}/media/lg/{{$client->image}}"></td>
                            @else
                            
                        <td><img class="img-circle elevation-2 object-fit-sm" 
                            src="{{asset('adm')}}/img/no-user.jpeg"></td>
                        @endif

                        <td>{{$client->name}}</td>
                        <td>{{$client->ref_name}}</td>
                        <td>{{$client->phone1}}</td>
                        <td>{{$client->phone2}}</td>
                        <td>{{$client->address}}</td>
                        <td>{{$client->note}}</td>
                        <td>
                        
                        <a href="{{route('client.edit',$client->id)}}" class="btn btn-xs btn-info float-left mr-2"  title="Edit client"><i class="far fa-edit"></i></a>
                          <button class="btn btn-xs btn-danger del-modal float-left"  title="Delete client"  data-id="{{ $client->id}}" data-title="{{ $client->name}}"  data-toggle="modal" data-target="#modal-default"><i class="fas fa-trash-alt"></i>
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
              <h4 class="modal-title">Delete Client</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
            <label>અરજદારનું નામ</label>
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

  