<form method="POST" action="{{ route('superadmin.object.taxonomy.store', $type->slug) }}">
	{{ csrf_field() }}

	@include('admin.superadmin.object.taxonomy.fields')

	<input type="submit">
</form>