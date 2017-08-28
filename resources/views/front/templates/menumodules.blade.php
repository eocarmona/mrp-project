<nav class="navbar {{ $sClassNav }}">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <img style="padding-bottom: -5; padding-top: 5px;  padding-bottom: -5; height: 45px;" width="50" height="50" src="{{ asset('images/logo.jpg') }}">
    </div>
    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse">
			<ul class="nav navbar-nav">
				@include(config('laravel-menu.views.bootstrap-items'), array('items' => $sMenu->roots()))
			</ul>
      @include('front.templates.userul')
      @include('front.templates.navmodules')
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>
