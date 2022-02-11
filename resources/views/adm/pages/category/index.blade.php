@extends('adm.layout.admin-index')
@section('title','Dashboard - Task Manager')
@section('content')

@section('toast')
  @include('adm.widget.toast')
@endsection

@section('custom-js')



<script>


$('.kacheri_parent_id').on('change', function() {
        var parent = $(this).find(':selected').val();


        var link = `{{url('admin/category/edit')}}/`+parent;
        var delLink = `{{url('admin/category/delete')}}/`+parent;
        
        // alert(link);
        $('.btn-edit').attr('href', link);
        $('.btn-delete').attr('data-id', delLink);
        $('.del-link').attr('data-id', delLink);

//disabled

$('.btn-delete').attr('disabled', false);
$('.del-link').attr('data-id', delLink);

        $.get( `{{url('api')}}/get/getPetaKacheri/`+parent, { kacheri_parent_id: parent })
        .done(function( data ) {

        if(JSON.stringify(data.length) == 0){
            $('.petaKacheri_parent_id').html('<option>પેટાકચેરી સિલેક્ટ કરો</option>');
        }
        else{
                $('.petaKacheri_parent_id').empty();     
            $('.petaKacheri_parent_id').html('<option value="">પેટાકચેરી સિલેક્ટ કરો</option>');
            for(var i = 0 ; i < JSON.stringify(data.length); i++){  
                $('.petaKacheri_parent_id').append('<option value='+JSON.stringify(data[i].id)+'>'+ data[i].name +'</option>')
            }
        }
    });
    // alert(parent);
    $('.category_id').val(parent);

    });


    $('.petaKacheri_parent_id').on('change', function() {
        var parent = $(this).find(':selected').val();

        var link = `{{url('admin/category/edit')}}/`+parent;
        var delLink = `{{url('admin/category/delete')}}/`+parent;
        // alert(link);
        $('.btn-edit').attr('href', link);
        $('.btn-delete').attr('data-id', delLink);
        $('.del-link').attr('data-id', delLink);
        

        $.get( `{{url('api')}}/get/getDepartment/`+parent, { petaKacheri_parent_id: parent })
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
    
    $('.category_id').val(parent);
       
    });
    
    $('.department_id').on('change', function() {
        var parent = $(this).find(':selected').val();
        var link = `{{url('admin/category/edit')}}/`+parent;
        var delLink = `{{url('admin/category/delete')}}/`+parent;

        $('.btn-edit').attr('href', link);
        $('.btn-delete').attr('data-id', delLink);
        $('.del-link').attr('data-id', delLink);
        $('.category_id').val(parent);
       
    });

    $( document ).ready(function() {
  $(".del-modal").click(function(){
    var delete_id = $(this).attr('data-id');
    var data_title = $(this).attr('data-title');
    
    // $('.delete-form').attr('action','/admin/category/'+ delete_id);
    $('.del-link').attr('href',delete_id);
    
    $('.delete-title').html(data_title);
  });  
});

$(".category").addClass( "menu-is-opening menu-open");
$(".category a").addClass( "active-menu");

</script>
@endsection
<div class="content-wrapper">
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>List View : કચેરી / પેટાકચેરી / ડિપાર્ટમેન્ટ</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{url('admin')}}">Home</a></li>
              <li class="breadcrumb-item active">Category</li>
            </ol>
          </div>
        </div>
      </div>
    </section>


    <section class="content">
      <div class="container-fluid">
        <div class="card card-default">
        
          <div class="card-body">
            <div class="form-horizontal row">
            
            <div class="col-md-12">
                 
                  <div class="form-group row">
                    <div class="col-sm-4">
                    <label for="client_id">કચેરીનું નામ</label>
                      <select name="kacheri_parent_id" class="form-control kacheri_parent_id">
                        <option value="">કચેરી સિલેક્ટ કરો</option>
                          @foreach($parent_categories as $parent_category)
                              <option value="{{$parent_category->id}}">{{$parent_category->name}}</option>
                          @endforeach
                      </select>
                      <span class="text-danger">@error('category_id') {{$message}} @enderror</span>
                    </div>

                    
                    <div class="col-sm-4">
                    <label for="client_id">પેટાકચેરીનું નામ</label>
                      <select name="petaKacheri_parent_id"  class="form-control petaKacheri_parent_id">
                        <option value="">પેટાકચેરી સિલેક્ટ કરો</option>
                      </select>
                      <span class="text-danger">@error('petaKacheri_parent_id') {{$message}} @enderror</span>
                    </div>
    
                    
                    <div class="col-sm-3">
                    <label for="client_id">ડિપાર્ટમેન્ટનું નામ</label>
                      <select name="department_id"  class="form-control department_id">
                        <option value="">ડિપાર્ટમેન્ટ સિલેક્ટ કરો</option>
                      </select>
                      <span class="text-danger">@error('department_id') {{$message}} @enderror</span>
                      <input type="hidden" name="category_id" class="category_id">
                      <input type="hidden" name="admin_id" value="{{session('LoggedUser')->id}}">
                    </div>

                    <div class="col-sm-1">
                      <label for="client_id col-sm-12">Action</label>
                      <div class="row">
                        <a disabled
                        class="btn btn-info float-right btn-sm btn-edit"><i class="far fa-edit"></i></a> &nbsp; 
                        
                        <button disabled type="button" class="btn btn-sm btn-danger del-modal float-left btn-delete" 
                         title="Delete Category"  
                          data-id="" data-title=""  
                          data-toggle="modal" data-target="#modal-default"><i class="fas fa-trash-alt"></i>
                          </button>

                      </div>              
                    </div>
                    
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
              <h4 class="modal-title">Delete Category</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
            <label>Are you sure?</label>
            <h5 class="modal-title delete-title">Are you sure?</h5>
            </div>
            <div class="modal-footer justify-content-between d-block ">
              
            <form class="delete-form float-right" action="" method="POST">
                    @csrf
              <button type="button" class="btn btn-default mr-4" data-dismiss="modal">Close</button>
              <a  href="" class="btn btn-danger float-right del-link" title="Delete Record"><i class="fas fa-trash-alt"></i> Delete</a>
              

            </form>
            </div>
          </div>
        </div>
      </div>

  @endsection