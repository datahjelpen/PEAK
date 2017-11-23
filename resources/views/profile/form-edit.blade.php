<form method="POST" action="{{ route('profile.update', $profile->id) }}" enctype="multipart/form-data">
	{{ method_field('PATCH') }}
	{{ csrf_field() }}

	@include('profile.form-fields')

	<input type="submit">
</form>