<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          @auth
          <img src="{{ asset('img/'.Auth::user()->avatar) }}" class="img-circle" alt="User Image">
          @endauth

          @guest
          <img src="{{ asset('img/avatar-invitado.png') }}" class="img-circle" alt="User Image">
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
          @can('capture.create')  
            <li class="{{ Request::is('capture/create') ? 'active' : ''}}"><a href="{{ route('capture.create') }}"><i class="fa fa-plus"></i> Nueva Captura</a></li>
          @endcan
          
          @can('capture.index')
            <li class="{{ Request::is('capture') ? 'active' : ''}}"><a href="{{ route('capture.index') }}"><i class="fa fa-list"></i> Ultimas Capturas</a></li>
          @endcan
          </ul>
        </li>
        

        <li class="treeview {{ Request::is('establishments*') ? 'active menu-open' : ''}}">
          <a href="#">
            <i class="fa fa-home"></i> <span>Establecimientos</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            
            @can('sector.index')
            <li class="{{ Request::is('establishments/sector') ? 'active' : ''}}"><a href="{{ route('sector.index') }}"><i class="fa fa-clone"></i>Sectores</a></li>
            @endcan

            @can('lot.index')
            <li class="{{ Request::is('establishments/lot') ? 'active' : ''}}"><a href="{{ route('lot.index') }}"><i class="fa fa-object-ungroup"></i>Lotes</a></li>
            @endcan

            @can('plank.index')
            <li class="{{ Request::is('establishments/plank') ? 'active' : ''}}"><a href="{{ route('plank.index') }}"><i class="fa fa-object-group"></i>Tablones</a></li>
            @endcan

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
            
            @can('crop.index')
            <li class="{{ Request::is('supplies/crop') ? 'active' : ''}}"><a href="{{ route('crop.index') }}"><i class="fa fa-leaf"></i>Cultivos</a></li>
            @endcan

            @can('variety.index')
            <li class="{{ Request::is('supplies/variety') ? 'active' : ''}}"><a href="{{ route('variety.index') }}"><i class="fa fa-asterisk"></i>Variedades</a></li>
            @endcan

            @can('activity.index')
            <li class="{{ Request::is('activitity') ? 'active' : ''}}"><a href="{{ route('activity.index') }}"><i class="fa fa-list"></i> Lista de Actividades</a></li>
            @endcan
          </ul>
        </li>
     
      
  

        <li class="treeview {{ Request::is('pluviometry*') ? 'active' : ''}}">
          <a href="#">
            <i class="fa fa-umbrella"></i> <span>Pluviometria</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            @can('pluviometry.index')
            <li class="{{ Request::is('pluviometry/create') ? 'active' : ''}}"><a href="{{ route('pluviometry.create') }}"><i class="fa fa-plus"></i> Insertar Pluviometria</a></li>
            @endcan

            @can('pluviometry.index')
            <li class="{{ Request::is('pluviometry') ? 'active' : ''}}"><a href="{{ route('pluviometry.index') }}"><i class="fa fa-list"></i> Ultimos Registros</a></li>
            @endcan

          </ul>
        </li>   


        <!--Ganaderia-->
          
          <li class="treeview {{ Request::is('animal*') ? 'active' : ''}}">
          <a href="#">
            <i class="fa fa-umbrella"></i> <span>Ganader&iacute;a</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
        
          <ul class="treeview-menu">
            @can('animals.index')
            <li class="{{ Request::is('animals/animal') ? 'active' : ''}}"><a href="{{ route('animal.index') }}"><i class="fa fa-paw"></i> Animales</a></li>
            @endcan

            @can('rodeo.index')
            <li class="{{ Request::is('animals/rodeo') ? 'active' : ''}}"><a href="{{ route('rodeo.index') }}"><i class="fa fa-database"></i> Rodeos</a></li>
            @endcan

            @can('weighing.index')
            <li class="{{ Request::is('animals/weighing') ? 'active' : ''}}"><a href="{{ route('weighing.index') }}"><i class="fa fa-balance-scale"></i> Pesajes</a></li>
            @endcan

            @can('paddock.index')
            <li class="{{ Request::is('animals/paddocks') ? 'active' : ''}}"><a href="{{ route('paddock.index') }}"><i class="fa fa-bank"></i> Potreros</a></li>
            @endcan

            @can('specie.index')
            <li class="{{ Request::is('animals/specie') ? 'active' : ''}}"><a href="{{ route('specie.index') }}"><i class="fa fa-cube"></i> Especies</a></li>
            @endcan

            @can('breed.index')
            <li class="{{ Request::is('animals/breeds') ? 'active' : ''}}"><a href="{{ route('breed.index') }}"><i class="fa fa-cubes"></i> Razas</a></li>
            @endcan

          </ul>
        </li>        

        <!-- Fin Ganaderia -->     
        <!--Menu Configuraciones-->
        @if(auth()->user()->hasRole('admin'))
        <li class="header">MENU ADMINISTRADOR</li>
        <li class="treeview {{ Request::is('administration*') ? 'active' : ''}}">
          <a href="#">
            <i class="fa fa-gear"></i> <span>Configuaciones</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
        
          <ul class="treeview-menu">
            <li class="{{ Request::is('administration/user') ? 'active' : ''}}"><a href="{{ route('user.index') }}"><i class="fa fa-user"></i> Usuarios</a></li>
             <li class="{{ Request::is('administration/role') ? 'active' : ''}}"><a href="{{ route('role.index') }}"><i class="fa fa-tasks"></i> Roles</a></li>
             <li class="{{ Request::is('administration/permission') ? 'active' : ''}}"><a href="{{ route('user.index') }}"><i class="fa fa-lock"></i> Permisos</a></li>
          </ul>

        </li>
        @endif 




        <!--Menu Acciones-->
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
        <li><a href="{{ route('register') }}"><i class="fa fa-edit"></i> <span>Registrarse</span></a></li>
        @endguest
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>