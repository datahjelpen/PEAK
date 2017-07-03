<form method="POST" action="{{ route('object_type.update', $object_type->slug) }}">
	{{ method_field('PATCH') }}
	{{ csrf_field() }}

	@include('admin.builder.object_type.fields')

	<input type="submit">
</form>