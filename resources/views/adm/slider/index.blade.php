@extends('adm.layout.admin-index')
@section('title','Dashboard - Task Manager')
@section('content')


<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Slider Manage</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{url('admin')}}">Home</a></li>
              <li class="breadcrumb-item active">Sliders</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- SELECT2 EXAMPLE -->
        <div class="card card-default">
        
          <div class="card-body">
            <div class="form-horizontal row">
            
            <div class="col-md-4 card card-info">
              <div class="card card-info">
              <div class="card-header">
                <h3 class="card-title">Slider 1</h3>
              </div>
             
              <form class="form-horizontal">
                <div class="card-body p-2 pt-4">
                  <div class="form-group row">
                    <div class="col-sm-12">
                    <input type="hidden" class="form-control" name="slider_id" value="1">
                      
                      <input type="text" class="form-control" name="title"
                         placeholder="Title">
                    </div>
                  </div>
                  <div class="form-group row">
                    <div class="col-sm-12">
                      <input type="descriotion" class="form-control" name="description"
                         placeholder="Description">
                    </div>
                  </div>
                <div class="form-group row">
                    
                    <div class="col-sm-12">
                    <input type="file" class="" 
                      name="slider_img" placeholder="Slider Image">
                      </div>
                  </div>

                  <div class="form-group row">
                    <div class="col-sm-6">
                      <div class="form-check">
                        <input type="checkbox" class="form-check-input" id="exampleCheck2">
                        <label class="form-check-label" for="exampleCheck2">Status</label>
                      </div>
                    </div>
                    
                  <div class="col-sm-6">
                      <div class="form-check">
                        <img src="https://mailvadodara.com/web/media/sm/1623500729_340.jpeg"
                          width="100%" alt="" class="img-thumbnail">
                      </div>
                    </div>
                  </div>
                  </div>
                </div>

                <div class="card-footer">
                  <button type="submit" class="btn btn-info">Save Slider</button>
                </div>
              </form>
            </div>

            <div class="col-md-4 card card-info">
              <div class="card card-info">
              <div class="card-header">
                <h3 class="card-title">Slider 2</h3>
              </div>
             
              <form class="form-horizontal">
                <div class="card-body p-2 pt-4">
                  <div class="form-group row">
                    <div class="col-sm-12">
                    <input type="hidden" class="form-control" name="slider_id" value="2">
                      
                      <input type="text" class="form-control" name="title"
                         placeholder="Title">
                    </div>
                  </div>
                  <div class="form-group row">
                    <div class="col-sm-12">
                      <input type="descriotion" class="form-control" name="description"
                         placeholder="Description">
                    </div>
                  </div>
                <div class="form-group row">
                    
                    <div class="col-sm-12">
                    <input type="file" class="" 
                      name="slider_img" placeholder="Slider Image">
                      </div>
                  </div>

                  <div class="form-group row">
                    <div class="col-sm-6">
                      <div class="form-check">
                        <input type="checkbox" class="form-check-input" id="exampleCheck2">
                        <label class="form-check-label" for="exampleCheck2">Status</label>
                      </div>
                    </div>
                    
                  <div class="col-sm-6">
                      <div class="form-check">
                        <img src="https://mailvadodara.com/web/media/sm/1623500729_340.jpeg"
                          width="100%" alt="" class="img-thumbnail">
                      </div>
                    </div>
                  </div>
                  </div>
                </div>

                <div class="card-footer">
                  <button type="submit" class="btn btn-info">Save Slider</button>
                </div>
              </form>
            </div>

            <div class="col-md-4 card card-info">
              <div class="card card-info">
              <div class="card-header">
                <h3 class="card-title">Slider 3</h3>
              </div>
             
              <form class="form-horizontal">
                <div class="card-body p-2 pt-4">
                  <div class="form-group row">
                    <div class="col-sm-12">
                    <input type="hidden" class="form-control" name="slider_id" value="3">
                      
                      <input type="text" class="form-control" name="title"
                         placeholder="Title">
                    </div>
                  </div>
                  <div class="form-group row">
                    <div class="col-sm-12">
                      <input type="descriotion" class="form-control" name="description"
                         placeholder="Description">
                    </div>
                  </div>
                <div class="form-group row">
                    
                    <div class="col-sm-12">
                    <input type="file" class="" 
                      name="slider_img" placeholder="Slider Image">
                      </div>
                  </div>

                  <div class="form-group row">
                    <div class="col-sm-6">
                      <div class="form-check">
                        <input type="checkbox" class="form-check-input" id="exampleCheck2">
                        <label class="form-check-label" for="exampleCheck2">Status</label>
                      </div>
                    </div>
                    
                  <div class="col-sm-6">
                      <div class="form-check">
                        <img src="https://mailvadodara.com/web/media/sm/1623500729_340.jpeg"
                          width="100%" alt="" class="img-thumbnail">
                      </div>
                    </div>
                  </div>
                  </div>
                </div>

                <div class="card-footer">
                  <button type="submit" class="btn btn-info">Save Slider</button>
                </div>
              </form>
            </div>


            <div class="col-md-4 card card-info">
              <div class="card card-info">
              <div class="card-header">
                <h3 class="card-title">Slider 4</h3>
              </div>
             
              <form class="form-horizontal">
                <div class="card-body p-2 pt-4">
                  <div class="form-group row">
                    <div class="col-sm-12">
                    <input type="hidden" class="form-control" name="slider_id" value="4">
                      
                      <input type="text" class="form-control" name="title"
                         placeholder="Title">
                    </div>
                  </div>
                  <div class="form-group row">
                    <div class="col-sm-12">
                      <input type="descriotion" class="form-control" name="description"
                         placeholder="Description">
                    </div>
                  </div>
                <div class="form-group row">
                    
                    <div class="col-sm-12">
                    <input type="file" class="" 
                      name="slider_img" placeholder="Slider Image">
                      </div>
                  </div>

                  <div class="form-group row">
                    <div class="col-sm-6">
                      <div class="form-check">
                        <input type="checkbox" class="form-check-input" id="exampleCheck2">
                        <label class="form-check-label" for="exampleCheck2">Status</label>
                      </div>
                    </div>
                    
                  <div class="col-sm-6">
                      <div class="form-check">
                        <img src="https://mailvadodara.com/web/media/sm/1623500729_340.jpeg"
                          width="100%" alt="" class="img-thumbnail">
                      </div>
                    </div>
                  </div>
                  </div>
                </div>

                <div class="card-footer">
                  <button type="submit" class="btn btn-info">Save Slider</button>
                </div>
              </form>
            </div>


            <div class="col-md-4 card card-info">
              <div class="card card-info">
              <div class="card-header">
                <h3 class="card-title">Slider 5</h3>
              </div>
             
              <form class="form-horizontal">
                <div class="card-body p-2 pt-4">
                  <div class="form-group row">
                    <div class="col-sm-12">
                    <input type="hidden" class="form-control" name="slider_id" value="5">
                      
                      <input type="text" class="form-control" name="title"
                         placeholder="Title">
                    </div>
                  </div>
                  <div class="form-group row">
                    <div class="col-sm-12">
                      <input type="descriotion" class="form-control" name="description"
                         placeholder="Description">
                    </div>
                  </div>
                <div class="form-group row">
                    
                    <div class="col-sm-12">
                    <input type="file" class="" 
                      name="slider_img" placeholder="Slider Image">
                      </div>
                  </div>

                  <div class="form-group row">
                    <div class="col-sm-6">
                      <div class="form-check">
                        <input type="checkbox" class="form-check-input" id="exampleCheck2">
                        <label class="form-check-label" for="exampleCheck2">Status</label>
                      </div>
                    </div>
                    
                  <div class="col-sm-6">
                      <div class="form-check">
                        <img src="https://mailvadodara.com/web/media/sm/1623500729_340.jpeg"
                          width="100%" alt="" class="img-thumbnail">
                      </div>
                    </div>
                  </div>
                  </div>
                </div>

                <div class="card-footer">
                  <button type="submit" class="btn btn-info">Save Slider</button>
                </div>
              </form>
            </div>

            <div class="col-md-4 card card-info">
              <div class="card card-info">
              <div class="card-header">
                <h3 class="card-title">Slider 6</h3>
              </div>
             
              <form class="form-horizontal">
                <div class="card-body p-2 pt-4">
                  <div class="form-group row">
                    <div class="col-sm-12">
                    <input type="hidden" class="form-control" name="slider_id" value="6">
                      
                      <input type="text" class="form-control" name="title"
                         placeholder="Title">
                    </div>
                  </div>
                  <div class="form-group row">
                    <div class="col-sm-12">
                      <input type="descriotion" class="form-control" name="description"
                         placeholder="Description">
                    </div>
                  </div>
                <div class="form-group row">
                    
                    <div class="col-sm-12">
                    <input type="file" class="" 
                      name="slider_img" placeholder="Slider Image">
                      </div>
                  </div>

                  <div class="form-group row">
                    <div class="col-sm-6">
                      <div class="form-check">
                        <input type="checkbox" class="form-check-input" id="exampleCheck2">
                        <label class="form-check-label" for="exampleCheck2">Status</label>
                      </div>
                    </div>
                    
                  <div class="col-sm-6">
                      <div class="form-check">
                        <img src="https://mailvadodara.com/web/media/sm/1623500729_340.jpeg"
                          width="100%" alt="" class="img-thumbnail">
                      </div>
                    </div>
                  </div>
                  </div>
                </div>

                <div class="card-footer">
                  <button type="submit" class="btn btn-info">Save Slider</button>
                </div>
              </form>
            </div>

            

          </div>
          
          <div class="card-footer">
            Visit <a href="https://select2.github.io/">Select2 documentation</a> for more examples and information about
            the plugin.
          </div>
        </div>


      </div>
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>

  @endsection