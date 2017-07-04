<form method="POST" action="{{ route('object.taxonomy.store', $type->slug) }}">
	{{ csrf_field() }}

	@include('admin.builder.object.taxonomy.fields')

	<input type="submit">
</form>