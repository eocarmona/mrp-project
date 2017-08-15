<!DOCTYPE html>
<html lang="es">
	@include('front.head')
	<body>
		<div class="container">
			<div class="row">
				<div class="panel panel-default">
				<div class="panel-heading col-md-12">
					<div class="col-md-10">
						<h2 class="panel-title">@yield('title')</h2>
					</div>
					<div style="text-align: right;" class="dropdown col-md-2">
						<button class="btn btn-default dropdown-toggle"
												type="button" id="dropdownMenu1"
												data-toggle="dropdown"
												aria-haspopup="true" aria-expanded="true">
							{{ session('company')->name }}
						  <span class="caret"></span>
						</button>
						<ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
							@if (\Auth::user()->user_type_id == \Config::get('constants.TP_USER.ADMIN'))
								<li>
				            <a href="{{ route('Plantilla.index') }}">Administrar</a>
				        </li>
							@endif
				        <li>
				            <a href="{{ route('auth.logout') }}">Salir</a>
				        </li>
			      </ul>
					</div>
				</div>
				<div class="panel-body">
					<section>
						@include('flash::message')
						@include('front.templates.error')
						<div class="col-md-12">
							@yield('content')
						</div>
					</section>
				</div>
			</div>
		</div>

		<script src="{{ asset('/jquery/js/jquery-3.2.1.js')}}"></script>
		<script src="{{ asset('list-group/listgroup.js')}}"></script>
		<script src="{{ asset('bootstrap/js/bootstrap.js')}}"></script>
		<script src="{{ asset('chosen/chosen.jquery.js') }}"></script>
		<script src="{{ asset('Trumbowyg/dist/trumbowyg.min.js') }}"></script>

		</div>

		<footer>
			@include('front.templates.footer')
		</footer>

	</body>
</html>
