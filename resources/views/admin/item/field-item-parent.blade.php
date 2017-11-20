<li>
	@include('admin.item.field-item', ['term' => $parent])

	@if ($parent->hasChildren)
		<ul>
			@foreach ($parent->children as $child)
				@include('admin.item.field-item-parent', ['parent' => $child])
			@endforeach
		</ul>
	@endif
</li>