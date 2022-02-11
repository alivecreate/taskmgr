@extends('adm.layout.admin-index')
@section('title','Dashboard - Task Manager')

@section('toast')
  @include('adm.widget.toast')
@endsection

@section('custom-js')



<script>
$('.kacheri_parent_id').on('change', function() {
        var parent = $(this).find(':selected').val();

        $.get( `{{url('api')}}/get/getPetaKacheri/`+parent, { kacheri_parent_id: parent })
        .done(function( data ) {
          // alert(JSON.stringify(data));

        if(JSON.stringify(data.length) == 0){
            $('.petaKacheri_parent_id').html('<option value="">પેટાકચેરી સિલેક્ટ કરો</option>');
        }
        else{
                $('.petaKacheri_parent_id').empty();     
            $('.petaKacheri_parent_id').html('<option value="">પેટાકચેરી સિલેક્ટ કરો</option>');
            for(var i = 0 ; i < JSON.stringify(data.length); i++){  
                $('.petaKacheri_parent_id').append('<option value='+JSON.stringify(data[i].id)+'>'+ data[i].name +'</option>')
            }
        }
    });
        
    });
$(".category").addClass( "menu-is-opening menu-open");
$(".category a").addClass( "active-menu");

</script>
@endsection
@section('content')


<div class="content-wrapper">
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Edit : કચેરી / પેટાકચેરી / ડિપાર્ટમેન્ટ  </h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{url('admin')}}">Home</a></li>
              <li class="breadcrumb-item active"> કચેરી / પેટાકચેરી / ડિપાર્ટમેન્ટ</li>
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
            
            @if($type == 'kacheri')
            <div class="col-md-4 card card-info">
              <div class="card card-info">
              <div class="card-header">
                <h3 class="card-title">કચેરી Edit કરો</h3>
              </div>
             
              <form method="post" class="form-horizontal" action="{{route('admin.category.update', $data->id)}}">
                @csrf
                <div class="card-body p-2 pt-4">
                  <div class="form-group row">
                    <div class="col-sm-12">
                      <input type="hidden" name="type" value="kacheri">
                      <input type="text" class="form-control" name="kacheri_name" 
                         placeholder="કચેરીનું નામ" 
                         
                         value="@if(old('kacheri_name')){{old('kacheri_name')}}@else{{$data->name}}@endif">
                         
                    <span class="text-danger">@error('kacheri_name') {{$message}} @enderror</span>
                    </div>
                  </div>
                  <div class="form-group row">
                    <div class="col-sm-12">
                      <textarea class="form-control" name="kacheri_description"
                         placeholder="નોંધ">@if(old('kacheri_description')){{old('kacheri_description')}}@else{{$data->description}}@endif</textarea>
                    <span class="text-danger">@error('kacheri_description') {{$message}} @enderror</span>
                    </div>
                  </div>
                  
                  <div class="form-group row">
                    <div class="col-sm-12">
                      <textarea class="form-control" name="kacheri_address"
                         placeholder="સરનામું">@if(old('kacheri_address')){{old('kacheri_address')}}@else{{$data->address}}@endif</textarea>
                    <span class="text-danger">@error('kacheri_address') {{$message}} @enderror</span>
                    </div>
                  </div>

                  </div>
                </div>

                <div class="card-footer">
                  <button type="submit" class="btn btn-info">કચેરી સેવ કરો</button>
                </div>
              </form>

            </div>
            @endif


            @if($type == 'petakacheri')
            <div class="col-md-4 card card-info">
              <div class="card card-danger">
              <div class="card-header">
                <h3 class="card-title">પેટાકચેરી Edit કરો</h3>
              </div>
             
              <form method="post" class="form-horizontal"  action="{{route('admin.category.update',$data->id)}}">
              
              @csrf
              <input type="hidden" name="type" value="peta_kacheri">
                <div class="card-body p-2 pt-4">
                  <div class="form-group row">
                    <div class="col-sm-12">
                      
                      <input type="text" class="form-control" name="petaKacheri_name"
                         placeholder="પેટાકચેરીનું નામ" 
                         value="@if(old('petaKacheri_name')){{old('petaKacheri_name')}}@else{{$data->name}}@endif">
                         <span class="text-danger">@error('petaKacheri_name') {{$message}} @enderror</span>
                    
                    </div>
                  </div>
                  <div class="form-group row">
                    <div class="col-sm-12">
                      <textarea class="form-control" name="petaKacheri_description"
                         placeholder="નોંધ">@if(old('petaKacheri_description')){{old('petaKacheri_description')}}@else{{$data->description}}@endif</textarea>
                         <span class="text-danger">@error('petaKacheri_description') {{$message}} @enderror</span>
                    
                    </div>
                  </div>
                  
                  <div class="form-group row">
                    <div class="col-sm-12">
                      <select name="kacheri_parent_id1" class="form-control">
                        <option value="">કચેરી સિલેક્ટ કરો</option>
                          @foreach($parent_categories as $parent_category)
                              <option value="{{$parent_category->id}}" 
                                
                             @if($parent_category->id == $data->parent_id )
                             selected
                              @endif    

                              >{{$parent_category->name}}</option>
                          @endforeach
                      </select>
                      <span class="text-danger">@error('kacheri_parent_id1') {{$message}} @enderror</span>
                    
                    </div>
                  </div>

                  </div>
                </div>

                <div class="card-footer">
                  <button type="submit" class="btn btn-danger">પેટાકચેરી સેવ કરો</button>
                </div>
              </form>
            </div>
            @endif

            @if($type == 'department')
            <div class="col-md-4 card card-info">
             <div class="card card-warning">
              <div class="card-header">
                <h3 class="card-title">ડિપાર્ટમેન્ટ Edit કરો</h3>
              </div>
             
              <form method="post" class="form-horizontal" action="{{route('admin.category.update',$data->id)}}">
              <input type="hidden" name="type" value="department">
              @csrf
                <div class="card-body p-2 pt-4">
                  <div class="form-group row">
                    <div class="col-sm-12">
                      
                      <input type="text" class="form-control" name="department_name"
                         placeholder="ડિપાર્ટમેન્ટનું નામ" value="@if(old('department_name')){{old('department_name')}}@else{{$data->name}}@endif">
                         <span class="text-danger">@error('department_name') {{$message}} @enderror</span>
                    
                    </div>
                  </div>
                  <div class="form-group row">
                    <div class="col-sm-12">
                      <textarea class="form-control" name="department_description"
                         placeholder="નોંધ">@if(old('department_description')){{old('department_description')}}@else{{$data->description}}@endif</textarea>

                         <span class="text-danger">@error('department_description') {{$message}} @enderror</span>

                    </div>
                  </div>

                  <div class="form-group row">
                    <div class="col-sm-12">
                      <select name="kacheri_parent_id" class="form-control kacheri_parent_id">
                        <option value="">કચેરી સિલેક્ટ કરો</option>

                          @foreach($parent_categories as $parent_category)
                              <option value="{{$parent_category->id}}"

                              @if($parent_category->id == $parent_category->parentCategories2($data->parent_id)[0]->id )
                             selected
                              @endif    
                              
                          
                              >{{$parent_category->name}}</option>
                          @endforeach
                      </select>
                      <span class="text-danger">@error('kacheri_parent_id') {{$message}} @enderror</span>
                    </div>
                  </div>
                  
                  <div class="form-group row">
                    <div class="col-sm-12">
                      <select name="petaKacheri_parent_id"  class="form-control petaKacheri_parent_id">
                      
                        <option value="{{$data->parent_id}}"
                        
                        @if($parent_category->id == $parent_category->parentCategories1($data->parent_id)[0]->id )
                             selected
                              @endif    
                        >{{$parent_category->parentCategories1($data->parent_id)[0]->name}}</option>

                      </select>
                      <span class="text-danger">@error('petaKacheri_parent_id') {{$message}} @enderror</span>
                    </div>
                  </div>
                  </div>
                </div>

                <div class="card-footer">
                  <button type="submit" class="btn btn-warning">ડિપાર્ટમેન્ટ સેવ કરો</button>
                </div>
              </form>
            </div>


            @endif

            <div class="col-md-8">
            
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
                      <td><a  class="text-info"  href="{{route('admin.category.edit',$parent_category->id)}}?type=kacheri">{{$parent_category->name}}</a></td>
                      <td>
                      
                        @if($parent_category->subCategories1($parent_category->id)->count() > 0)
                        <table class="table-border-none">
                          @foreach($parent_category->subCategories1($parent_category->id) as $subCategory1)
                          <tr>
                            <td>
                            
                            <a  class="text-danger"  href="{{route('admin.category.edit',$subCategory1->id)}}?type=petakacheri">{{$subCategory1->name}}</a>
                              
                                 @if($parent_category->subCategories2($subCategory1->id)->count() > 0)
                                  @foreach($parent_category->subCategories2($subCategory1->id) as $subCategory2)
                                  
                                  <tr>
                                      <td></td>
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
                                  <a class="text-warning" href="{{route('admin.category.edit',$subCategory2->id)}}?type=department">{{$subCategory2->name}}</a>
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
    </section>
  </div>

  @endsection
