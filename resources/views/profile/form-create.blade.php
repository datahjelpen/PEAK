<form method="POST" action="{{ route('profile.store') }}">
	{{ csrf_field() }}

	@include('profile.form-fields')

	<input type="submit">
</form>