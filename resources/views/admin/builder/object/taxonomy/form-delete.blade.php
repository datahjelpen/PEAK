<form method="POST" action="{{ route('object.taxonomy.destroy', [$object_type->slug, $object_taxonomy->slug]) }}">
	{{ method_field('DELETE') }}
	{{ csrf_field() }}
	
	<h1>Are you sure you want to delete this object taxonomy?</h1>
	<button class="autofocus" type="submit">Yes, delete</button>
	<button type="button" class="modal-close">No, cancel.</button>
</form>