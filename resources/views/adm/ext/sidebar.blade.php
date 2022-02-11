
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <a href="{{url('admin')}}" class="brand-link">
      <span class="brand-text font-weight-light text-center text-strong">OFFICE TASK MANAGE</span>
    </a>

    <div class="sidebar">
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">

        @if(isset(getAdminData(session('LoggedUser')->id)->image))
            <img src="{{url('web')}}/media/sm/{{session('LoggedUser')->image}}" 
            class="img-circle elevation-2 object-fit-sm" style="width:36px; height:36px" alt="User Image">
          @else
            <img class="img-circle elevation-2 object-fit-sm" src="{{url('adm')}}/img/no-user.jpeg">
          @endif

        </div>
        
        <div class="info">
          <a href="#" class="d-block">{{session('LoggedUser')->name}}</a>
        </div>
      </div>


      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        
          <li class="nav-item menu-open">

            <ul class="nav nav-treeview">
          <li class="nav-item dashboard">
            <a href="{{url('admin')}}" class="nav-link">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
              </p>
            </a>
          </li>

          @if(session('LoggedUser')->id == 1)
          <li class="nav-item client">
            <a href="#" class="nav-link">
              <i class="nav-icon fa fa-users "></i>
              <p>
              અરજદાર (Client)
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{route('client.create')}}" class="nav-link">
                  <i class="fa fa-user-plus nav-icon"></i>
                  <p>Add New</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route('client.index')}}" class="nav-link">
                  <i class="fa fa-address-card nav-icon"></i>
                  <p>List</p>
                </a>
              </li>
            </ul>
          </li>
          @endif

          
          
          @if(session('LoggedUser')->id == 1)
          <li class="nav-item task">
            <a href="#" class="nav-link">
              <i class="nav-icon fa fa-users "></i>
              <p>
              ટાસ્ક (Task)
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{route('task.create')}}" class="nav-link">
                  <i class="fa fa-user-plus nav-icon"></i>
                  <p>Add New</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route('task.index')}}" class="nav-link">
                  <i class="fa fa-address-card nav-icon"></i>
                  <p>List</p>
                </a>
              </li>
            </ul>
          </li>
          @endif


          @if(session('LoggedUser')->id == 1)
            <li class="nav-item category">
              <a href="#" class="nav-link">
                <i class="nav-icon fas fa-copy"></i>
                <p>
                  કચેરી / પેટાકચેરી / ડિપાર્ટમેન્ટ
                  <i class="fas fa-angle-left right"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="{{route('admin.category.create')}}" class="nav-link">
                    <i class="fa fa-plus-square nav-icon"></i>
                    <p>Add New</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="{{route('admin.category')}}" class="nav-link">
                    <i class="fa fa-th-list nav-icon"></i>
                    <p>List</p>
                  </a>
                </li>
                
                <li class="nav-item">
                  <a href="{{route('admin.category.viewAll')}}" class="nav-link">
                    <i class="fa fa-th-list nav-icon"></i>
                    <p>Tree View</p>
                  </a>
                </li>
                
              </ul>
            </li>
          @endif

          
          <li class="nav-item task-assign">
            <a href="#" class="nav-link">
              <i class="nav-icon fa fa-users "></i>
              <p>
              કામગીરી વ્યક્તિ (Task Assign)
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
        @if(session('LoggedUser')->id == 1)
              <li class="nav-item">
                <a href="{{route('task-assign.create')}}" class="nav-link">
                  <i class="fa fa-user-plus nav-icon"></i>
                  <p>Add New</p>
                </a>
              </li>
          
        
              <li class="nav-item">
                <a href="{{route('task-assign.index')}}" class="nav-link">
                  <i class="fa fa-address-card nav-icon"></i>
                  <p>List</p>
                </a>
              </li>

              @else
              <li class="nav-item">
                <a href="{{route('admin.task.assign.list')}}" class="nav-link">
                  <i class="fa fa-user-plus nav-icon"></i>
                  <p>List</p>
                </a>
              </li>

              
          @endif


              
            </ul>
          </li>
          

          <li class="nav-item report">
            <a href="#" class="nav-link">
              <i class="nav-icon fa fa-address-card "></i>
              <p>
              Reports
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{route('admin.report.dete-wise')}}" class="nav-link">
                  <i class="fas fa-calendar-alt nav-icon"></i>
                  <p>તારીખ વાઈસ</p>
                </a>
              </li>
              
              <li class="nav-item">
                <a href="{{route('admin.report.status-wise')}}" class="nav-link">
                  <i class="fas fa-check-double nav-icon"></i>
                  <p>સ્ટેટ્સ વાઈસ</p>
                </a>
              </li>
              @if(session('LoggedUser')->id == 1)
                  <li class="nav-item">
                    <a href="{{route('admin.report.client-wise')}}" class="nav-link">
                      <i class="fas fa-users nav-icon"></i>&nbsp;&nbsp;
                      <p>અરજદાર વાઈસ</p>
                    </a>
                  </li>
              @endif
              
                  @if(session('LoggedUser')->id == 1)
                      <li class="nav-item">
                        <a href="{{route('admin.report.employee-wise')}}" class="nav-link">
                          <i class="fas fa-user-clock nav-icon"></i>
                          <p>કર્મચારી વાઈસ</p>
                        </a>
                      </li>
                  @endif
                  
              @if(session('LoggedUser')->id == 1)
                  <li class="nav-item">
                    <a href="{{route('admin.report.category-wise')}}" class="nav-link">
                      <i class="fas fa-align-left"></i> &nbsp;&nbsp;
                      <p>કેટેગરી વાઈસ</p>
                    </a>
                  </li>
              @endif

            </ul>
          </li>


          <li class="nav-item calendar">
            <a href="{{route('admin.full-calender')}}" class="nav-link">
              <i class="nav-icon far fa-calendar-alt "></i>
              <p>
              Calander 
              </p>
            </a>
           
          </li>
              

          @if(session('LoggedUser')->id == 1)
          <li class="nav-item employee">
            <a href="#" class="nav-link">
              <i class="nav-icon fa fa-users "></i>
              <p>
              કર્મચારી (Employee)
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{route('employee.create')}}" class="nav-link">
                  <i class="fa fa-user-plus nav-icon"></i>
                  <p>Add New</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route('employee.index')}}" class="nav-link">
                  <i class="fa fa-address-card nav-icon"></i>
                  <p>List</p>
                </a>
              </li>
            </ul>
          </li>
          @endif



          
            <li class="nav-item">            
            <a href="{{route('auth.logout')}}" class="nav-link">
              <i class="nav-icon fa fa-users "></i>
              <p>
                Logout
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            
            </li>
            
          </ul>
          </nav>
          <hr>
          <br>
          <br>
          <br>
          <br>
          <br>
      
      

    </div>
    <!-- /.sidebar -->
  </aside>