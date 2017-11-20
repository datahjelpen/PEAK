<form method="POST" action="{{ route('admin.item.update', [$item_type->slug, $item->slug]) }}">
	{{ method_field('PATCH') }}
	{{ csrf_field() }}

	@include('admin.item.fields')

	<input type="submit">
</form>