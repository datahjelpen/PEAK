<form method="POST" action="{{ route('superadmin.taxonomy.store', $item_type->slug) }}">
	{{ csrf_field() }}

	@include('admin.superadmin.item.taxonomy.fields')

	<input type="submit">
</form>