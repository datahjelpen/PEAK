<form method="POST" action="{{ route('superadmin.object.type.store') }}">
	{{ csrf_field() }}

	@include('admin.superadmin.object.type.fields')

	<input type="submit">
</form>