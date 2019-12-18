 <!-- Logo -->
    <a href="{{ route('home') }}" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>GB</b>System</span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>GB</b>System</span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->

<nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </a>

      <div class="navbar-custom-menu">
        <!-- MENU NAVBAR -->
        <ul class="nav navbar-nav">
           @auth
          <!-- Messages: style can be found in dropdown.less-->

          <!-- Notifications: style can be found in dropdown.less -->
          <li class="dropdown notifications-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <i class="fa fa-bell-o"></i>
              <span class="label label-warning">10</span>
            </a>
            <ul class="dropdown-menu">
              <li class="header">You have 10 notifications</li>
              <li>
                <!-- inner menu: contains the actual data -->
                <ul class="menu">
                  <li>
                    <a href="#">
                      <i class="fa fa-users text-aqua"></i> Nuevas Actualizaciones
                    </a>
                  </li>
                </ul>
              </li>
              <li class="footer"><a href="#">Ver Todas</a></li>
            </ul>
          </li>

          <!-- User Account: style can be found in dropdown.less -->
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <img src="{{ asset ('img/uploads/avatars/thumbnail/'.Auth::user()->avatar) }}" class="user-image" alt="User Image">
             
              <span class="hidden-xs">{{ Auth::user()->name }}</span>
               
            </a>
            <ul class="dropdown-menu">
              <!-- User image -->
              <li class="user-header">
                <img src="{{ asset ('img/uploads/avatars/thumbnail/'.Auth::user()->avatar) }}" class="img-circle" alt="User Image">

                <p>
                  
                  {{ Auth::user()->name }} - {{ auth()->user()->hasRole('admin') ? 'Administrador' : 'Usuario'}}
                  <small>Miembro desde el {{ Auth::user()->created_at->format('d/m/Y') }}</small>
                </p>
              </li>
              <!-- Menu Body -->

              <!-- Menu Footer-->
              <li class="user-footer">
                <div class="pull-left">
                  <a href="{{ route('user.profile') }}" class="btn btn-default btn-flat">Mi Perfil</a>
                </div>
                <div class="pull-right">
                
                  <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form2').submit();" class="btn btn-default btn-flat">Cerrar Sesi&oacute;n</a>
                  
                </div>
              </li>
                </ul>
          </li>
          <!-- Control Sidebar Toggle Button -->
          <li>
            <a title="Cerrar Sesi&oacute;n" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form2').submit();" data-toggle="control-sidebar"><i class="fa fa-sign-out"></i></a>
          </li>

          <form id="logout-form2" 
                        action="{{ route('logout') }}" 
                        method="POST" 
                        style="display: none;">
                        {{ csrf_field() }}
                  </form>
              @endauth
          
          @guest
              <li>
                  <a href="{{ route('login') }}"><i class="fa fa-sign-in"></i></a>
              </li>
              @endguest 
        </ul>
       <!-- FIN - MENU NAVBAR --> 
      </div>
    </nav>