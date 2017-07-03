<form method="POST" action="{{ route('object.type.update', $type->slug) }}">
	{{ method_field('PATCH') }}
	{{ csrf_field() }}

	@include('admin.builder.object_type.fields')

	<input type="submit">
</form>