<form method="POST" action="{{ route('object.taxonomy.store', $object_type->slug) }}">
	{{ csrf_field() }}

	@include('admin.builder.object_taxonomy.fields')

	<input type="submit">
</form>