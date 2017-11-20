<form method="POST" action="{{ route('admin.term.update', [$item_type->slug, $taxonomy->slug, $term->slug]) }}">
	{{ method_field('PATCH') }}
	{{ csrf_field() }}

	@include('admin.item.term.fields')

	<input type="submit">
</form>