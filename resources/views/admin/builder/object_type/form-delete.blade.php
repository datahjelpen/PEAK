<form method="POST" action="{{ route('object.type.destroy', $type->slug) }}">
	{{ method_field('DELETE') }}
	{{ csrf_field() }}
	
	<h1>Are you sure you want to delete this object type?</h1>
	<button class="autofocus" type="submit" autofocus>Yes, delete</button>
	<button type="button" class="modal-close">No, cancel.</button>
</form>