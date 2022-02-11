@extends('adm.layout.admin-index')
@section('title','Dashboard - Task Manager')
@section('content')

@section('toast')
  @include('adm.widget.toast')
@endsection

@section('custom-js')

<link rel="stylesheet" href="{{url('mdbootstrap')}}/css/style.css">


<script>

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
            <h1>Category : કચેરી / પેટાકચેરી / ડિપાર્ટમેન્ટ</h1>
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

    <div class="treeview-colorful w-20 border border-secondary mx-4 my-4">
  <h6 class="pt-3 pl-3">Tree View</h6>
  <hr>
  
  <ul class="treeview-colorful-list mb-3">

@foreach($treeCategories as $key => $treeCategory)
  <li class="treeview-colorful-items level1">
      <a class="treeview-colorful-items-header text-danger">
        <i class="fas fa-plus-circle"></i>
        <span>&nbsp;&nbsp;{{categoryData($key)->name}}</span>
      </a>
      
      <a class="btn btn-xs tree-btn-edit" href="{{route('admin.category.edit',$key)}}">
      <i class="far fa-edit"></i></a>
      
              <button class="btn btn-xs btn-danger del-modal tree-btn-delete"  title="Delete Category"  
              data-id="{{url('admin')}}/category/delete/{{$key}}" 
              data-title="{{ categoryData($key)->name}}"  data-toggle="modal" 
              data-target="#modal-default"><i class="fas fa-trash-alt"></i>
              </button>
              

      @if(count($treeCategory) > 0)
        @foreach($treeCategory as $key2 => $treeSubCategory)

          <ul class="nested active" style="display:block;">
            <li class="treeview-colorful-items level3">
            <a class="treeview-colorful-items-header ">
            <span class="">	&#8627;</i>
              <span>&nbsp;&nbsp;{{categoryData($key2)->name}}</span></a>
              
      <a class="btn btn-xs tree-btn-edit" href="{{route('admin.category.edit',$key2)}}">
      <i class="far fa-edit"></i></a>
      
              <button class="btn btn-xs btn-danger del-modal tree-btn-delete"  title="Delete Category"  
              data-id="{{url('admin')}}/category/delete/{{$key2}}" 
              data-title="{{ categoryData($key2)->name}}"  data-toggle="modal" 
              data-target="#modal-default"><i class="fas fa-trash-alt"></i>
              </button>
              

                  @if(count($treeSubCategory) > 0)
                      @foreach($treeSubCategory as $treeSubCategory2)
                        
                        <ul class="nested active" style="display:block;">
                          <li class="treeview-colorful-items level3">
                          <a class="treeview-colorful-items-header  text-info">
                          <span class="">	&#8627;</i>
                            <span>&nbsp;&nbsp;{{categoryData($treeSubCategory2)->name}}</span>
                            </a>
                            
      <a class="btn btn-xs tree-btn-edit" href="{{route('admin.category.edit',$treeSubCategory2)}}">
      <i class="far fa-edit"></i></a>
      
              <button class="btn btn-xs btn-danger del-modal tree-btn-delete"  title="Delete Category"  
              data-id="{{url('admin')}}/category/delete/{{$treeSubCategory2}}" 
              data-title="{{ categoryData($treeSubCategory2)->name}}"  data-toggle="modal" 
              data-target="#modal-default"><i class="fas fa-trash-alt"></i>
              </button>
              
                          </li>
                          </ul>
                      @endforeach
                    @endif
          
              </li>
            </ul>
        @endforeach
      @endif

  @endforeach
</ul>
<!-- 

    <section class="content">
      <div class="container-fluid">
      
        <div class="row">
          <div class="col-12">
            <div class="card">
              
              <div class="card-body table-responsive p-0">
                <table class="table table-hover text-nowrap">
                  <thead>
                    <tr>
                      <th class="bg-gray">ID</th>
                      <th class="bg-info">કચેરી</th>
                      <th class="bg-danger">પેટાકચેરી</th>
                      <th class="bg-warning">ડિપાર્ટમેન્ટ</th>
                    </tr>
                  </thead>
                  <tbody>
                  @foreach($parent_categories as $i => $parent_category)                  
                    <tr>
                      <td>{{++$i}}</td>
                      <td><a  class="text-info"  href="{{route('admin.category.edit',$parent_category->id)}}">{{$parent_category->name}}</a></td>
                      <td>
                      
                        @if($parent_category->subCategories1($parent_category->id)->count() > 0)
                        <table class="table-border-none">
                          @foreach($parent_category->subCategories1($parent_category->id) as $subCategory1)
                          <tr>
                            <td>
                            
                            <a  class="text-danger"  href="{{route('admin.category.edit',$subCategory1->id)}}">{{$subCategory1->name}}</a>
                              
                                 @if($parent_category->subCategories2($subCategory1->id)->count() > 0)
                                  @foreach($parent_category->subCategories2($subCategory1->id) as $subCategory2)
                                  
                                  <tr>
                                      <td style="color:white;">.</td>
                                  </tr>        
                                  @endforeach
                              @endif        
                            </td>
                          </tr>
                          @endforeach
                          </table>
                        @endif
                        </td>
                      <td>
                        @if($parent_category->subCategories1($parent_category->id)->count() > 0)
                              <table>
                          @foreach($parent_category->subCategories1($parent_category->id) as $subCategory1)
                            @if($parent_category->subCategories2($subCategory1->id)->count() > 0)
                              @foreach($parent_category->subCategories2($subCategory1->id) as $subCategory2)
                              
                              <tr>
                                <td>
                                  <a class="text-dark" href="{{route('admin.category.edit',$subCategory2->id)}}">{{$subCategory2->name}}</a>
                              </td>
 
                              </tr>        
                              @endforeach
                              @endif                   
                            @endforeach
                              </table>
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
    </section> -->
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
            <label>Category Name</label>
            <h5 class="modal-title delete-title">Delete Category</h5>
            </div>
            <div class="modal-footer justify-content-between d-block ">
              
            <form class="delete-form float-right" action="" method="POST">
                    @method('DELETE')
                    @csrf
              <button type="button" class="btn btn-default mr-4" data-dismiss="modal">Close</button>
              <a  href="" class="btn btn-danger float-right del-link" title="Delete Record"><i class="fas fa-trash-alt"></i> Delete</a>
              

            </form>
            </div>
          </div>
        </div>
      </div>
  @endsection