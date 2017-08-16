<!DOCTYPE html>
<html lang="es">
	@include('front.head')
<body>
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
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>

<div class="container">
  <div class="row">
    <div class="panel panel-default">
      <div class="panel-heading">
        <h2 class="panel-title">@yield('title')</h2>
      </div>
      <div class="panel-body">
        <section>
          @include('flash::message')
          @include('front.templates.error')

        </section>
      </div>
    </div>
  </div>
</div>

<!-- Scripts -->
<script src="{{ asset('/jquery/js/jquery-3.2.1.js')}}"></script>
<script src="{{ asset('bootstrap/js/bootstrap.js')}}"></script>
<script src="{{ asset('chosen/chosen.jquery.js') }}"></script>
<script src="{{ asset('Trumbowyg/dist/trumbowyg.min.js') }}"></script>

@yield('js')

</body>
  <footer>
  @include('front.templates.footer')
  </footer>
</html>
