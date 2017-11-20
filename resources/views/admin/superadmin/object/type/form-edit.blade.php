<form method="POST" action="{{ route('superadmin.type.update', $item_type->slug) }}">
	{{ method_field('PATCH') }}
	{{ csrf_field() }}

	@include('admin.superadmin.item.type.fields')

	<input type="submit">
</form>