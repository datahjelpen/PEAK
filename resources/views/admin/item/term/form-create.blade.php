<form method="POST" action="{{ route('admin.term.store', [$item_type->slug, $taxonomy->slug]) }}">
	{{ csrf_field() }}

	@include('admin.item.term.fields')

	<input type="submit">
</form>