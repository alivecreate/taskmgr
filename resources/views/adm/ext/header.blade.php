
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">

    <ul class="navbar-nav">

      <li class="nav-item">

        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>

      </li>

      <li class="nav-item d-none d-sm-inline-block">

        <a href="index3.html" class="nav-link">Home</a>

      </li>

      <li class="nav-item d-none d-sm-inline-block">

        <a href="#" class="nav-link">Contact</a>

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

          <span class="badge badge-danger navbar-badge">{{getTaskComments()->count()}}</span>

        </a>

        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">



        @if(getTaskComments()->count() > 0)

          @foreach(getTaskComments() as $taskComment)

            <a href="{{route('task-assign.show',$taskComment->task_assign_id)}}" class="dropdown-item">

              <div class="media">
            dd($taskComment);
          @if($taskComment->admin_image)

            <img src="{{url('web')}}/media/sm/{{$taskComment->admin_image}}" 

            class="mr-3 img-circle object-fit" width="40" height="40" alt="Admin Image">

          @else

            <img class="mr-3 img-circle object-fit" width="40" height="40" src="{{url('adm')}}/img/no-user.jpeg">

          @endif



                <div class="media-body">

                  <h3 class="dropdown-item-title">

                    @if($taskComment->comment_type == 'status')

                      <strong>Status:- </strong>

                        

                      <span class="{{getStatusBadgeColor(getTaskStatus($taskComment->comment)->name)}}">{{getTaskStatus($taskComment->comment)->name}}</span>

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



          <div class="dropdown-divider"></div>

          <a href="#" class="dropdown-item dropdown-footer">See All Messages</a>

        </div>

      </li>

      

          

      <li class="nav-item dropdown">

        <a class="nav-link" data-toggle="dropdown" href="#">      

          <i class="far fa-bell"></i>

          <span class="badge badge-danger navbar-badge">{{getTaskAssign()->count()}}</span>

        </a>

        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">



        @if(getTaskAssign()->count() > 0)

          @foreach(getTaskAssign() as $taskAssign)

            <a href="{{route('task-assign.show',$taskAssign->task_assign_id)}}" class="dropdown-item">

            

            

              <div class="media">

              @if($taskAssign->client_image)

                <img src="{{url('web')}}/media/sm/{{$taskAssign->client_image}}" 

                class="mr-3 img-circle object-fit" width="40" height="40" alt="Client Image">

              @else

                <img class="mr-3 img-circle object-fit" width="40" height="40" src="{{url('adm')}}/img/no-user.jpeg">

              @endif



                

                <div class="media-body">

                  <h3 class="dropdown-item-title">

                    {{$taskAssign->task_description}}

                  </h3>

                  <p class="text-sm">{{$taskAssign->task_name}}</p>

                  <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> {{dateToDayCalculate($taskAssign->task_created_at)}}



                  <span class="right badge badge-light float-right">{{$taskAssign->client_name}}</span>

                  <span class="right badge badge-dark float-right">New Task</span>

                  </p>

                </div>

              </div>

            </a>

          @endforeach

        @endif



          <div class="dropdown-divider"></div>

          <a href="#" class="dropdown-item dropdown-footer">See All Messages</a>

        </div>

      </li>

      

      <li class="nav-item dropdown">

        <a class="nav-link" data-toggle="dropdown" href="#">

          <i class="far fa-bell"></i>

          <span class="badge badge-warning navbar-badge">15</span>

        </a>

        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">

          <span class="dropdown-item dropdown-header">15 Notifications</span>

          <div class="dropdown-divider"></div>

          <a href="#" class="dropdown-item">

            <i class="fas fa-envelope mr-2"></i> 4 new messages

            <span class="float-right text-muted text-sm">3 mins</span>

          </a>

          <div class="dropdown-divider"></div>

          <a href="#" class="dropdown-item">

            <i class="fas fa-users mr-2"></i> 8 friend requests

            <span class="float-right text-muted text-sm">12 hours</span>

          </a>

          <div class="dropdown-divider"></div>

          <a href="#" class="dropdown-item">

            <i class="fas fa-file mr-2"></i> 3 new reports

            <span class="float-right text-muted text-sm">2 days</span>

          </a>

          <div class="dropdown-divider"></div>

          <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a>

        </div>

      </li>

      <li class="nav-item">

        <a class="nav-link" data-widget="fullscreen" href="#" role="button">

          <i class="fas fa-expand-arrows-alt"></i>

        </a>

      </li>

      <li class="nav-item">

        <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#" role="button">

          <i class="fas fa-th-large"></i>

        </a>

      </li>

    </ul>

  </nav>

  <!-- /.navbar -->

