<form method="POST" action="{{ route('superadmin.taxonomy.update', [$item_type->slug, $taxonomy->slug]) }}">
	{{ method_field('PATCH') }}
	{{ csrf_field() }}

	@include('admin.superadmin.item.taxonomy.fields')

	<input type="submit">
</form>