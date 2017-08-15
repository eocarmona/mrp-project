<!DOCTYPE html>
<html lang="es">
	@include('front.head')
<body>
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
		<div class="col-md-12">
			@include('front.templates.start')
		</div>
		<div class="panel-body">


		</div>
		<div class="col-md-4">
		</div>
	</div>
	</div>
	</div>

	<script src="{{ asset('/jquery/js/jquery-3.2.1.js')}}"></script>
	<script src="{{ asset('list-group/listgroup.js')}}"></script>
	<script src="{{ asset('bootstrap/js/bootstrap.js')}}"></script>
	<script src="{{ asset('chosen/chosen.jquery.js') }}"></script>
	<script src="{{ asset('Trumbowyg/dist/trumbowyg.min.js') }}"></script>

	@yield('js')

</body>
</html>
