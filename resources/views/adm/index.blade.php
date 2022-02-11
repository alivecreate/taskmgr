@extends('adm.layout.admin-index')
@section('title','Dashboard - Task Manager')
@section('content')

@section('custom-js')
<script>

$(".dashboard").addClass( "menu-is-opening menu-open");
$(".dashboard a").addClass( "active-menu");

</script>
@endsection


<div class="content-wrapper">
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Dashboard</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{url('admin')}}">Home</a></li>
              <li class="breadcrumb-item active">Dashboard</li>
            </ol>
          </div>
        </div>
      </div>
    </div>

    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box">
              <span class="info-box-icon bg-info elevation-1">
                  <small><i class="fa fa-question" aria-hidden="true"></i></small></span>

              <div class="info-box-content">
                <span class="info-box-text">Pending Task</span>
                <span class="info-box-number">
                  {{$pendingTaskCount}}
                </span>
              </div>
            </div>
          </div>

          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
              <span class="info-box-icon bg-warning elevation-1"><i class="fa fa-tasks" aria-hidden="true"></i></span>

              <a href="{{route('admin.report.status-wise')}}?status=1&type=status-wise">
                <div class="info-box-content">
                    <span class="info-box-text">11 Processing Task</span>
                    <span class="info-box-number">
                      {{$processingTaskCount}}
                    </span>
                </div>
              </a>
            </div>
          </div>

          <div class="clearfix hidden-md-up"></div>
          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
              <span class="info-box-icon bg-success elevation-1"><i class="fa fa-check-circle" aria-hidden="true"></i></span>

              <div class="info-box-content">
                <a href="{{route('admin.report.status-wise')}}?status=2&type=status-wise">
                  <span class="info-box-text">Completed Task</span>
                  <span class="info-box-number">
                    {{$completedTaskCount}}
                  </span>
                </a>
              </div>
            </div>
          </div>

          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
              <span class="info-box-icon bg-danger elevation-1"><i class="fa fa-times"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Canceled Task</span>
                <span class="info-box-number">
                  {{$canceledTaskCount}}
                </span>
              </div>
            </div>
          </div>
        </div>
        
        
        <div class="row">
          <div class="col-md-12">
            @include('adm.widget.latest-projects')
          </div>
        
        {{-- 
          <div class="col-md-4">

          @include('adm.widget.recent-activity')
          
          </div>

        --}}
        </div>
      </div>
      
    </section>
  </div>
  

  @endsection