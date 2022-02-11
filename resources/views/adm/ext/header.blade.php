<?php

        // if(session()->has('LoggedUser')){
        //     session()->pull('LoggedUser');
        //     dd('ses available');
        // }else{
        //     dd('not available');

        // }

        if(session('LoggedUser')){
           $userId = session('LoggedUser')->id;
        }
        else{
          dd(session('LoggedUser'));
        }
        // if($userId == 1){
        //     $commentUrl = route('task-assign.show',$notification->task_assign_id);
        //     $commentUrl = route('task-assign.show',$notification->task_assign_id);
        // }else{
        //   $commentUrl = route('task-assign.show',$notification->task_assign_id);

        // } 


        // dd(getTaskCommentsById($userId));

        // dd(getTaskComments());
        // dd(getTaskCommentsById($userId));
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

      <li class="nav-item dropdown">

        <a class="nav-link" data-toggle="dropdown" href="#">

          <i class="far fa-comments"></i>

          @if(getTaskCommentsById($userId)->count() > 0)
            <span class="badge badge-danger navbar-badge">{{getTaskCommentsById($userId)->count()}}</span>
          @endif

        </a>

        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
        @if($userId == 1)
        @if(getTaskCommentsById($userId)->count() > 0)
          @foreach(getTaskCommentsById($userId) as $taskComment)

            <a href="{{route('task-assign.show',$taskComment->task_assign_id)}}?employee={{$taskComment->admin_id}}" class="dropdown-item">

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
                      <p class="text-strong">{{$taskComment->comment}}</p>
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

        @else
 @if(getTaskCommentsById($userId)->count() > 0)
          @foreach(getTaskCommentsById($userId) as $taskComment)

            <a href="{{url('admin')}}/task-assign-show/{{$taskComment->task_assign_id}}" class="dropdown-item">
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
                      <h5><p>{{$taskComment->comment}}</p></h5>
                    @endif
                    
                    <span class="float-right text-sm text-danger">

                      <i class="fas fa-star {{getStatusTextColor($taskComment->status_name)}}"></i></span>
                  </h3>

                  <h6><p>{{$taskComment->task_assign_description}}</p></h6>

                  <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> {{dateToDayCalculate($taskComment->comment_created_at)}}</p>

                </div>

              </div>

            </a>

          @endforeach
        @endif

        
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


        @if($userId == 1)
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

        @else

        @if(getNotifications($userId)->count() > 0)
          @foreach(getNotifications($userId) as $notification)
            <a href="{{url('admin')}}/task-assign-show/{{$notification->task_assign_id}}" class="dropdown-item">
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