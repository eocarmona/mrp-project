<ul class="nav navbar-nav navbar-right">
  <li class="dropdown">
    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">{{ Auth::check() ? Auth::user()->username : '' }} <span class="caret"></span></a>
    <ul class="dropdown-menu">
      <li><a href="{{ route('start') }}">{{ trans('userinterface.COMPANIES') }}</a></li>
      <li><a href="{{ route('auth.logout') }}">{{ trans('userinterface.EXIT') }}</a></li>
    </ul>
  </li>
</ul>
