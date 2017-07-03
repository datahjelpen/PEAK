<form method="POST" action="{{ route('object_type.destroy', $object_type->id) }}">
	{{ method_field('DELETE') }}
	{{ csrf_field() }}
	
	<h1>Are you sure you want to delete this object type?</h1>
	<button type="submit">Yes, delete</button>
	<button type="button" class="modal-close">No, cancel.</button>
</form>