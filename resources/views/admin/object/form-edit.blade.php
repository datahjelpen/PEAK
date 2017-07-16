<form method="POST" action="{{ route('admin.object.update', [$type->slug, $object->slug]) }}">
	{{ method_field('PATCH') }}
	{{ csrf_field() }}

	@include('admin.object.fields')

	<input type="submit">
</form>