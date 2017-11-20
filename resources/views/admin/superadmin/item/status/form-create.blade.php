<form method="POST" action="{{ route('superadmin.status.store', $item_type->slug) }}">
	{{ csrf_field() }}

	@include('admin.superadmin.item.status.fields')

	<input type="submit">
</form>