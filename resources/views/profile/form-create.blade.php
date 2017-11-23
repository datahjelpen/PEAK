<form method="POST" action="{{ route('profile.store') }}" enctype="multipart/form-data">
	{{ csrf_field() }}

	@include('profile.form-fields')

	<input type="submit">
</form>