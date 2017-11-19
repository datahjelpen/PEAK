<form method="POST" action="{{ route('admin.term.update', [$type->slug, $taxonomy->slug, $term->slug]) }}">
	{{ method_field('PATCH') }}
	{{ csrf_field() }}

	@include('admin.object.term.fields')

	<input type="submit">
</form>