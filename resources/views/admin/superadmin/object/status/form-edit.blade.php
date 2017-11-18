<form method="POST" action="{{ route('superadmin.status.update', [$type->slug, $status->slug]) }}">
	{{ method_field('PATCH') }}
	{{ csrf_field() }}

	@include('admin.superadmin.object.status.fields')

	<input type="submit">
</form>