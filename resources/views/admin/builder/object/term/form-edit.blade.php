<form method="POST" action="{{ route('object.term.update', [$type->slug, $taxonomy->slug, $term->slug]) }}">
	{{ method_field('PATCH') }}
	{{ csrf_field() }}

	@include('admin.builder.object.term.fields')

	<input type="submit">
</form>