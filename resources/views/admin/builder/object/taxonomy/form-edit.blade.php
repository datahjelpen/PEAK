<form method="POST" action="{{ route('object.taxonomy.update', [$type->slug, $taxonomy->slug]) }}">
	{{ method_field('PATCH') }}
	{{ csrf_field() }}

	@include('admin.builder.object.taxonomy.fields')

	<input type="submit">
</form>