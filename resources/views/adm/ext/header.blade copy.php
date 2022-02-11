<?php

        // if(session()->has('LoggedUser')){
        //     session()->pull('LoggedUser');
        //     dd('ses available');
        // }else{
        //     dd('not available');

        // }

        $userId = session('LoggedUser')->id;

    ?>
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">

    <ul class="navbar-nav">

      <li class="nav-item">

        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>

      </li>

      <li class="nav-item d-none d-sm-inline-block">

        <a href="{{url('admin')}}" class="nav-link">Home</a>

      </li>

    </ul>



    <ul class="navbar-nav ml-auto">

      <li class="nav-item">

        <a class="nav-link" data-widget="navbar-search" href="#" role="button">

          <i class="fas fa-search"></i>

        </a>

        <div class="navbar-search-block">

          <form class="form-inline">

            <div class="input-group input-group-sm">

              <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">

              <div class="input-group-append">

                <button class="btn btn-navbar" type="submit">

                  <i class="fas fa-search"></i>

                </button>

                <button class="btn btn-navbar" type="button" data-widget="navbar-search">

                  <i class="fas fa-times"></i>

                </button>

              </div>

            </div>

          </form>

        </div>

      </li>



        

          

      <li class="nav-item dropdown">

        <a class="nav-link" data-toggle="dropdown" href="#">

          <i class="far fa-comments"></i>
          @if(getTaskComments()->count() > 0)
            <span class="badge badge-danger navbar-badge">{{getTaskComments()->count()}}</span>
          @endif
        </a>

        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">



        @if(getTaskComments()->count() > 0)

          @foreach(getTaskComments() as $taskComment)

            <a href="{{route('task-assign.show',$taskComment->task_assign_id)}}" class="dropdown-item">

              <div class="media">

          @if($taskComment->admin_image)
            <img src="{{url('web')}}/media/sm/{{$taskComment->admin_image}}" 
            class="mr-3 img-circle object-fit" width="40" height="40">
          @else
            <img class="mr-3 img-circle object-fit" width="40" height="40" src="{{url('adm')}}/img/no-user.jpeg">

          @endif



                <div class="media-body">

                  <h3 class="dropdown-item-title">

                    @if($taskComment->comment_type == 'status')
                      <strong>Status:- </strong>
                      <span class="{{getStatusBadgeColor(getTaskStatus($taskComment->comment)->name)}}">{{getTaskStatus($taskComment->comment)->name}}</span>
                    
                    @elseif($taskComment->comment_type == 'file_upload')
                      <strong><i class="fa fa-file" aria-hidden="true"></i> File Upload:- </strong> <br>
                      @if($taskComment->comment)<p>&nbsp;&nbsp;{{$taskComment->comment}}</p>@endif
                    
                    @else
                      <strong>{{$taskComment->comment}}</strong>
                    @endif
                    
                    <span class="float-right text-sm text-danger">

                      <i class="fas fa-star {{getStatusTextColor($taskComment->status_name)}}"></i></span>
                  </h3>

                  <p class="text-sm">{{$taskComment->task_assign_description}}</p>

                  <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> {{dateToDayCalculate($taskComment->comment_created_at)}}</p>

                </div>

              </div>

            </a>

          @endforeach

        @endif

      </li>

      

          

      <li class="nav-item dropdown">

        <a class="nav-link" data-toggle="dropdown" href="#">      

          <i class="far fa-bell"></i>

          @if(getNotifications($userId)->count() > 0)
            <span class="badge badge-danger navbar-badge">{{getNotifications($userId)->count()}}</span>
          @endif
        </a>

        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">


        @if(getNotifications($userId)->count() > 0)

          @foreach(getNotifications($userId) as $notification)

            <a href="{{route('task-assign.show',$notification->task_assign_id)}}" class="dropdown-item">

            

            

              <div class="media">

              @if(isset($notification->client_image))

                <img src="{{url('web')}}/media/sm/{{$notification->client_image}}" 

                class="mr-3 img-circle object-fit" width="40" height="40" alt="Client Image">

              @else

                <img class="mr-3 img-circle object-fit" width="40" height="40" src="{{url('adm')}}/img/no-user.jpeg">

              @endif



                

                <div class="media-body">

                  <h3 class="dropdown-item-title text-danger">
                  
                    {{$notification->comment}}

                  </h3>

                  <p class="text-sm">{{$notification->task_assign_description}}</p>

                  <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> {{dateToDayCalculate($notification->task_created_at)}}



                  <span class="right badge badge-light float-right">{{$notification->client_name}}</span>

                  <span class="right badge badge-dark float-right">New Task</span>

                  </p>
                </div>

                <hr>
              </div>

            </a>

          @endforeach

        @endif



          <div class="dropdown-divider"></div>

          <a href="{{route('task-assign.index')}}" class="dropdown-item dropdown-footer">See All Messages</a>

        </div>

      </li>

      
      <li class="nav-item">
        <a class="nav-link" data-widget="fullscreen" href="#" role="button">
          <i class="fas fa-expand-arrows-alt"></i>
        </a>
      </li>

    </ul>

  </nav>