<form method="POST" action="{{ route('superadmin.status.store', $type->slug) }}">
	{{ csrf_field() }}

	@include('admin.superadmin.object.status.fields')

	<input type="submit">
</form>