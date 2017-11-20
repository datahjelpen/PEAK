<form method="POST" action="{{ route('superadmin.item_type.store') }}">
	{{ csrf_field() }}

	@include('admin.superadmin.item.item_type.fields')

	<input type="submit">
</form>