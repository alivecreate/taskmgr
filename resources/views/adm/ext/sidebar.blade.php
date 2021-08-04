
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <a href="{{url('admin')}}" class="brand-link">
      <span class="brand-text font-weight-light text-center text-strong">OFFICE TASK MANAGE</span>
    </a>

    <div class="sidebar">
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">

          @if(session('LoggedUser')->image)
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

      <!-- SidebarSearch Form -->
      <!-- <div class="form-inline">
        <div class="input-group" data-widget="sidebar-search">
          <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
          <div class="input-group-append">
            <button class="btn btn-sidebar">
              <i class="fas fa-search fa-fw"></i>
            </button>
          </div>
        </div>
      </div> -->

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
                <a href="{{route('admin.category')}}" class="nav-link">
                  <i class="fa fa-th-list nav-icon"></i>
                  <p>List</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route('admin.category.create')}}" class="nav-link">
                  <i class="fa fa-plus-square nav-icon"></i>
                  <p>Add New</p>
                </a>
              </li>
            </ul>
          </li>

          
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
                <a href="{{route('employee.index')}}" class="nav-link">
                  <i class="fa fa-address-card nav-icon"></i>
                  <p>List</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route('employee.create')}}" class="nav-link">
                  <i class="fa fa-user-plus nav-icon"></i>
                  <p>Add New</p>
                </a>
              </li>
            </ul>
          </li>


          
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
                <a href="{{route('client.index')}}" class="nav-link">
                  <i class="fa fa-address-card nav-icon"></i>
                  <p>List</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route('client.create')}}" class="nav-link">
                  <i class="fa fa-user-plus nav-icon"></i>
                  <p>Add New</p>
                </a>
              </li>
            </ul>
          </li>


          
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
                <a href="{{route('task.index')}}" class="nav-link">
                  <i class="fa fa-address-card nav-icon"></i>
                  <p>List</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route('task.create')}}" class="nav-link">
                  <i class="fa fa-user-plus nav-icon"></i>
                  <p>Add New</p>
                </a>
              </li>
            </ul>
          </li>

          <li class="nav-item task-assign">
            <a href="#" class="nav-link">
              <i class="nav-icon fa fa-users "></i>
              <p>
              કામગીરી વ્યક્તિ (Task Assign)
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{route('task-assign.index')}}" class="nav-link">
                  <i class="fa fa-address-card nav-icon"></i>
                  <p>List</p>
                </a>
              </li>
              
              <li class="nav-item">
                <a href="{{route('task-assign.create')}}" class="nav-link">
                  <i class="fa fa-user-plus nav-icon"></i>
                  <p>Add New</p>
                </a>
              </li>

            </ul>
          </li>


          <li class="nav-item report">
            <a href="#" class="nav-link">
              <i class="nav-icon fa fa-users "></i>
              <p>
              Reports
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{route('task-assign.index')}}" class="nav-link">
                  <i class="fa fa-address-card nav-icon"></i>
                  <p>List</p>
                </a>
              </li>
              

            </ul>
          </li>


          
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
      <!-- Sidebar Menu -->
      <!-- <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

          <li class="nav-item menu-open">

            <ul class="nav nav-treeview">
          <li class="nav-item">
            <a href="{{url('admin')}}" class="nav-link">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
              </p>
            </a>
          </li>
          
          <li class="nav-item">
            <a href="pages/widgets.html" class="nav-link">
              <i class="nav-icon fas fa-th"></i>
              <p>
                Widgets
              </p>
            </a>
          </li>
          
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon far fa-image"></i>
              <p>
                Slider
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="pages/layout/top-nav.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Slider List</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="pages/layout/top-nav-sidebar.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Add Slider</p>
                </a>
              </li>
            </ul>
          </li>

          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-copy"></i>
              <p>
                Categories
                <i class="fas fa-angle-left right"></i>
                <span class="badge badge-info right">6</span>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="pages/layout/top-nav.html" class="nav-link">
                  <i class="far fa-list nav-icon"></i>
                  <p>Category List</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="pages/layout/top-nav-sidebar.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Add Category</p>
                </a>
              </li>
            </ul>
          </li>

          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-copy"></i>
              <p>
                Products
                <i class="fas fa-angle-left right"></i>
                <span class="badge badge-info right">6</span>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="pages/layout/top-nav.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Product List</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="pages/layout/top-nav-sidebar.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Add Product</p>
                </a>
              </li>
            </ul>
          </li>



          
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-copy"></i>
              <p>
                Gallery
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="pages/layout/top-nav.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Gallery List</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="pages/layout/top-nav-sidebar.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Add Gallery</p>
                </a>
              </li>
            </ul>
          </li>

          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-chart-pie"></i>
              <p>
                Inquiry Reports
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="pages/Reports/chartjs.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Product Inquiry</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="pages/charts/flot.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Contact Inquiry</p>
                </a>
              </li>
            </ul>
          </li>
          
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon far fa-circle text-info"></i>
              <p>Logout</p>
            </a>
          </li>
        </ul>
      </nav> -->
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>