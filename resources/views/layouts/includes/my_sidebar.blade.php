<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          @auth
          <img src="{{ asset('img/avatar06.png') }}" class="img-circle" alt="User Image">
          @endauth

          @guest
          <img src="{{ asset('img/avatar5.png') }}" class="img-circle" alt="User Image">
          @endguest

        </div>
        <div class="pull-left info">
          @auth
          <p>{{ Auth::user()->name }}</p>
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
          @endauth

          @guest
          <p>Invitado</p>
          <a href="#"><i class="fa fa-circle text-danger"></i> Offline</a>
          @endguest
          
        </div>
      </div>
      <!-- search form -->
      @auth
      
    <!--Validamos si es un Usuario Administrador-->
    

      <form action="#" method="get" class="sidebar-form">
        <div class="input-group">
          <input type="text" name="q" class="form-control" placeholder="Buscar...">
          <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
        </div>
      </form>
      @endauth
      <!-- /.search form -->
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">
        @auth
        <li class="header">MENU PRINCIPAL</li>
        @endauth
        
        @guest
        <li class="header">MENU INVITADO</li>
        @endguest
        
        @auth

        <li class="treeview {{ Request::is('capture*') ? 'active' : ''}}">
          <a href="#">
            <i class="fa fa-dashboard"></i> <span>Capturas</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="{{ Request::is('capture/create') ? 'active' : ''}}"><a href="{{ route('capture.create') }}"><i class="fa fa-plus"></i> Nueva Captura</a></li>
            <li class="{{ Request::is('capture') ? 'active' : ''}}"><a href="{{ route('capture.index') }}"><i class="fa fa-list"></i> Ultimas Capturas</a></li>
          </ul>
        </li>
          @if (Auth::user()->role == 'ADMIN')
        <li class="treeview {{ Request::is('establishments*') ? 'active menu-open' : ''}}">
          <a href="#">
            <i class="fa fa-home"></i> <span>Establecimientos</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="{{ Request::is('establishments/sector') ? 'active' : ''}}"><a href="{{ route('sector.index') }}"><i class="fa fa-clone"></i>Sectores</a></li>

            <li class="{{ Request::is('establishments/lot') ? 'active' : ''}}"><a href="{{ route('lot.index') }}"><i class="fa fa-object-ungroup"></i>Lotes</a></li>

            <li class="{{ Request::is('establishments/plank') ? 'active' : ''}}"><a href="{{ route('plank.index') }}"><i class="fa fa-object-group"></i>Tablones</a></li>
          </ul>
        </li>

        <!-- Insumos -->

        <li class="treeview {{ Request::is('supplies*') ? 'active menu-open' : ''}}">
          <a href="#">
            <i class="fa fa-shopping-cart"></i> <span>Insumos</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="{{ Request::is('supplies/crop') ? 'active' : ''}}"><a href="{{ route('crop.index') }}"><i class="fa fa-leaf"></i>Cultivos</a></li>

            <li class="{{ Request::is('supplies/variety') ? 'active' : ''}}"><a href="{{ route('variety.index') }}"><i class="fa fa-asterisk"></i>Variedades</a></li>

            <li class="{{ Request::is('supplies/fertilizer') ? 'active' : ''}}"><a href="{{ route('fertilizer.index') }}"><i class="fa fa-asterisk"></i>Fertilizantes</a></li>
          </ul>
        </li>
     

        <!-- END Insumos-->
     


         <li class="treeview {{ Request::is('crop*') ? 'active' : ''}}">
          <a href="#">
            <i class="fa fa-leaf"></i> <span>Cultivos</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="{{ Request::is('crop/create') ? 'active' : ''}}"><a href="{{ route('crop.create') }}"><i class="fa fa-plus"></i> Crear Cultivo</a></li>
            <li class="{{ Request::is('crop') ? 'active' : ''}}"><a href="{{ route('crop.index') }}"><i class="fa fa-list"></i> Lista de Cultivos</a></li>
          </ul>
        </li>               


         <li class="treeview {{ Request::is('variety*') ? 'active' : ''}}">
          <a href="#">
            <i class="fa fa-asterisk"></i> <span>Variedades</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="{{ Request::is('variety/create') ? 'active' : ''}}"><a href="{{ route('variety.create') }}"><i class="fa fa-plus"></i> Crear Variedad</a></li>
            <li class="{{ Request::is('variety') ? 'active' : ''}}"><a href="{{ route('variety.index') }}"><i class="fa fa-list"></i> Lista de Variedades</a></li>
          </ul>
        </li>

         <li class="treeview {{ Request::is('activity*') ? 'active' : ''}}">
          <a href="#">
            <i class="fa fa- fa-tasks"></i> <span>Actividades</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="{{ Request::is('activity/create') ? 'active' : ''}}"><a href="{{ route('activity.create') }}"><i class="fa fa-plus"></i> Crear Actividad</a></li>
            <li class="{{ Request::is('activitity') ? 'active' : ''}}"><a href="{{ route('activity.index') }}"><i class="fa fa-list"></i> Lista de Actividades</a></li>
          </ul>
        </li>        
        @endif
        <li class="treeview {{ Request::is('pluviometry*') ? 'active' : ''}}">
          <a href="#">
            <i class="fa fa-umbrella"></i> <span>Pluviometria</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="{{ Request::is('pluviometry/create') ? 'active' : ''}}"><a href="{{ route('pluviometry.create') }}"><i class="fa fa-plus"></i> Insertar Pluviometria</a></li>
            <li class="{{ Request::is('pluviometry') ? 'active' : ''}}"><a href="{{ route('pluviometry.index') }}"><i class="fa fa-list"></i> Ultimos Registros</a></li>
          </ul>
        </li>        


        <li class="header">ACCIONES</li>
        <li><a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" ><i class="fa fa-bar-chart text-green"></i> <span>Ver Reportes</span></a></li>
        <li><a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" ><i class="fa fa-sign-out text-red"></i> <span>Cerrar Sesión</span></a></li>
        <li><a href="#"><i class="fa fa-user text-yellow"></i> <span>Ver Perfil</span></a></li>
        <form id="logout-form" 
                        action="{{ route('logout') }}" 
                        method="POST" 
                        style="display: none;">
                        {{ csrf_field() }}
                  </form>
       
        @endauth

        @guest

        <li><a href="{{ route('login') }}"><i class="fa fa-sign-in"></i> <span>Login</span></a></li>
        @endguest
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>