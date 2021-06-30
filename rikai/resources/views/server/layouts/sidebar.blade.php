<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
      <img src="{{ asset('templates/dist/img/AdminLTELogo.png') }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">AdminLTE 3</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="/upload/{{Auth::user()->avatar}}" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">{{Auth::user()->name}}</a>
        </div>
      </div>

      <!-- SidebarSearch Form -->
      <div class="form-inline">
        <div class="input-group" data-widget="sidebar-search">
          <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
          <div class="input-group-append">
            <button class="btn btn-sidebar">
              <i class="fas fa-search fa-fw"></i>
            </button>
          </div>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item menu-open">
            <a href="#" class="nav-link active">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                {{__('views.dashboard')}}
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            
          </li>

          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-chart-pie"></i>
              <p>
                {{__('views.profile')}}
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview" style="display: none;">
              <li class="nav-item">
                <a href="{{route('server.user.show', ['user' => Auth::id()])}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>{{__('views.my_profile')}}</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route('server.user.trainee')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>{{__('views.trainee')}}</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route('server.user.supervisor')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>{{__('views.supervisor')}}</p>
                </a>
              </li>
            </ul>
          </li>

          <li class="nav-item">
            <a href="{{route('server.course.index')}}" class="nav-link">
              <i class="nav-icon far fa-image"></i>
              <p>
                {{__('views.course')}}
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{route('server.subject.index')}}" class="nav-link">
              <i class="nav-icon far fa-image"></i>
              <p>
                {{__('views.subject')}}
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="" class="nav-link">
              <i class="nav-icon far fa-image"></i>
              <p>
                {{__('views.task')}}
              </p>
            </a>
          </li>
          


          
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>