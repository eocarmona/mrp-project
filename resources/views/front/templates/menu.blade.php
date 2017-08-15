
<nav class="navbar navbar-inverse" role="navigation">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex6-collapse">
        <span class="sr-only">Desplegar navegación</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>

    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse navbar-ex6-collapse">
      <ul class="nav navbar-nav">
        <li><img style="padding-bottom: -10; padding-top: 10px;  padding-bottom: -10; height: 40px;" width="30" height="30" src="{{ asset('images/logo.jpg') }}"></li>
        @if(Auth::user())
        <li><a href="#">Inicio</a></li>
        <li><a href="{{ route('start') }}">MRP</a></li>
        <li class="dropdown">
          <a class="dropdown-toggle" data-toggle="dropdown" href="#">Catalogos
          <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li style="display: {{ App\SUtils\SValidation::showMenu(Config::get('constants.VIEW_CODE.USERS')) }};"><a href="{{ route('users.index') }}">Usuarios</a></li>
            <li style="display: {{ App\SUtils\SValidation::showMenu(Config::get('constants.VIEW_CODE.PRIVILEGES')) }};"><a href="{{ route('privileges.index') }}">Privilegios</a></li>
            <li style="display: {{ App\SUtils\SValidation::showMenu(Config::get('constants.VIEW_CODE.ASSIGNAMENTS')) }};"><a href="{{ route('userPermissions.index') }}">Asignación de permisos</a></li>
            <li style="display: {{ App\SUtils\SValidation::showMenu(Config::get('constants.VIEW_CODE.PERMISSIONS')) }};"><a href="{{ route('permissions.index') }}">Permisos</a></li>
          </ul>
        </li>
      </ul>
      <ul class="nav navbar-nav navbar-right">
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">{{ Auth::user()->username }} <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="{{ route('auth.logout') }}">Salir</a></li>
          </ul>
        </li>
      @endif
      </ul>

    </div><!-- /.navbar-collapse -->
  </nav>
