
<nav class="navbar navbar-inverse" role="navigation">
    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse navbar-ex6-collapse">
      <ul class="nav navbar-nav">
        <li><img style="padding-bottom: -10; padding-top: 10px;  padding-bottom: -10; height: 40px;" width="30" height="30" src="{{ asset('images/logo.jpg') }}"></li>
          <li><a href="#">{{ trans('userinterface.HOME') }}</a></li>
          <li><a href="{{ route('start') }}">{{ trans('userinterface.SYS') }}</a></li>
          <li class="dropdown">
            <a class="dropdown-toggle" data-toggle="dropdown" href="#">{{ trans('userinterface.CATALOGUES') }}<span class="caret"></span></a>
            <ul class="dropdown-menu">
              @if (App\SUtils\SValidation::hasPermission(\Config::get('scperm.TP_PERMISSION.VIEW'), \Config::get('scperm.VIEW_CODE.USERS')))
                <li>
                  <a href="{{ route('users.index') }}">{{ trans('userinterface.USERS') }}</a>
                </li>
              @endif
              @if (App\SUtils\SValidation::hasPermission(\Config::get('scperm.TP_PERMISSION.VIEW'), \Config::get('scperm.VIEW_CODE.PRIVILEGES')))
                <li>
                  <a href="{{ route('privileges.index') }}">{{ trans('userinterface.PRIVILEGES') }}</a>
                </li>
              @endif
              @if (App\SUtils\SValidation::hasPermission(\Config::get('scperm.TP_PERMISSION.VIEW'), \Config::get('scperm.VIEW_CODE.ASSIGNAMENTS')))
                <li>
                  <a href="{{ route('userPermissions.index') }}">{{ trans('userinterface.USER_PERMISSIONS') }}</a>
                </li>
              @endif
              @if (App\SUtils\SValidation::hasPermission(\Config::get('scperm.TP_PERMISSION.VIEW'), \Config::get('scperm.VIEW_CODE.PERMISSIONS')))
                <li>
                  <a href="{{ route('permissions.index') }}">{{ trans('userinterface.PERMISSIONS') }}</a>
                </li>
              @endif
                <li>
                  <a href="{{ route('companies.index') }}">{{ trans('userinterface.COMPANIES') }}</a>
                </li>
            </ul>
          </li>
        </ul>
        @include('front.templates.userul')

    </div><!-- /.navbar-collapse -->
  </nav>
