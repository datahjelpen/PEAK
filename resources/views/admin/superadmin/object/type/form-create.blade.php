<form method="POST" action="{{ route('superadmin.type.store') }}">
	{{ csrf_field() }}

	@include('admin.superadmin.object.type.fields')

	<input type="submit">
</form>