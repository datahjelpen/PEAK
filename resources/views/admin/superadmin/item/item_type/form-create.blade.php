<form method="POST" action="{{ route('superadmin.type.store') }}">
	{{ csrf_field() }}

	@include('admin.superadmin.item.item_type.fields')

	<input type="submit">
</form>