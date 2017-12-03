<form method="POST" action="{{ route('admin.item.store', [$item_type->slug]) }}" enctype="multipart/form-data">
	{{ csrf_field() }}

	@include('admin.item.fields')

	<input type="submit">
</form>