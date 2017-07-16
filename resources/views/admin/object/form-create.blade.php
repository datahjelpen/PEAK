<form method="POST" action="{{ route('admin.object.store', [$type->slug]) }}">
	{{ csrf_field() }}

	@include('admin.object.fields')

	<input type="submit">
</form>