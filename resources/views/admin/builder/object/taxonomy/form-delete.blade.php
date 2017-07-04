<form method="POST" action="{{ route('object.taxonomy.destroy', [$type->slug, $taxonomy->slug]) }}">
	{{ method_field('DELETE') }}
	{{ csrf_field() }}
	
	<h1>Are you sure you want to delete this taxonomy?</h1>
	<button class="autofocus" type="submit">Yes, delete</button>
	<button type="button" class="modal-close">No, cancel.</button>
</form>