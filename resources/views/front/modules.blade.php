<!DOCTYPE html>
<html lang="es">
	@include('front.templates.head')
<body>

  @include('front.templates.menumodules')

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
				<section>
					@yield('content')
				</section>
      </div>
    </div>
  </div>
</div>
<br />
<br />

<!-- Scripts -->
@include('front.templates.scripts')

@yield('js')

</body>
  <footer>
  @include('front.templates.footer')
  </footer>
</html>
