<form method="POST" action="{{ route('object.term.store', [$type->slug, $taxonomy->slug]) }}">
	{{ csrf_field() }}

	@include('admin.builder.object.term.fields')

	<input type="submit">
</form>