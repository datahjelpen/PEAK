<ul>
	@foreach (['danger', 'warning', 'success', 'info'] as $msg)
		@if (Session::has('alert-' . $msg))
			<li class="alert-{{ $msg }}">{{ Session::get('alert-' . $msg) }}</li>
		@endif
	@endforeach

	@if (count($errors))
		@foreach ($errors->all() as $error)
			<li class="alert-danger">{{ $error }}</li>
		@endforeach
	@endif
</ul>
