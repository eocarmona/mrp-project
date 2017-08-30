<!DOCTYPE html>
<html lang="es">
	@include('front.templates.head')
<body>
	@if (Auth::check())
		@include('front.templates.menu')
	@else
		<br />
	@endif

	<div class="container">

	<div class="row">
		<div class="panel panel-default">
		<div class="panel-heading">
			<h2 class="panel-title">@yield('title')</h2>
		</div>

		<div class="col-md-12">

		</div>
		<div class="panel-body">
			<section>
				@include('flash::message')
				@include('front.templates.error')

				@yield('content')
			</section>

		</div>
		<div class="col-md-4">
		</div>
	</div>
	</div>


@include('front.templates.scripts')

</div>

<footer>
	@include('front.templates.footer')
</footer>

</body>
</html>
