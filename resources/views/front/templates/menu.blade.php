
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
          <li><a href="#">Inicio</a></li>
          <li><a href="{{ route('start') }}">MRP</a></li>
          <li class="dropdown">
            <a class="dropdown-toggle" data-toggle="dropdown" href="#">Catalogos<span class="caret"></span></a>
            <ul class="dropdown-menu">
              @if (App\SUtils\SValidation::hasPermission(\Config::get('scperm.TP_PERMISSION.VIEW'), \Config::get('scperm.VIEW_CODE.USERS')))
                <li>
                  <a href="{{ route('users.index') }}">Usuarios</a>
                </li>
              @endif
              @if (App\SUtils\SValidation::hasPermission(\Config::get('scperm.TP_PERMISSION.VIEW'), \Config::get('scperm.VIEW_CODE.PRIVILEGES')))
                <li>
                  <a href="{{ route('privileges.index') }}">Privilegios</a>
                </li>
              @endif
              @if (App\SUtils\SValidation::hasPermission(\Config::get('scperm.TP_PERMISSION.VIEW'), \Config::get('scperm.VIEW_CODE.ASSIGNAMENTS')))
                <li>
                  <a href="{{ route('userPermissions.index') }}">Asignación de permisos</a>
                </li>
              @endif
              @if (App\SUtils\SValidation::hasPermission(\Config::get('scperm.TP_PERMISSION.VIEW'), \Config::get('scperm.VIEW_CODE.PERMISSIONS')))
                <li>
                  <a href="{{ route('permissions.index') }}">Permisos</a>
                </li>
              @endif
            </ul>
          </li>
        </ul>
        @include('front.templates.userul')

    </div><!-- /.navbar-collapse -->
  </nav>
