<form method="POST" action="{{ route('superadmin.taxonomy.store', $type->slug) }}">
	{{ csrf_field() }}

	@include('admin.superadmin.object.taxonomy.fields')

	<input type="submit">
</form>