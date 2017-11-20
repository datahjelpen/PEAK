<form method="POST" action="{{ route('superadmin.status.update', [$item_type->slug, $status->slug]) }}">
	{{ method_field('PATCH') }}
	{{ csrf_field() }}

	@include('admin.superadmin.item.status.fields')

	<input type="submit">
</form>