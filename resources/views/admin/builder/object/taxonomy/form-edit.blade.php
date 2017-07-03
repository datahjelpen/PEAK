<form method="POST" action="{{ route('object.taxonomy.update', [$object_type->slug, $object_taxonomy->slug]) }}">
	{{ method_field('PATCH') }}
	{{ csrf_field() }}

	@include('admin.builder.object_taxonomy.fields')

	<input type="submit">
</form>