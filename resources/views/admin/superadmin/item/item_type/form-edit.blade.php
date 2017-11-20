<form method="POST" action="{{ route('superadmin.item_type.update', $item_type->slug) }}">
	{{ method_field('PATCH') }}
	{{ csrf_field() }}

	@include('admin.superadmin.item.item_type.fields')

	<input type="submit">
</form>