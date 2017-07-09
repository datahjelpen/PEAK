<form method="POST" action="{{ route('superadmin.object.taxonomy.update', [$type->slug, $taxonomy->slug]) }}">
	{{ method_field('PATCH') }}
	{{ csrf_field() }}

	@include('admin.superadmin.object.taxonomy.fields')

	<input type="submit">
</form>